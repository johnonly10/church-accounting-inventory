<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Report</title>

    <style>
        @page {
            margin: 0.35in 0.6in 0.15in 0.6in;
        }

        @font-face {
            font-family: 'DejaVu Sans';
            src: url("{{ public_path('fonts/DejaVuSans.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #111827;
        }

        .header {
            width: 100%;
            margin-top: 10px;
            text-align: center;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo {
            width: 90px;
        }

        .logo img {
            height: 70px;
            max-width: 90px;
        }

        .header-center {
            text-align: center;
        }

        .org-name {
            font-size: 20px;
            font-weight: bold;
            line-height: 1.2;
        }

        .subtext {
            font-size: 15px;
            margin-top: 2px;
        }

        .report-title {
            margin: 14px 0 6px 0;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        .summary-container {
            display: flex;
            justify-content: space-between;
            margin: 15px 0 10px 0;
            gap: 10px;
            flex-wrap: wrap;
        }

        .summary-card {
            flex: 1;
            min-width: 180px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .summary-label {
            font-size: 11px;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-revenue .summary-value {
            color: #059669;
        }

        .summary-expense .summary-value {
            color: #dc2626;
        }

        .summary-net .summary-value {
            color: {{ $netIncome >= 0 ? '#059669' : '#dc2626' }};
        }

        .summary-count .summary-value {
            color: #2563eb;
        }

        .info-container {
            margin: 12px 0 6px 0;
            font-size: 12px;
            width: 100%;
        }

        .info-row {
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .info-label {
            display: inline-block;
            font-weight: bold;
            width: 150px;
        }

        .info-separator {
            display: inline-block;
            width: 10px;
            text-align: center;
        }

        .info-value {
            display: inline-block;
        }

        table.report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.report-table th,
        table.report-table td {
            border: 1px solid #e5e7eb;
            padding: 6px 5px;
            font-size: 10.5px;
            vertical-align: top;
        }

        table.report-table th {
            background: #f3f4f6;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .muted {
            color: #6b7280;
            font-size: 10.5px;
        }

        .total-row {
            font-weight: bold;
            background: #f9fafb;
        }

        .type-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* .type-revenue {
            background-color: #d1fae5;
            color: #065f46;
        }

        .type-expense {
            background-color: #fee2e2;
            color: #991b1b;
        } */

        .payment-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* .payment-online {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .payment-cash {
            background-color: #fef3c7;
            color: #92400e;
        } */

        .beneficiary-badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 18px;
            font-size: 10px;
            color: #6b7280;
            text-align: center;
        }

        .logo-left {
            width: 70px;
            padding: 0;
            text-align: right;
        }

        .logo-left img {
            height: 80px;
            max-width: 80px;
            margin-right: -60px;
            margin-top: -10px;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-left">
                    <img src="{{ public_path('pdf/left_logo_2.png') }}" alt="Logo">
                </td>

                <td class="header-center">
                    <div class="org-name">EMMANUEL WORLD MISSION CHURCH</div>
                    <div class="subtext">Paradahan 1, Tanza, Cavite</div>
                    <div class="subtext" style="font-style: italic;">"Welcome to the Friendly Church"</div>
                </td>

                <td class="logo" style="text-align:right;">
                    <!-- Right logo space if needed -->
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">Finance Report</div>

    <!-- Summary Cards -->
    {{-- <div class="summary-container">
        <div class="summary-card summary-revenue">
            <div class="summary-label">Total Revenue</div>
            <div class="summary-value">₱{{ number_format((float) $totalRevenue, 2) }}</div>
            <div class="muted">Income</div>
        </div>

        <div class="summary-card summary-expense">
            <div class="summary-label">Total Expense</div>
            <div class="summary-value">₱{{ number_format((float) $totalExpense, 2) }}</div>
            <div class="muted">Outflow</div>
        </div>

        <div class="summary-card summary-net">
            <div class="summary-label">Net Income</div>
            <div class="summary-value">
                {{ $netIncome >= 0 ? '+' : '' }}₱{{ number_format((float) $netIncome, 2) }}
            </div>
            <div class="muted">{{ $netIncome >= 0 ? 'Surplus' : 'Deficit' }}</div>
        </div>

        <div class="summary-card summary-count">
            <div class="summary-label">Total Records</div>
            <div class="summary-value">{{ $financeRecords->count() }}</div>
            <div class="muted">Transactions</div>
        </div>
    </div> --}}

    <!-- Report Information -->
    <div class="info-container">
        <div class="info-row">
            <span class="info-label">Report Generated</span>
            <span class="info-separator">:</span>
            <span class="info-value">{{ $generatedAt }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Period Covered</span>
            <span class="info-separator">:</span>
            <span class="info-value">
                @if ($dateFromLabel !== 'N/A' || $dateToLabel !== 'N/A')
                    {{ $dateFromLabel }} to {{ $dateToLabel }}
                @else
                    N/A
                @endif
            </span>
        </div>

        @if ($selectedPaymentMethod && $selectedPaymentMethod !== '')
            <div class="info-row">
                <span class="info-label">Payment Method</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $paymentMethodLabel }}</span>
            </div>
        @endif

        <div class="info-row">
            <span class="info-label">Report Type</span>
            <span class="info-separator">:</span>
            <span class="info-value">Combined Revenue & Expense Report</span>
        </div>
    </div>

    <!-- Finance Table -->
    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 30px;">#</th>
                <th style="width: 65px;">Type</th>
                <th style="width: 75px;">Date</th>
                <th style="width: 120px;">Category</th>
                <th>Details</th>
                @if (!$selectedPaymentMethod || $selectedPaymentMethod == '')
                    <th style="width: 65px;">Payment</th>
                @endif
                <th style="width: 95px;">Amount</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($financeRecords as $index => $record)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>

                    <td class="text-center">
                        <span class="type-badge type-{{ $record->type }}">
                            {{ ucfirst($record->type) }}
                        </span>
                        @if ($record->type === 'revenue' && $record->beneficiary)
                            <div class="beneficiary-badge" style="margin-top: 3px;">
                                {{ ucfirst($record->beneficiary) }}
                            </div>
                        @endif
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}
                        <div class="muted">{{ \Carbon\Carbon::parse($record->date)->format('D') }}</div>
                    </td>

                    <td>{{ $record->category ?? 'N/A' }}</td>

                    <td>{{ $record->details ?? '—' }}</td>

                    @if (!$selectedPaymentMethod || $selectedPaymentMethod == '')
                        <td class="text-center">
                            <span class="payment-badge payment-{{ $record->payment_method }}">
                                {{ ucfirst($record->payment_method) }}
                            </span>
                        </td>
                    @endif

                    <td class="text-right">
                        <span
                            style="color: {{ $record->type === 'revenue' ? '#059669' : '#dc2626' }}; font-weight: bold;">
                            {{ $record->type === 'revenue' ? '+' : '-' }}₱{{ number_format((float) $record->amount, 2) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    @php
                        $colspan = 6;
                        if (!$selectedPaymentMethod || $selectedPaymentMethod == '') {
                            $colspan++;
                        }
                    @endphp
                    <td colspan="{{ $colspan }}" class="text-center">
                        No finance records found for the selected period.
                    </td>
                </tr>
            @endforelse

            @if ($financeRecords->count() > 0)
                <!-- Revenue Total -->
                <tr class="total-row">
                    @php
                        $colspanForLabel = 4;
                        $colspanForLabel += 1;
                        if (!$selectedPaymentMethod || $selectedPaymentMethod == '') {
                            $colspanForLabel += 1;
                        }
                    @endphp
                    <td colspan="{{ $colspanForLabel }}">
                        <strong>Total Revenue</strong>
                    </td>
                    <td class="text-right" style="color: #059669;">
                        <strong>+₱{{ number_format((float) $totalRevenue, 2) }}</strong>
                    </td>
                </tr>

                <!-- Expense Total -->
                <tr class="total-row">
                    <td colspan="{{ $colspanForLabel }}">
                        <strong>Total Expense</strong>
                    </td>
                    <td class="text-right" style="color: #dc2626;">
                        <strong>-₱{{ number_format((float) $totalExpense, 2) }}</strong>
                    </td>
                </tr>

                <!-- Net Income -->
                <tr class="total-row" style="background-color: #f0f9ff;">
                    <td colspan="{{ $colspanForLabel }}">
                        <strong>Net Income</strong>
                    </td>
                    <td class="text-right" style="color: {{ $netIncome >= 0 ? '#059669' : '#dc2626' }};">
                        <strong>{{ $netIncome >= 0 ? '+' : '' }}₱{{ number_format((float) $netIncome, 2) }}</strong>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Signatures -->
    <table class="signatures-table" style="width: 100%; margin-top: 30px; border-collapse: collapse; border: none;">
        @php
            $allSignatures = collect([
                (object) [
                    'label' => 'Prepared By',
                    'name' => auth()->user()->name,
                    'position' => auth()->user()->position,
                ],
            ])->merge($signatures);

            $chunks = $allSignatures->chunk(3);
        @endphp

        @foreach ($chunks as $chunk)
            <tr>
                @foreach ($chunk as $sig)
                    <td style="width: 33.33%; vertical-align: top; text-align: center; border: none; padding: 0 10px;">
                        <div class="signature-block" style="margin-bottom: 20px;">
                            <div style="font-weight: bold; margin-bottom: 5px;">{{ $sig->label }}:</div>
                            <div style="height: 40px;">&nbsp;</div>
                            <div
                                style="border-top: 1px solid #000; display: inline-block; min-width: 180px; padding-top: 5px;">
                                <strong>{{ $sig->name }}</strong>
                                @if ($sig->position)
                                    <div style="font-size: 10px; color: #6b7280;">{{ $sig->position->name }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                @endforeach

                @for ($i = $chunk->count(); $i < 3; $i++)
                    <td style="width: 33.33%; vertical-align: top; text-align: center; border: none; padding: 0 10px;">
                        &nbsp;
                    </td>
                @endfor
            </tr>
        @endforeach
    </table>

</body>

</html>
