<?php

namespace App\Http\Livewire\ExampleLaravel;

use Livewire\Component;
use App\Models\Role;
use App\Models\User;
use App\Support\AppPermissions;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserManagement extends Component
{
    public $activeTab = 'accounts';

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
    public $assigned_employee_ids = [];
    public $employeeSearch = '';

    public $showRoleModal = false;
    public $roleIdBeingEdited = null;
    public $isRoleEditMode = false;
    public $role_name = '';
    public $role_slug = '';
    public $role_description = '';
    public $role_permissions = [];

    public function showAccountsTab()
    {
        $this->activeTab = 'accounts';
    }

    public function showRolesTab()
    {
        $this->activeTab = 'roles';
    }

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
        $this->authorizeWrite();
        $this->resetUserForm();
        $this->showUserModal = true;
    }

    public function editUser($id)
    {
        $this->authorizeWrite();
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
        $this->assigned_employee_ids = $user->managedEmployees()
            ->wherePivot('active', true)
            ->pluck('users.id')
            ->map(fn ($id) => (int) $id)
            ->toArray();

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
            'assigned_employee_ids',
            'employeeSearch',
        ]);

        $this->userIdBeingEdited = null;
        $this->isEditMode = false;
        $this->phone_country_code = '+31';
        $this->role = 'member';
        $this->user_type = 'external';
    }

    public function updatedRole($role)
    {
        if ($role !== 'manager') {
            $this->assigned_employee_ids = [];
            $this->employeeSearch = '';
        }
    }

    public function addAssignedEmployee($employeeId)
    {
        $employeeId = (int) $employeeId;

        if ($this->userIdBeingEdited && $employeeId === (int) $this->userIdBeingEdited) {
            return;
        }

        if (! User::whereKey($employeeId)->where('role', '!=', 'administrator')->exists()) {
            return;
        }

        $this->assigned_employee_ids = collect($this->assigned_employee_ids)
            ->map(fn ($id) => (int) $id)
            ->push($employeeId)
            ->unique()
            ->values()
            ->toArray();

        $this->employeeSearch = '';
    }

    public function removeAssignedEmployee($employeeId)
    {
        $employeeId = (int) $employeeId;

        $this->assigned_employee_ids = collect($this->assigned_employee_ids)
            ->map(fn ($id) => (int) $id)
            ->reject(fn ($id) => $id === $employeeId)
            ->values()
            ->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE USER
    |--------------------------------------------------------------------------
    */

    public function saveUser()
    {
        $this->authorizeWrite();

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

            $this->syncManagedEmployees($user);

        } else {

            /*
            |--------------------------------------------------------------------------
            | CREATE USER
            |--------------------------------------------------------------------------
            */

            $user = User::create([

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

            $this->syncManagedEmployees($user);
            event(new Registered($user));

        }

        $this->closeUserModal();
    }

    public function deleteUser($id)
    {
        $this->authorizeWrite();

        if ((int) $id === auth()->id()) {
            $this->addError('delete_user', 'You cannot delete your own account while signed in.');

            return;
        }

        $user = User::findOrFail($id);

        $user->managedEmployees()->detach();
        $user->employeeManagers()->detach();
        $user->projects()->detach();
        $user->delete();
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

            'role' => 'required|exists:roles,slug',

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

            'assigned_employee_ids' => 'array',

            'assigned_employee_ids.*' => [
                'integer',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', '!=', 'administrator')),
            ],

        ];
    }

    private function syncManagedEmployees(User $user): void
    {
        $user->managedEmployees()->detach();

        if ($user->role !== 'manager') {
            return;
        }

        $employeeIds = collect($this->assigned_employee_ids)
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id !== (int) $user->id)
            ->unique()
            ->values();

        if ($employeeIds->isEmpty()) {
            return;
        }

        $user->managedEmployees()->sync(
            $employeeIds
                ->mapWithKeys(fn ($id) => [$id => ['active' => true]])
                ->toArray()
        );
    }

    public function openRoleModal()
    {
        $this->authorizeWrite();
        $this->resetRoleForm();
        $this->role_permissions = $this->blankPermissions();
        $this->showRoleModal = true;
    }

    public function editRole($id)
    {
        $this->authorizeWrite();

        $role = Role::with('permissions')->findOrFail($id);

        $this->roleIdBeingEdited = $role->id;
        $this->isRoleEditMode = true;
        $this->role_name = $role->name;
        $this->role_slug = $role->slug;
        $this->role_description = $role->description;
        $this->role_permissions = $this->blankPermissions();

        foreach ($role->permissions as $permission) {
            $this->role_permissions[$permission->module] = [
                'read' => (bool) $permission->can_read,
                'write' => (bool) $permission->can_write,
            ];
        }

        $this->showRoleModal = true;
    }

    public function closeRoleModal()
    {
        $this->showRoleModal = false;
        $this->resetRoleForm();
    }

    public function saveRole()
    {
        $this->authorizeWrite();

        if (! $this->isRoleEditMode) {
            $this->role_slug = Str::slug($this->role_slug ?: $this->role_name);
        }

        $validated = $this->validate([
            'role_name' => 'required|string|max:255',
            'role_slug' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('roles', 'slug')->ignore($this->roleIdBeingEdited),
            ],
            'role_description' => 'nullable|string|max:1000',
            'role_permissions' => 'array',
        ]);

        $role = Role::updateOrCreate(
            ['id' => $this->roleIdBeingEdited],
            [
                'name' => $validated['role_name'],
                'slug' => $validated['role_slug'],
                'description' => $validated['role_description'],
            ]
        );

        foreach (AppPermissions::modules() as $module => $label) {
            $canRead = (bool) ($this->role_permissions[$module]['read'] ?? false);
            $canWrite = (bool) ($this->role_permissions[$module]['write'] ?? false);

            $role->permissions()->updateOrCreate(
                ['module' => $module],
                [
                    'can_read' => $canRead || $canWrite,
                    'can_write' => $canWrite,
                ]
            );
        }

        $this->closeRoleModal();
    }

    public function deleteRole($id)
    {
        $this->authorizeWrite();

        $role = Role::withCount('users')->findOrFail($id);

        if ($role->is_system || $role->users_count > 0) {
            return;
        }

        $role->delete();
    }

    private function resetRoleForm()
    {
        $this->reset([
            'role_name',
            'role_slug',
            'role_description',
            'role_permissions',
        ]);

        $this->roleIdBeingEdited = null;
        $this->isRoleEditMode = false;
    }

    private function blankPermissions()
    {
        return collect(AppPermissions::modules())
            ->mapWithKeys(fn ($label, $module) => [
                $module => [
                    'read' => false,
                    'write' => false,
                ],
            ])
            ->toArray();
    }

    private function authorizeWrite()
    {
        abort_unless(auth()->user()->canWrite('user-management'), 403);
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
            ,
            'roles' => Role::with(['permissions'])
                ->withCount('users')
                ->orderBy('name')
                ->get(),
            'roleOptions' => Role::orderBy('name')->get(),
            'assignableEmployees' => User::where('role', '!=', 'administrator')
                ->when($this->userIdBeingEdited, fn ($query) => $query->where('id', '!=', $this->userIdBeingEdited))
                ->when($this->employeeSearch, function ($query) {
                    $search = '%' . $this->employeeSearch . '%';

                    $query->where(function ($innerQuery) use ($search) {
                        $innerQuery
                            ->where('first_name', 'like', $search)
                            ->orWhere('last_name', 'like', $search)
                            ->orWhere('email', 'like', $search)
                            ->orWhere('employee_id', 'like', $search);
                    });
                })
                ->whereNotIn('id', collect($this->assigned_employee_ids)->map(fn ($id) => (int) $id)->all())
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->limit(12)
                ->get(),
            'selectedAssignedEmployees' => User::whereIn('id', collect($this->assigned_employee_ids)->map(fn ($id) => (int) $id)->all())
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get(),
            'permissionModules' => AppPermissions::modules(),
            'canWriteUserManagement' => auth()->user()->canWrite('user-management'),

        ]);
    }
}
