<?php

namespace App\Http\Livewire;

use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Billing extends Component
{
    public $selectedYear;
    public $selectedMonth;
    public $selectedEmployeeId;

    public function mount()
    {
        $this->selectedYear = (int) now()->year;
        $this->selectedMonth = (int) now()->month;
        $this->selectedEmployeeId = $this->canViewAllBilling(auth()->user())
            ? User::where('user_type', 'external')->orderBy('first_name')->orderBy('last_name')->value('id')
            : $this->effectiveBillingUser(auth()->user())->id;
    }

    public function render()
    {
        $user = auth()->user();
        $canViewAllBilling = $this->canViewAllBilling($user);
        $this->ensureSelectedEmployee($user);

        $billingUser = $this->billingUser($user);
        $month = Carbon::create((int) $this->selectedYear, (int) $this->selectedMonth, 1);
        $startOfMonth = $month->copy()->startOfMonth()->toDateString();
        $endOfMonth = $month->copy()->endOfMonth()->toDateString();

        $externalEmployees = collect();
        $employeeOptions = collect();

        if ($canViewAllBilling) {
            $externalEmployees = User::query()
                ->where('user_type', 'external')
                ->withSum([
                    'timeEntries as approved_hours' => fn ($query) => $query
                        ->where('status', 'approved')
                        ->whereBetween('entry_date', [$startOfMonth, $endOfMonth]),
                ], 'hours')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();

            $employeeOptions = User::query()
                ->where('user_type', 'external')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();
        }

        $billingCharts = $billingUser
            ? $this->billingCharts($billingUser)
            : $this->emptyBillingCharts();

        return view('livewire.billing', [
            'billingCharts' => $billingCharts,
            'billingUser' => $billingUser,
            'employeeOptions' => $employeeOptions,
            'externalEmployees' => $externalEmployees,
            'monthLabel' => $month->format('F Y'),
            'user' => $user,
            'canViewAllBilling' => $canViewAllBilling,
            'years' => range((int) now()->year - 2, (int) now()->year + 1),
        ]);
    }

    private function ensureSelectedEmployee(User $user): void
    {
        if (! $this->canViewAllBilling($user)) {
            $this->selectedEmployeeId = $this->effectiveBillingUser($user)->id;

            return;
        }

        $selectedEmployeeExists = User::query()
            ->whereKey($this->selectedEmployeeId)
            ->where('user_type', 'external')
            ->exists();

        if (! $selectedEmployeeExists) {
            $this->selectedEmployeeId = User::where('user_type', 'external')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->value('id');
        }
    }

    private function billingUser(User $user): ?User
    {
        if (! $this->canViewAllBilling($user)) {
            $effectiveUser = $this->effectiveBillingUser($user);

            return $effectiveUser->user_type === 'external' ? $effectiveUser : null;
        }

        return User::query()
            ->whereKey($this->selectedEmployeeId)
            ->where('user_type', 'external')
            ->first();
    }

    private function canViewAllBilling(User $user): bool
    {
        return $user->role === 'administrator'
            && ! session('permission_preview_user_id');
    }

    private function effectiveBillingUser(User $user): User
    {
        if (! session('permission_preview_user_id')) {
            return $user;
        }

        return User::find(session('permission_preview_user_id')) ?: $user;
    }

    private function billingCharts(User $billingUser): array
    {
        $year = (int) $this->selectedYear;
        $hourlyFee = (float) ($billingUser->hourly_fee ?? 0);
        $currency = $billingUser->hourly_fee_currency ?: 'EUR';
        $vatRate = $this->vatRate($billingUser);

        $monthlyEntries = TimeEntry::query()
            ->where('user_id', $billingUser->id)
            ->where('status', 'approved')
            ->whereBetween('entry_date', [
                Carbon::create($year, 1, 1)->startOfYear()->toDateString(),
                Carbon::create($year, 12, 1)->endOfYear()->toDateString(),
            ])
            ->get();

        $yearStart = $year - 4;
        $yearlyEntries = TimeEntry::query()
            ->where('user_id', $billingUser->id)
            ->where('status', 'approved')
            ->whereBetween('entry_date', [
                Carbon::create($yearStart, 1, 1)->startOfYear()->toDateString(),
                Carbon::create($year, 12, 1)->endOfYear()->toDateString(),
            ])
            ->get();

        $monthly = collect(range(1, 12))->map(function (int $month) use ($monthlyEntries, $hourlyFee, $vatRate) {
            $hours = (float) $monthlyEntries
                ->filter(fn (TimeEntry $entry) => (int) $entry->entry_date->month === $month)
                ->sum('hours');

            return $this->billingPoint($hours, $hourlyFee, $vatRate);
        });

        $quarterly = collect(range(1, 4))->map(function (int $quarter) use ($monthlyEntries, $hourlyFee, $vatRate) {
            $hours = (float) $monthlyEntries
                ->filter(fn (TimeEntry $entry) => (int) ceil($entry->entry_date->month / 3) === $quarter)
                ->sum('hours');

            return $this->billingPoint($hours, $hourlyFee, $vatRate);
        });

        $yearly = collect(range($yearStart, $year))->map(function (int $chartYear) use ($yearlyEntries, $hourlyFee, $vatRate) {
            $hours = (float) $yearlyEntries
                ->filter(fn (TimeEntry $entry) => (int) $entry->entry_date->year === $chartYear)
                ->sum('hours');

            return $this->billingPoint($hours, $hourlyFee, $vatRate);
        });

        return [
            'currency' => $currency,
            'vatRate' => $vatRate,
            'monthly' => [
                'labels' => collect(range(1, 12))
                    ->map(fn (int $month) => Carbon::create($year, $month, 1)->format('M'))
                    ->all(),
                'points' => $monthly->all(),
                'total' => $this->billingTotals($monthly),
            ],
            'quarterly' => [
                'labels' => ['Q1', 'Q2', 'Q3', 'Q4'],
                'points' => $quarterly->all(),
                'total' => $this->billingTotals($quarterly),
            ],
            'yearly' => [
                'labels' => collect(range($yearStart, $year))->map(fn (int $chartYear) => (string) $chartYear)->all(),
                'points' => $yearly->all(),
                'total' => $this->billingTotals($yearly),
            ],
        ];
    }

    private function billingPoint(float $hours, float $hourlyFee, float $vatRate): array
    {
        $exclusiveVat = round($hours * $hourlyFee, 2);

        return [
            'hours' => round($hours, 2),
            'exclusiveVat' => $exclusiveVat,
            'inclusiveVat' => round($exclusiveVat * (1 + $vatRate), 2),
        ];
    }

    private function vatRate(User $user): float
    {
        return max(0, (float) ($user->vat_rate ?? 21)) / 100;
    }

    private function billingTotals($points): array
    {
        return [
            'hours' => round((float) $points->sum('hours'), 2),
            'exclusiveVat' => round((float) $points->sum('exclusiveVat'), 2),
            'inclusiveVat' => round((float) $points->sum('inclusiveVat'), 2),
        ];
    }

    private function emptyBillingCharts(): array
    {
        return [
            'currency' => 'EUR',
            'vatRate' => 0.21,
            'monthly' => ['labels' => [], 'points' => [], 'total' => $this->billingTotals(collect())],
            'quarterly' => ['labels' => [], 'points' => [], 'total' => $this->billingTotals(collect())],
            'yearly' => ['labels' => [], 'points' => [], 'total' => $this->billingTotals(collect())],
        ];
    }
}
