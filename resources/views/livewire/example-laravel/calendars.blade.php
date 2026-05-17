<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1506784365847-bbad939e9335?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
                    <div class="row gx-4 align-items-center mb-3">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">event</i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <h5 class="mb-1">Calendars</h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                Manage national holidays and weekend rules by country.
                            </p>
                        </div>

                        @if($canWriteCalendars)
                            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-end">
                                <button
                                    type="button"
                                    wire:click="openCalendarModal"
                                    class="btn bg-gradient-warning dynamic-config-btn mb-0"
                                >
                                    <i class="material-icons text-sm">add</i>
                                    &nbsp;&nbsp;Add Calendar Rule
                                </button>
                            </div>
                        @endif
                    </div>

                    <hr class="horizontal gray-light my-3">

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1">Calendar Rules</h6>
                            <p class="text-sm text-secondary mb-0">
                                Filter holidays and weekend rules by country.
                            </p>
                        </div>

                        <div class="calendar-filter-control">
                            <label class="form-label text-xs text-uppercase font-weight-bolder mb-1">
                                Country
                            </label>
                            <div class="input-group input-group-outline">
                                <select class="form-control" wire:model.live="countryFilter">
                                    <option value="">All countries</option>
                                    @foreach($countryFilterOptions as $countryOption)
                                        <option value="{{ $countryOption->country_code }}">
                                            {{ $countryOption->country_code }} - {{ $countryOption->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Country
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Holiday
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Day
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Recurring
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Weekend Days
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Status
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($calendars as $calendar)
                                        <tr>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">{{ $calendar->country_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $calendar->country_code }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">{{ $calendar->holiday_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $calendar->notes ?: 'No notes' }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $calendar->holiday_date->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $calendar->holiday_date->format('l') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm {{ $calendar->is_recurring ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ $calendar->is_recurring ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ collect($calendar->weekend_days ?: [])->map(fn ($day) => ucfirst($day))->join(', ') ?: '-' }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm {{ $calendar->status === 'active' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ ucfirst($calendar->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-end pe-3">
                                                @if($canWriteCalendars)
                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-warning dynamic-config-text px-2 mb-0"
                                                        wire:click="editCalendar({{ $calendar->id }})"
                                                    >
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-danger px-2 mb-0"
                                                        wire:click="deleteCalendar({{ $calendar->id }})"
                                                        wire:confirm="Are you sure you want to delete this calendar rule?"
                                                    >
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <span class="text-secondary">
                                                    No calendar rules found.
                                                </span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($showCalendarModal)
        <div
            wire:ignore.self
            class="modal fade show d-block"
            tabindex="-1"
            style="background: rgba(0,0,0,0.5);"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $isEditMode ? 'Edit Calendar Rule' : 'Add Calendar Rule' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeCalendarModal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 mb-4">
                                <label class="form-label">Country Name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" class="form-control" wire:model="country_name" readonly>
                                </div>
                                @error('country_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-5 mb-4">
                                <label class="form-label">Country Code</label>
                                <div class="input-group input-group-outline" wire:ignore>
                                    <select
                                        class="form-control @error('country_code') is-invalid @enderror"
                                        data-calendar-country-select
                                        data-current-country="{{ strtoupper($country_code ?: 'NL') }}"
                                    ></select>
                                </div>
                                @error('country_code')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-8 mb-4">
                                <label class="form-label">Holiday Name</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" class="form-control @error('holiday_name') is-invalid @enderror" wire:model="holiday_name">
                                </div>
                                @error('holiday_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">Holiday Date</label>
                                <div class="input-group input-group-outline">
                                    <input type="date" class="form-control @error('holiday_date') is-invalid @enderror" wire:model="holiday_date">
                                </div>
                                @error('holiday_date')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                @error('status')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input dynamic-config-checkbox" type="checkbox" wire:model="is_recurring" id="calendarRecurring">
                                    <label class="form-check-label" for="calendarRecurring">
                                        Recurs every year
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label d-block">Weekend Days</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($dayOptions as $day => $label)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input dynamic-config-checkbox"
                                                type="checkbox"
                                                value="{{ $day }}"
                                                wire:model="weekend_days"
                                                id="weekend_{{ $day }}"
                                            >
                                            <label class="form-check-label" for="weekend_{{ $day }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('weekend_days')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">Notes</label>
                                <div class="input-group input-group-outline">
                                    <textarea class="form-control @error('notes') is-invalid @enderror" rows="4" wire:model="notes"></textarea>
                                </div>
                                @error('notes')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeCalendarModal">
                            Cancel
                        </button>
                        <button type="button" class="btn bg-gradient-warning dynamic-config-btn" wire:click="saveCalendar">
                            {{ $isEditMode ? 'Update Calendar Rule' : 'Create Calendar Rule' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
