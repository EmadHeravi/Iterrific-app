<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\Calendar;
use Livewire\Component;

class Calendars extends Component
{
    public $showCalendarModal = false;
    public $calendarIdBeingEdited = null;
    public $isEditMode = false;

    public $country_name = 'Netherlands';
    public $country_code = 'NL';
    public $holiday_name = '';
    public $holiday_date = '';
    public $is_recurring = false;
    public $weekend_days = ['saturday', 'sunday'];
    public $status = 'active';
    public $notes = '';
    public $countryFilter = '';

    public array $dayOptions = [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ];

    public function updatedCountryCode($value)
    {
        $this->country_code = strtoupper((string) $value);
    }

    public function openCalendarModal()
    {
        $this->authorizeWrite();
        $this->resetCalendarForm();
        $this->showCalendarModal = true;
    }

    public function editCalendar($id)
    {
        $this->authorizeWrite();

        $calendar = Calendar::findOrFail($id);

        $this->calendarIdBeingEdited = $calendar->id;
        $this->isEditMode = true;
        $this->country_code = $calendar->country_code;
        $this->country_name = $calendar->country_name;
        $this->holiday_name = $calendar->holiday_name;
        $this->holiday_date = optional($calendar->holiday_date)->format('Y-m-d');
        $this->is_recurring = $calendar->is_recurring;
        $this->weekend_days = $calendar->weekend_days ?: [];
        $this->status = $calendar->status;
        $this->notes = $calendar->notes;
        $this->showCalendarModal = true;
    }

    public function closeCalendarModal()
    {
        $this->showCalendarModal = false;
        $this->resetCalendarForm();
    }

    public function saveCalendar()
    {
        $this->authorizeWrite();

        $this->validate([
            'country_name' => 'required|string|max:255',
            'country_code' => 'required|string|size:2',
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date',
            'is_recurring' => 'boolean',
            'weekend_days' => 'nullable|array',
            'weekend_days.*' => 'in:' . implode(',', array_keys($this->dayOptions)),
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string|max:1000',
        ]);

        Calendar::updateOrCreate(
            ['id' => $this->calendarIdBeingEdited],
            [
                'country_name' => $this->country_name,
                'country_code' => strtoupper($this->country_code),
                'holiday_name' => $this->holiday_name,
                'holiday_date' => $this->holiday_date,
                'is_recurring' => (bool) $this->is_recurring,
                'weekend_days' => $this->weekend_days ?: [],
                'status' => $this->status,
                'notes' => $this->notes,
            ]
        );

        $this->closeCalendarModal();
    }

    public function deleteCalendar($id)
    {
        $this->authorizeWrite();

        Calendar::findOrFail($id)->delete();
    }

    private function resetCalendarForm()
    {
        $this->reset([
            'country_name',
            'country_code',
            'holiday_name',
            'holiday_date',
            'is_recurring',
            'weekend_days',
            'status',
            'notes',
        ]);

        $this->calendarIdBeingEdited = null;
        $this->isEditMode = false;
        $this->country_name = 'Netherlands';
        $this->country_code = 'NL';
        $this->is_recurring = false;
        $this->weekend_days = ['saturday', 'sunday'];
        $this->status = 'active';
    }

    private function authorizeWrite()
    {
        abort_unless(auth()->user()->canWrite('calendars'), 403);
    }

    public function render()
    {
        $calendarQuery = Calendar::query()
            ->when($this->countryFilter, function ($query) {
                $query->where('country_code', $this->countryFilter);
            })
            ->orderBy('country_name')
            ->orderBy('holiday_date');

        return view('livewire.example-laravel.calendars', [
            'calendars' => $calendarQuery->get(),
            'countryFilterOptions' => Calendar::select('country_code', 'country_name')
                ->distinct()
                ->orderBy('country_name')
                ->get(),
            'canWriteCalendars' => auth()->user()->canWrite('calendars'),
        ]);
    }
}
