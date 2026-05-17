<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Illuminate\Database\Seeder;

class NetherlandsCalendarSeeder extends Seeder
{
    public function run(): void
    {
        $holidays = [
            ['New Year\'s Day', '2026-01-01', true],
            ['Good Friday', '2026-04-03', false],
            ['Easter Sunday', '2026-04-05', false],
            ['Easter Monday', '2026-04-06', false],
            ['King\'s Day', '2026-04-27', true],
            ['Liberation Day', '2026-05-05', true],
            ['Ascension Day', '2026-05-14', false],
            ['Whit Sunday', '2026-05-24', false],
            ['Whit Monday', '2026-05-25', false],
            ['Christmas Day', '2026-12-25', true],
            ['Boxing Day', '2026-12-26', true],
            ['New Year\'s Day', '2027-01-01', true],
            ['Good Friday', '2027-03-26', false],
            ['Easter Sunday', '2027-03-28', false],
            ['Easter Monday', '2027-03-29', false],
            ['King\'s Day', '2027-04-27', true],
            ['Liberation Day', '2027-05-05', true],
            ['Ascension Day', '2027-05-06', false],
            ['Whit Sunday', '2027-05-16', false],
            ['Whit Monday', '2027-05-17', false],
            ['Christmas Day', '2027-12-25', true],
            ['Boxing Day', '2027-12-26', true],
        ];

        foreach ($holidays as [$name, $date, $isRecurring]) {
            Calendar::updateOrCreate(
                [
                    'country_code' => 'NL',
                    'holiday_name' => $name,
                    'holiday_date' => $date,
                ],
                [
                    'country_name' => 'Netherlands',
                    'is_recurring' => $isRecurring,
                    'weekend_days' => ['saturday', 'sunday'],
                    'status' => 'active',
                    'notes' => 'Official Dutch public holiday. Time-off entitlement depends on employment contract or CAO.',
                ]
            );
        }
    }
}
