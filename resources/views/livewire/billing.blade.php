<div class="container-fluid py-4">
    <div class="page-header min-height-250 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
        <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
    </div>

    <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
        <div class="row gx-4 align-items-center">
            <div class="col-auto">
                <div class="icon icon-shape icon-xl bg-gradient-warning dynamic-config-gradient shadow text-center border-radius-lg">
                    <i class="material-icons opacity-10 text-white">receipt_long</i>
                </div>
            </div>
            <div class="col-auto my-auto">
                <h5 class="mb-1">Billing</h5>
                <p class="mb-0 text-sm text-secondary">
                    Approved-hour billing analytics for external employees.
                </p>
            </div>
        </div>

        <hr class="horizontal gray-light my-4">

        @if($billingUser)
            <div
                id="billing-chart-data"
                data-billing-charts='@json($billingCharts)'
                wire:key="billing-chart-data-{{ $selectedEmployeeId }}-{{ $selectedYear }}-{{ $selectedMonth }}"
            ></div>

            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-end mb-4">
                <div>
                    <h6 class="mb-1">{{ $billingUser->full_name ?: $billingUser->email }}</h6>
                    <p class="text-sm text-secondary mb-0">
                        {{ $billingCharts['currency'] }} {{ number_format((float) $billingUser->hourly_fee, 2) }} hourly fee, VAT {{ number_format($billingCharts['vatRate'] * 100, 2) }}%.
                    </p>
                </div>

                <div class="d-flex flex-column flex-md-row gap-2">
                    @if($canViewAllBilling)
                        <select class="form-control border billing-filter-control" wire:model.live="selectedEmployeeId">
                            @foreach($employeeOptions as $employeeOption)
                                <option value="{{ $employeeOption->id }}">
                                    {{ $employeeOption->full_name ?: $employeeOption->email }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <select class="form-control border billing-filter-control" wire:model.live="selectedMonth">
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}">
                                {{ \Illuminate\Support\Carbon::create(2026, $month, 1)->format('F') }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-control border billing-filter-control" wire:model.live="selectedYear">
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @php
                $monthlyTotal = $billingCharts['monthly']['total'];
                $quarterlyTotal = $billingCharts['quarterly']['total'];
                $yearlyTotal = $billingCharts['yearly']['total'];
                $currency = $billingCharts['currency'];
            @endphp

            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="billing-info-box h-100">
                        <p class="text-xs text-secondary mb-1">Selected Year Hours</p>
                        <h5 class="mb-0">{{ number_format($monthlyTotal['hours'], 2) }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="billing-info-box h-100">
                        <p class="text-xs text-secondary mb-1">Year Excl. VAT</p>
                        <h5 class="mb-0">{{ $currency }} {{ number_format($monthlyTotal['exclusiveVat'], 2) }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="billing-info-box h-100">
                        <p class="text-xs text-secondary mb-1">Year Incl. VAT</p>
                        <h5 class="mb-0">{{ $currency }} {{ number_format($monthlyTotal['inclusiveVat'], 2) }}</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="billing-info-box h-100">
                        <p class="text-xs text-secondary mb-1">Selected Month</p>
                        <h5 class="mb-0">{{ $monthLabel }}</h5>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="billing-monthly-chart" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">Monthly Billing</h6>
                            <p class="text-sm mb-0">
                                {{ number_format($monthlyTotal['hours'], 2) }} hours, {{ $currency }} {{ number_format($monthlyTotal['exclusiveVat'], 2) }} excl. VAT.
                            </p>
                            <hr class="dark horizontal">
                            <div class="d-flex">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">{{ $selectedYear }} monthly overview</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="billing-quarterly-chart" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">Quarterly Billing</h6>
                            <p class="text-sm mb-0">
                                {{ number_format($quarterlyTotal['hours'], 2) }} hours, {{ $currency }} {{ number_format($quarterlyTotal['inclusiveVat'], 2) }} incl. VAT.
                            </p>
                            <hr class="dark horizontal">
                            <div class="d-flex">
                                <i class="material-icons text-sm my-auto me-1">date_range</i>
                                <p class="mb-0 text-sm">{{ $selectedYear }} quarter totals</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="billing-yearly-chart" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">Yearly Billing</h6>
                            <p class="text-sm mb-0">
                                {{ number_format($yearlyTotal['hours'], 2) }} hours across the shown years.
                            </p>
                            <hr class="dark horizontal">
                            <div class="d-flex">
                                <i class="material-icons text-sm my-auto me-1">query_stats</i>
                                <p class="mb-0 text-sm">Five-year trend</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($canViewAllBilling)
                <div class="mt-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-end mb-3">
                        <div>
                            <h6 class="mb-1">External Employees</h6>
                            <p class="text-sm text-secondary mb-0">
                                Approved hours and estimated billing for {{ $monthLabel }}.
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Hourly Fee</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">VAT %</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Approved Hours</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Excl. VAT</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Incl. VAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($externalEmployees as $employee)
                                    @php
                                        $approvedHours = (float) ($employee->approved_hours ?? 0);
                                        $hourlyFee = (float) ($employee->hourly_fee ?? 0);
                                        $employeeCurrency = $employee->hourly_fee_currency ?: 'EUR';
                                        $employeeVatRate = max(0, (float) ($employee->vat_rate ?? 21)) / 100;
                                        $exclusiveVat = $approvedHours * $hourlyFee;
                                    @endphp
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $employee->full_name ?: $employee->email }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $employee->email }}</p>
                                        </td>
                                        <td>
                                            <span class="text-sm">{{ $employee->company_name ?: '-' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-sm font-weight-bold">
                                                {{ $employeeCurrency }} {{ number_format($hourlyFee, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-sm">{{ number_format($employeeVatRate * 100, 2) }}%</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-sm">{{ number_format($approvedHours, 2) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-sm font-weight-bold">
                                                {{ $employeeCurrency }} {{ number_format($exclusiveVat, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-sm font-weight-bold">
                                                {{ $employeeCurrency }} {{ number_format($exclusiveVat * (1 + $employeeVatRate), 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-secondary py-4">
                                            No external employees found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="row mt-4">
                    <div class="col-lg-4 mb-4">
                        <div class="billing-info-box h-100">
                            <p class="text-xs text-secondary mb-1">Billing Profile</p>
                            <h6 class="mb-0">{{ $billingUser->full_name ?: $billingUser->email }}</h6>
                            <p class="text-sm text-secondary mb-0">{{ ucfirst($billingUser->user_type) }} employee</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="billing-info-box h-100">
                            <p class="text-xs text-secondary mb-1">Company</p>
                            <h6 class="mb-0">{{ $billingUser->company_name ?: '-' }}</h6>
                            <p class="text-sm text-secondary mb-0">{{ $billingUser->vat_number ?: 'No VAT number' }}</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="billing-info-box h-100">
                            <p class="text-xs text-secondary mb-1">Bank Account</p>
                            <h6 class="mb-0">{{ $billingUser->bank_name ?: '-' }}</h6>
                            <p class="text-sm text-secondary mb-0">{{ $billingUser->iban ?: 'No IBAN on profile' }}</p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning text-white mb-0">
                    Billing rates are managed by ITerrific administrators. Keep your company, VAT and bank details up to date in User Profile.
                </div>
            @endif
        @else
            <div class="alert alert-warning text-white mb-0">
                Billing analytics are available for external employees.
            </div>
        @endif
    </div>
</div>

@push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <script>
        window.iterrificBillingCharts = window.iterrificBillingCharts || {};

        function billingChartOptions(showGrid) {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const datasetLabel = context.dataset.label || '';
                                const value = Number(context.parsed.y || 0);

                                if (datasetLabel.includes('Hours')) {
                                    return datasetLabel + ': ' + value.toFixed(2);
                                }

                                const currency = context.chart.$billingCurrency || '';
                                return datasetLabel + ': ' + currency + ' ' + value.toFixed(2);
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            beginAtZero: true,
                            color: "#fff",
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: showGrid,
                            drawOnChartArea: showGrid,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            };
        }

        function billingDatasets(points) {
            return [
                {
                    label: 'Hours',
                    type: 'bar',
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: 'rgba(255, 255, 255, .45)',
                    data: points.map((point) => point.hours),
                    maxBarThickness: 8,
                },
                {
                    label: 'Excl. VAT',
                    type: 'line',
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(255, 255, 255, .9)',
                    pointBorderColor: 'transparent',
                    borderColor: 'rgba(255, 255, 255, .9)',
                    borderWidth: 4,
                    backgroundColor: 'transparent',
                    data: points.map((point) => point.exclusiveVat),
                },
                {
                    label: 'Incl. VAT',
                    type: 'line',
                    tension: 0.35,
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(255, 255, 255, .55)',
                    pointBorderColor: 'transparent',
                    borderColor: 'rgba(255, 255, 255, .55)',
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    data: points.map((point) => point.inclusiveVat),
                },
            ];
        }

        function renderBillingChart(canvasId, labels, points, currency, showGrid) {
            const canvas = document.getElementById(canvasId);

            if (!canvas || !window.Chart) {
                return;
            }

            if (window.iterrificBillingCharts[canvasId]) {
                window.iterrificBillingCharts[canvasId].destroy();
            }

            const chart = new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: billingDatasets(points),
                },
                options: billingChartOptions(showGrid),
            });

            chart.$billingCurrency = currency;
            window.iterrificBillingCharts[canvasId] = chart;
        }

        function initBillingCharts() {
            const chartDataElement = document.getElementById('billing-chart-data');

            if (!chartDataElement) {
                return;
            }

            const chartData = JSON.parse(chartDataElement.dataset.billingCharts || '{}');
            const currency = chartData.currency || '';

            renderBillingChart('billing-monthly-chart', chartData.monthly?.labels || [], chartData.monthly?.points || [], currency, true);
            renderBillingChart('billing-quarterly-chart', chartData.quarterly?.labels || [], chartData.quarterly?.points || [], currency, false);
            renderBillingChart('billing-yearly-chart', chartData.yearly?.labels || [], chartData.yearly?.points || [], currency, false);
        }

        document.addEventListener('DOMContentLoaded', initBillingCharts);
        document.addEventListener('livewire:initialized', () => {
            initBillingCharts();

            Livewire.hook('morph.updated', () => {
                setTimeout(initBillingCharts, 50);
            });
        });
    </script>
@endpush
