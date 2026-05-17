<div class="container-fluid px-2 px-md-4">
    <style>
        .profile-avatar-panel {
            align-items: flex-start;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            display: grid;
            gap: 1rem;
            grid-template-columns: auto 1fr minmax(260px, 0.7fr);
            padding: 1rem;
        }

        .profile-avatar-preview img {
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(52, 71, 103, 0.12);
            height: 6rem !important;
            object-fit: cover;
            width: 6rem !important;
        }

        .profile-avatar-options {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .profile-avatar-option {
            background: transparent;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            padding: 0.15rem;
        }

        .profile-avatar-option.active {
            border-color: var(--dashboard-config-color, #fb8c00);
        }

        .profile-avatar-option img {
            border-radius: 0.4rem;
            height: 3.25rem !important;
            object-fit: cover;
            width: 3.25rem !important;
        }

        @media (max-width: 991.98px) {
            .profile-avatar-panel {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
        <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
    </div>

    <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
        <div class="row gx-4 align-items-center mb-3">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img
                        src="{{ $this->avatarUrl() }}"
                        alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm"
                    >
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $first_name }} {{ $last_name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ ucfirst($user->role) }} - {{ ucfirst($user->user_type) }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="horizontal gray-light my-3">

        @if (session('status'))
            <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm">{{ Session::get('status') }}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::has('demo'))
            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                <span class="text-sm">{{ Session::get('demo') }}</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12 mb-4">
                    <h6 class="text-dark mb-3">Profile Image</h6>
                    <div class="profile-avatar-panel">
                        <div class="profile-avatar-preview">
                            <img src="{{ $this->avatarUrl() }}" alt="Selected profile image">
                        </div>

                        <div class="profile-avatar-options">
                            @foreach($avatarOptions as $avatarOption)
                                <button
                                    type="button"
                                    class="profile-avatar-option {{ $selectedAvatar === $avatarOption ? 'active' : '' }}"
                                    wire:click="selectAvatar('{{ $avatarOption }}')"
                                >
                                    <img src="{{ asset($avatarOption) }}" alt="Avatar option">
                                </button>
                            @endforeach
                        </div>

                        <div class="profile-avatar-upload">
                            <label class="form-label">Upload Profile Image</label>
                            <input
                                type="file"
                                class="form-control border border-2 p-2 @error('avatarUpload') is-invalid @enderror"
                                wire:model="avatarUpload"
                                accept="image/*"
                            >
                            @error('avatarUpload')
                                <p class="text-danger inputerror">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="avatarUpload" class="text-sm text-secondary mt-2">
                                Uploading image...
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <h6 class="text-dark mb-3">Personal Information</h6>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">First Name *</label>
                    <input wire:model.blur="first_name" type="text" class="form-control border border-2 p-2">
                    @error('first_name')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Last Name *</label>
                    <input wire:model.blur="last_name" type="text" class="form-control border border-2 p-2">
                    @error('last_name')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Email Address *</label>
                    <input wire:model.blur="email" type="email" class="form-control border border-2 p-2">
                    @error('email')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Employee ID</label>
                    <input
                        wire:model.blur="employee_id"
                        type="text"
                        class="form-control border border-2 p-2"
                        @if($user->role === 'member') readonly @endif
                    >
                    @if($user->role === 'member')
                        <p class="text-xs text-secondary mb-0 mt-1">
                            Employee ID is managed by an administrator.
                        </p>
                    @endif
                    @error('employee_id')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Phone Country Code</label>
                    <input wire:model.blur="phone_country_code" type="text" class="form-control border border-2 p-2">
                    @error('phone_country_code')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Phone Number</label>
                    <input wire:model.blur="phone_number" type="text" class="form-control border border-2 p-2">
                    @error('phone_number')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-dark mb-3">Company Information</h6>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Company Name</label>
                    <input wire:model.blur="company_name" type="text" class="form-control border border-2 p-2">
                    @error('company_name')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Company Registration Number</label>
                    <input wire:model.blur="company_registration_number" type="text" class="form-control border border-2 p-2">
                    @error('company_registration_number')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">VAT Number</label>
                    <input wire:model.blur="vat_number" type="text" class="form-control border border-2 p-2">
                    @error('vat_number')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-dark mb-3">Personal Address</h6>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Address</label>
                    <input wire:model.blur="personal_address" type="text" class="form-control border border-2 p-2">
                    @error('personal_address')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Postal Code</label>
                    <input wire:model.blur="personal_postal_code" type="text" class="form-control border border-2 p-2">
                    @error('personal_postal_code')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">City</label>
                    <input wire:model.blur="personal_city" type="text" class="form-control border border-2 p-2">
                    @error('personal_city')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Country</label>
                    <input wire:model.blur="personal_country" type="text" class="form-control border border-2 p-2">
                    @error('personal_country')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-dark mb-3">Business Address</h6>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Address</label>
                    <input wire:model.blur="business_address" type="text" class="form-control border border-2 p-2">
                    @error('business_address')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Postal Code</label>
                    <input wire:model.blur="business_postal_code" type="text" class="form-control border border-2 p-2">
                    @error('business_postal_code')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">City</label>
                    <input wire:model.blur="business_city" type="text" class="form-control border border-2 p-2">
                    @error('business_city')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Country</label>
                    <input wire:model.blur="business_country" type="text" class="form-control border border-2 p-2">
                    @error('business_country')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-dark mb-3">Banking Information</h6>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Bank Name</label>
                    <input wire:model.blur="bank_name" type="text" class="form-control border border-2 p-2">
                    @error('bank_name')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Account Holder</label>
                    <input wire:model.blur="bank_account_holder" type="text" class="form-control border border-2 p-2">
                    @error('bank_account_holder')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">IBAN</label>
                    <input wire:model.blur="iban" type="text" class="form-control border border-2 p-2">
                    @error('iban')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">About</label>
                    <textarea
                        wire:model.blur="about"
                        class="form-control border border-2 p-2"
                        placeholder="Say something about yourself"
                        rows="4"
                    ></textarea>
                    @error('about')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="col-12 mt-3">
                    <h6 class="text-dark mb-1">Security</h6>
                    <p class="text-sm text-secondary mb-3">
                        Leave password fields empty to keep your current password.
                    </p>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">New Password</label>
                    <input
                        wire:model.blur="new_password"
                        type="password"
                        class="form-control border border-2 p-2"
                        autocomplete="new-password"
                    >
                    <p class="text-xs text-secondary mb-0 mt-1">
                        Minimum 12 characters with uppercase, lowercase, number, and symbol.
                    </p>
                    @error('new_password')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Confirm New Password</label>
                    <input
                        wire:model.blur="new_password_confirmation"
                        type="password"
                        class="form-control border border-2 p-2"
                        autocomplete="new-password"
                    >
                    @error('new_password_confirmation')<p class="text-danger inputerror">{{ $message }}</p>@enderror
                </div>
            </div>

            @if(auth()->user()->canWrite('user-profile'))
                <button type="submit" class="btn bg-gradient-warning dynamic-config-btn">
                    Update Profile
                </button>
            @endif
        </form>
    </div>
</div>
