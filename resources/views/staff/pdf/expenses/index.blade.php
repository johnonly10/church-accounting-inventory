<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Reports</title>

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
            padding: 7px 8px;
            font-size: 11.5px;
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

        .logo-left,
        .logo-right {
            width: 70px;
            padding: 0;
        }

        .logo-left {
            text-align: right;
        }

        .logo-left img {
            height: 80px;
            max-width: 80px;
            margin-right: -60px;
            margin-top: -10px;
        }

        .signature-line {
            border-top: 1px solid #111827;
            margin-top: 40px;
            width: 200px;
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

                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">Expense Reports</div>

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

        @if ($selectedCategory)
            <div class="info-row">
                <span class="info-label">Category</span>
                <span class="info-separator">:</span>
                <span class="info-value">
                    {{ $selectedCategory->code }} - {{ $selectedCategory->name }}
                </span>
            </div>
        @endif

        @if ($selectedPaid && $selectedPaid !== '')
            <div class="info-row">
                <span class="info-label">Paid Through</span>
                <span class="info-separator">:</span>
                <span class="info-value">{{ $paidLabel }}</span>
            </div>
        @endif

        <div class="info-row">
            <span class="info-label">Total Records</span>
            <span class="info-separator">:</span>
            <span class="info-value">{{ $expenses->count() }}</span>
        </div>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 90px;">Date</th>

                @if (!$selectedCategory)
                    <th style="width: 140px;">Category</th>
                @endif

                <th>Details</th>

                @if (!$selectedPaid || $selectedPaid == '')
                    <th style="width: 100px;">Paid Through</th>
                @endif

                <th style="width: 110px;">Amount</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                        <div class="muted">{{ \Carbon\Carbon::parse($expense->date)->format('D') }}</div>
                    </td>

                    @if (!$selectedCategory)
                        <td>
                            <div><strong>{{ $expense->category?->code ?? 'N/A' }}</strong></div>
                            <div class="muted">{{ $expense->category?->name ?? 'Uncategorized' }}</div>
                        </td>
                    @endif

                    <td>
                        <div><strong>{{ $expense->name ?? '—' }}</strong></div>
                        @if (!empty($expense->description))
                            <div class="muted">{{ $expense->description }}</div>
                        @endif
                    </td>

                    @if (!$selectedPaid || $selectedPaid == '')
                        <td class="text-center">
                            @if ($expense->paid == 'online')
                                <span>Online</span>
                            @elseif ($expense->paid == 'cash')
                                <span>Cash</span>
                            @else
                                <span class="muted">{{ ucfirst($expense->paid) }}</span>
                            @endif
                        </td>
                    @endif

                    <td class="text-right">
                        ₱{{ number_format((float) $expense->amount, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    @php
                        $colspan = 2;
                        if (!$selectedCategory) {
                            $colspan++;
                        }
                        if (!$selectedPaid || $selectedPaid == '') {
                            $colspan++;
                        }
                        $colspan++;
                    @endphp
                    <td colspan="{{ $colspan }}" class="text-center">
                        No records found.
                    </td>
                </tr>
            @endforelse

            @if ($expenses->count() > 0)
                <tr class="total-row">
                    @php
                        $colspanForLabel = 1;
                        $colspanForLabel += 1;
                        if (!$selectedCategory) {
                            $colspanForLabel += 1;
                        }
                        if (!$selectedPaid || $selectedPaid == '') {
                            $colspanForLabel += 1;
                        }
                    @endphp
                    <td colspan="{{ $colspanForLabel }}">
                        <strong>Grand Total</strong>
                    </td>
                    <td class="text-right">
                        <strong>₱{{ number_format((float) $grandTotal, 2) }}</strong>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

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
