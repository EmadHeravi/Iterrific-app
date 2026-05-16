<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\Projects;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Profile;
use App\Http\Livewire\RTL;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Tables;
use App\Http\Livewire\VirtualReality;
use GuzzleHttp\Middleware;
use App\Http\Controllers\ContactController;

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
Route::post('/logout', function () {

    auth()->logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/sign-in');

})->middleware('auth')->name('logout');


Route::get('user-profile', UserProfile::class)->middleware(['auth', 'permission:user-profile'])->name('user-profile');
Route::get('user-management', UserManagement::class)->middleware(['auth', 'permission:user-management'])->name('user-management');
Route::get('projects', Projects::class)->middleware(['auth', 'permission:projects'])->name('projects');

Route::group(['middleware' => 'auth'], function () {
Route::get('dashboard', Dashboard::class)->middleware('permission:dashboard')->name('dashboard');
Route::get('billing', Billing::class)->middleware('permission:billing')->name('billing');
Route::get('profile', Profile::class)->middleware('permission:profile')->name('profile');
Route::get('tables', Tables::class)->middleware('permission:tables')->name('tables');
Route::get('notifications', Notifications::class)->middleware('permission:notifications')->name("notifications");
Route::get('virtual-reality', VirtualReality::class)->middleware('permission:virtual-reality')->name('virtual-reality');
Route::get('static-sign-in', StaticSignIn::class)->name('static-sign-in');
Route::get('static-sign-up', StaticSignUp::class)->name('static-sign-up');
Route::get('rtl', RTL::class)->middleware('permission:rtl')->name('rtl');
});

Route::get('/401', fn () => abort(401));
Route::get('/403', fn () => abort(403));
Route::get('/405', fn () => abort(405));
Route::get('/419', fn () => abort(419));
Route::get('/429', fn () => abort(429));
Route::get('/500', fn () => abort(500));
Route::get('/503', fn () => abort(503));
