<?php

namespace App\Http\Livewire\ExampleLaravel;

use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    /*
    |--------------------------------------------------------------------------
    | MODAL
    |--------------------------------------------------------------------------
    */

    public $showUserModal = false;
    public $userIdBeingEdited = null;
    public $isEditMode = false;

    /*
    |--------------------------------------------------------------------------
    | USER FIELDS
    |--------------------------------------------------------------------------
    */

    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public $role = 'member';
    public $user_type = 'external';

    public $employee_id;

    public $company_name;
    public $company_registration_number;
    public $vat_number;

    public $personal_address;
    public $personal_postal_code;
    public $personal_city;
    public $personal_country;

    public $business_address;
    public $business_postal_code;
    public $business_city;
    public $business_country;

    public $bank_name;
    public $bank_account_holder;
    public $iban;

    public $phone_country_code = '+31';
    public $phone_number;

    public $about;

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    protected $rules = [

        /*
        |--------------------------------------------------------------------------
        | PERSONAL
        |--------------------------------------------------------------------------
        */

        'first_name' => 'required|string|max:255',

        'last_name' => 'required|string|max:255',

        /*
        |--------------------------------------------------------------------------
        | AUTH
        |--------------------------------------------------------------------------
        */

        'email' => 'required|email|max:255|unique:users,email',

        'password' => 'required|min:12',

        /*
        |--------------------------------------------------------------------------
        | USER SETTINGS
        |--------------------------------------------------------------------------
        */

        'role' => 'required|in:administrator,manager,member',

        'user_type' => 'required|in:internal,external',

        /*
        |--------------------------------------------------------------------------
        | CONTACT
        |--------------------------------------------------------------------------
        */

        'phone_country_code' => 'required|string|max:10',

        'phone_number' => 'required|string|max:25',

        /*
        |--------------------------------------------------------------------------
        | PERSONAL ADDRESS
        |--------------------------------------------------------------------------
        */

        'personal_address' => 'required|string|max:255',

        'personal_postal_code' => 'required|string|max:50',

        'personal_city' => 'required|string|max:255',

        'personal_country' => 'required|string|max:255',

        /*
        |--------------------------------------------------------------------------
        | OPTIONAL
        |--------------------------------------------------------------------------
        */

        'company_name' => 'nullable|string|max:255',

        'company_registration_number' => 'nullable|string|max:255',

        'vat_number' => 'nullable|string|max:255',

        'employee_id' => 'nullable|string|max:255',

        'business_address' => 'nullable|string|max:255',

        'business_postal_code' => 'nullable|string|max:255',

        'business_city' => 'nullable|string|max:255',

        'business_country' => 'nullable|string|max:255',

        'bank_name' => 'nullable|string|max:255',

        'bank_account_holder' => 'nullable|string|max:255',

        'iban' => 'nullable|string|max:34',

        'about' => 'nullable|string',

    ];

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    public function openUserModal()
    {
        $this->resetUserForm();
        $this->showUserModal = true;
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        $this->userIdBeingEdited = $user->id;

        $this->isEditMode = true;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;

        $this->email = $user->email;
        $this->password = null;

        $this->role = $user->role;
        $this->user_type = $user->user_type;

        $this->employee_id = $user->employee_id;

        $this->company_name = $user->company_name;
        $this->company_registration_number = $user->company_registration_number;
        $this->vat_number = $user->vat_number;

        $this->personal_address = $user->personal_address;
        $this->personal_postal_code = $user->personal_postal_code;
        $this->personal_city = $user->personal_city;
        $this->personal_country = $user->personal_country;

        $this->business_address = $user->business_address;
        $this->business_postal_code = $user->business_postal_code;
        $this->business_city = $user->business_city;
        $this->business_country = $user->business_country;

        $this->bank_name = $user->bank_name;
        $this->bank_account_holder = $user->bank_account_holder;
        $this->iban = $user->iban;

        $this->phone_country_code = $user->phone_country_code;
        $this->phone_number = $user->phone_number;

        $this->about = $user->about;

        $this->showUserModal = true;
    }
    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    public function closeUserModal()
    {
        $this->showUserModal = false;

        $this->resetUserForm();
    }

    private function resetUserForm()
    {
        $this->reset([
            'first_name',
            'last_name',
            'email',
            'password',
            'role',
            'user_type',
            'employee_id',
            'company_name',
            'company_registration_number',
            'vat_number',
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
            'phone_number',
            'about',
        ]);

        $this->userIdBeingEdited = null;
        $this->isEditMode = false;
        $this->phone_country_code = '+31';
        $this->role = 'member';
        $this->user_type = 'external';
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE USER
    |--------------------------------------------------------------------------
    */

    public function saveUser()
    {
        if ($this->isEditMode && $this->password === '') {
            $this->password = null;
        }

        $this->validate($this->rulesForSave());

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        if ($this->isEditMode) {

            $user = User::findOrFail($this->userIdBeingEdited);

            $user->update([

                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,

                'email'      => $this->email,

                'role'       => $this->role,

                'user_type'  => $this->user_type,

                'employee_id' => $this->employee_id,

                'company_name' => $this->company_name,
                'company_registration_number' => $this->company_registration_number,
                'vat_number' => $this->vat_number,

                'personal_address' => $this->personal_address,
                'personal_postal_code' => $this->personal_postal_code,
                'personal_city' => $this->personal_city,
                'personal_country' => $this->personal_country,

                'business_address' => $this->business_address,
                'business_postal_code' => $this->business_postal_code,
                'business_city' => $this->business_city,
                'business_country' => $this->business_country,

                'bank_name' => $this->bank_name,
                'bank_account_holder' => $this->bank_account_holder,
                'iban' => $this->iban,

                'phone_country_code' => $this->phone_country_code,
                'phone_number' => $this->phone_number,

                'about' => $this->about,

            ]);

            /*
            |--------------------------------------------------------------------------
            | OPTIONAL PASSWORD UPDATE
            |--------------------------------------------------------------------------
            */

            if (!empty($this->password)) {

                $user->update([
                    'password' => $this->password
                ]);

            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | CREATE USER
            |--------------------------------------------------------------------------
            */

            User::create([

                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,

                'email'      => $this->email,

                'password'   => $this->password,

                'role'       => $this->role,

                'user_type'  => $this->user_type,

                'employee_id' => $this->employee_id,

                'company_name' => $this->company_name,
                'company_registration_number' => $this->company_registration_number,
                'vat_number' => $this->vat_number,

                'personal_address' => $this->personal_address,
                'personal_postal_code' => $this->personal_postal_code,
                'personal_city' => $this->personal_city,
                'personal_country' => $this->personal_country,

                'business_address' => $this->business_address,
                'business_postal_code' => $this->business_postal_code,
                'business_city' => $this->business_city,
                'business_country' => $this->business_country,

                'bank_name' => $this->bank_name,
                'bank_account_holder' => $this->bank_account_holder,
                'iban' => $this->iban,

                'phone_country_code' => $this->phone_country_code,
                'phone_number' => $this->phone_number,

                'about' => $this->about,

            ]);

        }

        $this->closeUserModal();
    }

    private function rulesForSave()
    {
        return [

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' =>
                'required|email|max:255|unique:users,email' .
                ($this->isEditMode ? ',' . $this->userIdBeingEdited : ''),

            'password' => $this->isEditMode ? 'nullable|min:12' : 'required|min:12',

            'role' => 'required|in:administrator,manager,member',

            'user_type' => 'required|in:internal,external',

            'phone_country_code' => 'nullable|string|max:10',

            'phone_number' => 'nullable|string|max:25',

            'personal_address' => 'nullable|string|max:255',

            'personal_postal_code' => 'nullable|string|max:50',

            'personal_city' => 'nullable|string|max:255',

            'personal_country' => 'nullable|string|max:255',

            'company_name' => 'nullable|string|max:255',

            'company_registration_number' => 'nullable|string|max:255',

            'vat_number' => 'nullable|string|max:255',

            'employee_id' => 'nullable|string|max:255',

            'business_address' => 'nullable|string|max:255',

            'business_postal_code' => 'nullable|string|max:255',

            'business_city' => 'nullable|string|max:255',

            'business_country' => 'nullable|string|max:255',

            'bank_name' => 'nullable|string|max:255',

            'bank_account_holder' => 'nullable|string|max:255',

            'iban' => 'nullable|string|max:34',

            'about' => 'nullable|string',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return view('livewire.example-laravel.user-management', [

            'users' => User::latest()->get()

        ]);
    }
}
