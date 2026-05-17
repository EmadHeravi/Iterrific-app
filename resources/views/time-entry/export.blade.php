<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Time Entry Overview - {{ $monthLabel }}</title>
    <style>
        @page {
            margin: 18mm 14mm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            color: #344767;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.45;
            margin: 0;
        }

        .export-page {
            margin: 0 auto;
            max-width: 980px;
            padding: 28px;
        }

        .export-header {
            align-items: flex-start;
            border-bottom: 3px solid #fb8c00;
            display: flex;
            justify-content: space-between;
            margin-bottom: 22px;
            padding-bottom: 16px;
        }

        .export-brand {
            align-items: flex-start;
            display: flex;
            gap: 14px;
        }

        .export-logo {
            height: 42px;
            width: auto;
        }

        .export-kicker {
            color: #fb8c00;
            font-size: 11px;
            font-weight: 700;
            margin: 0 0 6px;
            text-transform: uppercase;
        }

        h1 {
            font-size: 25px;
            line-height: 1.1;
            margin: 0 0 6px;
        }

        .export-user {
            color: #67748e;
            margin: 0;
        }

        .export-period {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            min-width: 170px;
            padding: 12px 14px;
            text-align: right;
        }

        .export-period span,
        .export-total span {
            color: #67748e;
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .export-period strong,
        .export-total strong {
            color: #344767;
            display: block;
            font-size: 18px;
            margin-top: 4px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background: #f8f9fa;
            color: #67748e;
            font-size: 10px;
            text-align: left;
            text-transform: uppercase;
        }

        th,
        td {
            border-bottom: 1px solid #e9ecef;
            padding: 9px 8px;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background: #fcfcfd;
        }

        .text-right {
            text-align: right;
        }

        .status {
            border-radius: 999px;
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            text-transform: uppercase;
        }

        .status-approved {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-submitted {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-draft {
            background: #f3f4f6;
            color: #4b5563;
        }

        .status-declined {
            background: #ffebee;
            color: #c62828;
        }

        .export-total {
            align-items: center;
            border-top: 3px solid #fb8c00;
            display: flex;
            justify-content: flex-end;
            gap: 18px;
            margin-top: 24px;
            padding-top: 14px;
        }

        .empty-state {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            color: #67748e;
            padding: 22px;
            text-align: center;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .export-page {
                max-width: none;
                padding: 0;
            }

        }
    </style>
</head>
<body>
    <main class="export-page">
        <header class="export-header">
            <div class="export-brand">
                @if($logoPath)
                    <img class="export-logo" src="{{ $logoPath }}" alt="ITerrific">
                @endif
                <div>
                    <p class="export-kicker">Time Entry Overview</p>
                    <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="export-user">{{ $user->email }}</p>
                </div>
            </div>
            <div class="export-period">
                <span>Month</span>
                <strong>{{ $monthLabel }}</strong>
            </div>
        </header>

        @if($entries->isEmpty())
            <div class="empty-state">
                No worked hours registered for {{ $monthLabel }}.
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Project</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-right">Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->entry_date->format('d/m/Y') }}</td>
                            <td>{{ $entry->entry_date->format('l') }}</td>
                            <td>
                                <strong>{{ $entry->project->name }}</strong><br>
                                {{ $entry->project->company_name }}
                            </td>
                            <td>{{ $entry->description }}</td>
                            <td>
                                <span class="status status-{{ $entry->status }}">
                                    {{ ucfirst($entry->status) }}
                                </span>
                            </td>
                            <td class="text-right">{{ number_format($entry->hours, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <footer class="export-total">
                <span>Total Worked Hours</span>
                <strong>{{ number_format($totalHours, 2) }}</strong>
            </footer>
        @endif
    </main>
</body>
</html>
