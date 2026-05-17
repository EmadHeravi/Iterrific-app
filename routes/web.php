<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\TwoFactorChallenge;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Approvals;
use App\Http\Livewire\ExampleLaravel\Calendars;
use App\Http\Livewire\ExampleLaravel\GeneralSettings;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\Projects;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Profile;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\TimeEntry;
use GuzzleHttp\Middleware;
use App\Http\Controllers\ContactController;
use App\Models\AppSetting;
use App\Models\TimeEntry as TimeEntryModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/services', 'services')->name('services');
Route::view('/about', 'about')->name('about');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/references', 'references')->name('references');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');
Route::get('two-factor-challenge', TwoFactorChallenge::class)->middleware('auth')->name('two-factor.challenge');
Route::post('/logout', function () {
    request()->session()->forget('two_factor_verified');

    auth()->logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/sign-in');

})->middleware('auth')->name('logout');

Route::get('/email/verify', function () {
    if (auth()->user()->hasVerifiedEmail()) {
        return redirect()->route('dashboard');
    }

    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()
        ->route('dashboard')
        ->with('status', 'Email address verified successfully.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->route('dashboard');
    }

    try {
        $request->user()->sendEmailVerificationNotification();
    } catch (\RuntimeException $exception) {
        report($exception);

        return back()->withErrors([
            'email' => 'Unable to send verification email right now. Please try again later.',
        ]);
    }

    return back()->with('status', 'A new verification link has been sent to your email address.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/permission-preview', function (Request $request) {
    abort_unless(auth()->user()?->role === 'administrator', 403);

    $data = $request->validate([
        'user_id' => 'nullable|exists:users,id',
    ]);

    if (empty($data['user_id']) || (int) $data['user_id'] === auth()->id()) {
        session()->forget('permission_preview_user_id');

        return back();
    } else {
        session(['permission_preview_user_id' => (int) $data['user_id']]);
    }

    return redirect()->route('dashboard');
})->middleware('auth')->name('permission-preview.set');

Route::delete('/permission-preview', function () {
    abort_unless(auth()->user()?->role === 'administrator', 403);

    session()->forget('permission_preview_user_id');

    return back();
})->middleware('auth')->name('permission-preview.clear');


Route::get('user-profile', UserProfile::class)->middleware(['auth', 'verified', 'twofactor', 'permission:user-profile'])->name('user-profile');
Route::get('general-settings', GeneralSettings::class)->middleware(['auth', 'verified', 'twofactor', 'permission:general-settings'])->name('general-settings');
Route::get('user-management', UserManagement::class)->middleware(['auth', 'verified', 'twofactor', 'permission:user-management'])->name('user-management');
Route::get('projects', Projects::class)->middleware(['auth', 'verified', 'twofactor', 'permission:projects'])->name('projects');
Route::get('calendars', Calendars::class)->middleware(['auth', 'verified', 'twofactor', 'permission:calendars'])->name('calendars');

Route::group(['middleware' => ['auth', 'verified', 'twofactor']], function () {
Route::get('dashboard', Dashboard::class)->middleware('permission:dashboard')->name('dashboard');
Route::get('billing', Billing::class)->middleware('permission:billing')->name('billing');
Route::get('profile', Profile::class)->middleware('permission:profile')->name('profile');
Route::get('time-entry', TimeEntry::class)->middleware('permission:time-entry')->name('time-entry');
Route::get('time-entry/export', function (Request $request) {
    abort_unless(auth()->user()->canRead('time-entry'), 403);

    $data = $request->validate([
        'year' => 'required|integer|min:2000|max:2100',
        'month' => 'required|integer|min:1|max:12',
    ]);

    $month = Carbon::create((int) $data['year'], (int) $data['month'], 1);
    $startOfMonth = $month->copy()->startOfMonth();
    $endOfMonth = $month->copy()->endOfMonth();

    $entries = TimeEntryModel::with(['project', 'calendar'])
        ->where('user_id', auth()->id())
        ->whereBetween('entry_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
        ->where('hours', '>', 0)
        ->orderBy('entry_date')
        ->orderBy('project_id')
        ->get();

    $fileName = sprintf(
        'time-entry-%s-%s.pdf',
        (string) str(auth()->user()->full_name ?: auth()->user()->email)->slug(),
        $month->format('Y-m')
    );

    return Pdf::loadView('time-entry.export', [
        'entries' => $entries,
        'logoPath' => extension_loaded('gd') ? AppSetting::publicPathFor('app_logo_path', 'assets/img/Logo.png') : null,
        'monthLabel' => $month->format('F Y'),
        'totalHours' => $entries->sum('hours'),
        'user' => auth()->user(),
    ])->setPaper('a4')->download($fileName);
})->middleware('permission:time-entry')->name('time-entry.export');
Route::redirect('tables', 'time-entry');
Route::get('approvals', Approvals::class)->middleware('permission:approvals')->name('approvals');
Route::get('approvals/export', function (Request $request) {
    abort_unless(auth()->user()->canRead('approvals'), 403);

    $data = $request->validate([
        'employee_id' => 'required|integer|exists:users,id',
        'year' => 'required|integer|min:2000|max:2100',
        'month' => 'required|integer|min:1|max:12',
    ]);

    $employee = User::findOrFail((int) $data['employee_id']);
    $user = auth()->user();

    abort_unless(
        $user->role === 'administrator'
            || ($user->role === 'manager' && $user->managesEmployee($employee->id)),
        403
    );

    $month = Carbon::create((int) $data['year'], (int) $data['month'], 1);
    $entries = TimeEntryModel::with(['project', 'calendar'])
        ->where('user_id', $employee->id)
        ->whereBetween('entry_date', [
            $month->copy()->startOfMonth()->toDateString(),
            $month->copy()->endOfMonth()->toDateString(),
        ])
        ->where('hours', '>', 0)
        ->orderBy('entry_date')
        ->orderBy('project_id')
        ->get();

    $fileName = sprintf(
        'employee-hours-%s-%s.pdf',
        (string) str($employee->full_name ?: $employee->email)->slug(),
        $month->format('Y-m')
    );

    return Pdf::loadView('time-entry.export', [
        'entries' => $entries,
        'logoPath' => extension_loaded('gd') ? AppSetting::publicPathFor('app_logo_path', 'assets/img/Logo.png') : null,
        'monthLabel' => $month->format('F Y'),
        'totalHours' => $entries->sum('hours'),
        'user' => $employee,
    ])->setPaper('a4')->download($fileName);
})->middleware('permission:approvals')->name('approvals.export');
Route::get('notifications', Notifications::class)->middleware('permission:notifications')->name("notifications");
Route::get('static-sign-in', StaticSignIn::class)->name('static-sign-in');
Route::get('static-sign-up', StaticSignUp::class)->name('static-sign-up');
});

Route::get('/401', fn () => abort(401));
Route::get('/403', fn () => abort(403));
Route::get('/405', fn () => abort(405));
Route::get('/419', fn () => abort(419));
Route::get('/429', fn () => abort(429));
Route::get('/500', fn () => abort(500));
Route::get('/503', fn () => abort(503));
