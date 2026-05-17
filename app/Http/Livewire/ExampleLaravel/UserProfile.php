<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $employee_id = '';
    public $company_name = '';
    public $company_registration_number = '';
    public $vat_number = '';
    public $vat_rate = '21.00';
    public $personal_address = '';
    public $personal_postal_code = '';
    public $personal_city = '';
    public $personal_country = '';
    public $business_address = '';
    public $business_postal_code = '';
    public $business_city = '';
    public $business_country = '';
    public $bank_name = '';
    public $bank_account_holder = '';
    public $iban = '';
    public $phone_country_code = '';
    public $phone_number = '';
    public $about = '';
    public $avatar_path = '';
    public $avatarUpload;
    public $new_password = '';
    public $new_password_confirmation = '';

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'employee_id' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_registration_number' => 'nullable|string|max:255',
            'vat_number' => 'nullable|string|max:255',
            'vat_rate' => 'required|numeric|min:0|max:100',
            'personal_address' => 'nullable|string|max:255',
            'personal_postal_code' => 'nullable|string|max:50',
            'personal_city' => 'nullable|string|max:255',
            'personal_country' => 'nullable|string|max:255',
            'business_address' => 'nullable|string|max:255',
            'business_postal_code' => 'nullable|string|max:255',
            'business_city' => 'nullable|string|max:255',
            'business_country' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_holder' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:34',
            'phone_country_code' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:25',
            'about' => 'nullable|string|max:1000',
            'avatarUpload' => 'nullable|image|max:2048',
            'new_password' => [
                'nullable',
                'confirmed',
                Password::min(12)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'new_password_confirmation' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->fillFromUser();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedAvatarUpload()
    {
        $this->validateOnly('avatarUpload');

        abort_unless(auth()->user()->canWrite('user-profile'), 403);

        $avatarPath = $this->avatarUpload->store('avatars', 'public');

        $this->user->forceFill([
            'avatar_path' => $avatarPath,
        ])->save();

        $this->avatar_path = $avatarPath;
        $this->avatarUpload = null;

        session()->flash('status', 'Profile image updated successfully.');
    }

    public function update()
    {
        abort_unless(auth()->user()->canWrite('user-profile'), 403);

        $this->validate();

        if (env('IS_DEMO') && $this->user->id == 1) {
            if (auth()->user()->email == $this->email) {
                $this->fillUser();
                $this->user->save();
                $this->reset([
                    'new_password',
                    'new_password_confirmation',
                ]);

                return back()->withStatus('Profile successfully updated.');
            }

            return back()->with('demo', "You are in a demo version, you can't change the admin email.");
        }

        $this->fillUser();
        $this->user->save();
        $this->reset([
            'new_password',
            'new_password_confirmation',
        ]);

        return back()->withStatus('Profile successfully updated.');
    }

    private function fillFromUser(): void
    {
        foreach ($this->profileFields() as $field) {
            $this->{$field} = $this->user->{$field};
        }

    }

    private function fillUser(): void
    {
        $avatarPath = $this->avatar_path;

        if ($this->avatarUpload) {
            $avatarPath = $this->avatarUpload->store('avatars', 'public');
        }

        $payload = collect($this->profileFields())
            ->mapWithKeys(fn ($field) => [$field => $this->{$field}])
            ->toArray();

        if ($this->user->role === 'member') {
            unset($payload['employee_id']);
        }

        $payload['avatar_path'] = $avatarPath;

        if ($this->new_password) {
            $payload['password'] = $this->new_password;
        }

        $this->user->fill($payload);
        $this->avatar_path = $avatarPath;
        $this->avatarUpload = null;
    }

    private function profileFields(): array
    {
        return [
            'first_name',
            'last_name',
            'email',
            'employee_id',
            'company_name',
            'company_registration_number',
            'vat_number',
            'vat_rate',
            'personal_address',
            'personal_postal_code',
            'personal_city',
            'personal_country',
            'business_address',
            'business_postal_code',
            'business_city',
            'business_country',
            'bank_name',
            'bank_account_holder',
            'iban',
            'phone_country_code',
            'phone_number',
            'about',
            'avatar_path',
        ];
    }

    public function avatarUrl(): string
    {
        if ($this->avatarUpload) {
            return $this->avatarUpload->temporaryUrl();
        }

        if ($this->avatar_path) {
            return str_starts_with($this->avatar_path, 'assets/')
                ? asset($this->avatar_path)
                : Storage::disk('public')->url($this->avatar_path);
        }

        return asset('assets/img/Logo.png');
    }

    public function render()
    {
        return view('livewire.example-laravel.user-profile');
    }
}
