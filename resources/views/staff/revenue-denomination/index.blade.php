@extends('layouts.staff')

@section('content')
    @php
        function showIfPositive($v, $zero = '')
        {
            $v = $v ?? 0;
            return $v > 0 ? $v : $zero;
        }

        function hasAnyValue($collection, $field): bool
        {
            return $collection->contains(fn($r) => !empty($r->$field) && (float) $r->$field > 0);
        }

        $show_bill_1000 = hasAnyValue($revenueCashCounts, 'bill_1000');
        $show_bill_500 = hasAnyValue($revenueCashCounts, 'bill_500');
        $show_bill_200 = hasAnyValue($revenueCashCounts, 'bill_200');
        $show_bill_100 = hasAnyValue($revenueCashCounts, 'bill_100');
        $show_bill_50 = hasAnyValue($revenueCashCounts, 'bill_50');
        $show_bill_20 = hasAnyValue($revenueCashCounts, 'bill_20');

        $show_coin_20 = hasAnyValue($revenueCashCounts, 'coin_20');
        $show_coin_10 = hasAnyValue($revenueCashCounts, 'coin_10');
        $show_coin_5 = hasAnyValue($revenueCashCounts, 'coin_5');
        $show_coin_1 = hasAnyValue($revenueCashCounts, 'coin_1');

        $show_cent_25 = hasAnyValue($revenueCashCounts, 'centimo_25');
        $show_cent_10 = hasAnyValue($revenueCashCounts, 'centimo_10');
        $show_cent_5 = hasAnyValue($revenueCashCounts, 'centimo_5');
        $show_cent_1 = hasAnyValue($revenueCashCounts, 'centimo_1');
    @endphp

    <div class="container-fluid p-0">
        <x-page-title title="Revenue Denomination" active="Revenue Denomination" />

        <x-white-card title="Revenue Denomination" :create-route="route('staff.revenue-cash-counts.create')" :showFilters="true" :filterProps="[
            'dateFromLabel' => 'From Date',
            'dateFromName' => 'date_from',
            'dateFromValue' => request('date_from'),
        
            'dateToLabel' => 'To Date',
            'dateToName' => 'date_to',
            'dateToValue' => request('date_to'),
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>

                                @if ($show_bill_1000)
                                    <th>₱1000</th>
                                @endif
                                @if ($show_bill_500)
                                    <th>₱500</th>
                                @endif
                                @if ($show_bill_200)
                                    <th>₱200</th>
                                @endif
                                @if ($show_bill_100)
                                    <th>₱100</th>
                                @endif
                                @if ($show_bill_50)
                                    <th>₱50</th>
                                @endif
                                @if ($show_bill_20)
                                    <th>₱20</th>
                                @endif

                                @if ($show_coin_20)
                                    <th>₱20c</th>
                                @endif
                                @if ($show_coin_10)
                                    <th>₱10c</th>
                                @endif
                                @if ($show_coin_5)
                                    <th>₱5c</th>
                                @endif
                                @if ($show_coin_1)
                                    <th>₱1c</th>
                                @endif

                                @if ($show_cent_25)
                                    <th>25¢</th>
                                @endif
                                @if ($show_cent_10)
                                    <th>10¢</th>
                                @endif
                                @if ($show_cent_5)
                                    <th>5¢</th>
                                @endif
                                @if ($show_cent_1)
                                    <th>1¢</th>
                                @endif

                                <th class="text-end">Total</th>
                                <th>Action </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $pageGrandTotal = 0;

                                $sum_bill_1000 = 0;
                                $sum_bill_500 = 0;
                                $sum_bill_200 = 0;
                                $sum_bill_100 = 0;
                                $sum_bill_50 = 0;
                                $sum_bill_20 = 0;

                                $sum_coin_20 = 0;
                                $sum_coin_10 = 0;
                                $sum_coin_5 = 0;
                                $sum_coin_1 = 0;

                                $sum_centimo_25 = 0;
                                $sum_centimo_10 = 0;
                                $sum_centimo_5 = 0;
                                $sum_centimo_1 = 0;
                            @endphp

                            @forelse ($revenueCashCounts as $row)
                                @php
                                    $total =
                                        $row->bill_1000 * 1000 +
                                        $row->bill_500 * 500 +
                                        $row->bill_200 * 200 +
                                        $row->bill_100 * 100 +
                                        $row->bill_50 * 50 +
                                        $row->bill_20 * 20 +
                                        $row->coin_20 * 20 +
                                        $row->coin_10 * 10 +
                                        $row->coin_5 * 5 +
                                        $row->coin_1 * 1 +
                                        $row->centimo_25 * 0.25 +
                                        $row->centimo_10 * 0.1 +
                                        $row->centimo_5 * 0.05 +
                                        $row->centimo_1 * 0.01;

                                    $pageGrandTotal += $total;

                                    $sum_bill_1000 += $row->bill_1000;
                                    $sum_bill_500 += $row->bill_500;
                                    $sum_bill_200 += $row->bill_200;
                                    $sum_bill_100 += $row->bill_100;
                                    $sum_bill_50 += $row->bill_50;
                                    $sum_bill_20 += $row->bill_20;

                                    $sum_coin_20 += $row->coin_20;
                                    $sum_coin_10 += $row->coin_10;
                                    $sum_coin_5 += $row->coin_5;
                                    $sum_coin_1 += $row->coin_1;

                                    $sum_centimo_25 += $row->centimo_25;
                                    $sum_centimo_10 += $row->centimo_10;
                                    $sum_centimo_5 += $row->centimo_5;
                                    $sum_centimo_1 += $row->centimo_1;
                                @endphp

                                <tr>
                                    <td>{{ $row->date ? \Carbon\Carbon::parse($row->date)->toDateString() : '-' }}</td>

                                    @if ($show_bill_1000)
                                        <td>{{ showIfPositive($row->bill_1000) }}</td>
                                    @endif
                                    @if ($show_bill_500)
                                        <td>{{ showIfPositive($row->bill_500) }}</td>
                                    @endif
                                    @if ($show_bill_200)
                                        <td>{{ showIfPositive($row->bill_200) }}</td>
                                    @endif
                                    @if ($show_bill_100)
                                        <td>{{ showIfPositive($row->bill_100) }}</td>
                                    @endif
                                    @if ($show_bill_50)
                                        <td>{{ showIfPositive($row->bill_50) }}</td>
                                    @endif
                                    @if ($show_bill_20)
                                        <td>{{ showIfPositive($row->bill_20) }}</td>
                                    @endif

                                    @if ($show_coin_20)
                                        <td>{{ showIfPositive($row->coin_20) }}</td>
                                    @endif
                                    @if ($show_coin_10)
                                        <td>{{ showIfPositive($row->coin_10) }}</td>
                                    @endif
                                    @if ($show_coin_5)
                                        <td>{{ showIfPositive($row->coin_5) }}</td>
                                    @endif
                                    @if ($show_coin_1)
                                        <td>{{ showIfPositive($row->coin_1) }}</td>
                                    @endif

                                    @if ($show_cent_25)
                                        <td>{{ showIfPositive($row->centimo_25) }}</td>
                                    @endif
                                    @if ($show_cent_10)
                                        <td>{{ showIfPositive($row->centimo_10) }}</td>
                                    @endif
                                    @if ($show_cent_5)
                                        <td>{{ showIfPositive($row->centimo_5) }}</td>
                                    @endif
                                    @if ($show_cent_1)
                                        <td>{{ showIfPositive($row->centimo_1) }}</td>
                                    @endif

                                    <td class="text-end fw-bold">₱{{ number_format($total, 2) }}</td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('staff.revenue-cash-counts.edit', $row->id)" />
                                    </td>
                                </tr>
                            @empty
                                @php
                                    $colCount =
                                        1 +
                                        ($show_bill_1000 ? 1 : 0) +
                                        ($show_bill_500 ? 1 : 0) +
                                        ($show_bill_200 ? 1 : 0) +
                                        ($show_bill_100 ? 1 : 0) +
                                        ($show_bill_50 ? 1 : 0) +
                                        ($show_bill_20 ? 1 : 0) +
                                        ($show_coin_20 ? 1 : 0) +
                                        ($show_coin_10 ? 1 : 0) +
                                        ($show_coin_5 ? 1 : 0) +
                                        ($show_coin_1 ? 1 : 0) +
                                        ($show_cent_25 ? 1 : 0) +
                                        ($show_cent_10 ? 1 : 0) +
                                        ($show_cent_5 ? 1 : 0) +
                                        ($show_cent_1 ? 1 : 0) +
                                        2;
                                @endphp
                                <tr>
                                    <td colspan="{{ $colCount }}" class="text-center">No Denominations found.</td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if ($revenueCashCounts->count())
                            @php
                                $beforeTotalCols =
                                    1 +
                                    ($show_bill_1000 ? 1 : 0) +
                                    ($show_bill_500 ? 1 : 0) +
                                    ($show_bill_200 ? 1 : 0) +
                                    ($show_bill_100 ? 1 : 0) +
                                    ($show_bill_50 ? 1 : 0) +
                                    ($show_bill_20 ? 1 : 0) +
                                    ($show_coin_20 ? 1 : 0) +
                                    ($show_coin_10 ? 1 : 0) +
                                    ($show_coin_5 ? 1 : 0) +
                                    ($show_coin_1 ? 1 : 0) +
                                    ($show_cent_25 ? 1 : 0) +
                                    ($show_cent_10 ? 1 : 0) +
                                    ($show_cent_5 ? 1 : 0) +
                                    ($show_cent_1 ? 1 : 0);
                            @endphp

                            <tfoot>
                                <tr class="fw-bold">
                                    <th class="text-end">Column Totals</th>

                                    @if ($show_bill_1000)
                                        <th>{{ showIfPositive($sum_bill_1000) }}</th>
                                    @endif
                                    @if ($show_bill_500)
                                        <th>{{ showIfPositive($sum_bill_500) }}</th>
                                    @endif
                                    @if ($show_bill_200)
                                        <th>{{ showIfPositive($sum_bill_200) }}</th>
                                    @endif
                                    @if ($show_bill_100)
                                        <th>{{ showIfPositive($sum_bill_100) }}</th>
                                    @endif
                                    @if ($show_bill_50)
                                        <th>{{ showIfPositive($sum_bill_50) }}</th>
                                    @endif
                                    @if ($show_bill_20)
                                        <th>{{ showIfPositive($sum_bill_20) }}</th>
                                    @endif

                                    @if ($show_coin_20)
                                        <th>{{ showIfPositive($sum_coin_20) }}</th>
                                    @endif
                                    @if ($show_coin_10)
                                        <th>{{ showIfPositive($sum_coin_10) }}</th>
                                    @endif
                                    @if ($show_coin_5)
                                        <th>{{ showIfPositive($sum_coin_5) }}</th>
                                    @endif
                                    @if ($show_coin_1)
                                        <th>{{ showIfPositive($sum_coin_1) }}</th>
                                    @endif

                                    @if ($show_cent_25)
                                        <th>{{ showIfPositive($sum_centimo_25) }}</th>
                                    @endif
                                    @if ($show_cent_10)
                                        <th>{{ showIfPositive($sum_centimo_10) }}</th>
                                    @endif
                                    @if ($show_cent_5)
                                        <th>{{ showIfPositive($sum_centimo_5) }}</th>
                                    @endif
                                    @if ($show_cent_1)
                                        <th>{{ showIfPositive($sum_centimo_1) }}</th>
                                    @endif

                                    <th></th>
                                    <th></th>
                                </tr>

                                <tr class="fw-bold">
                                    <th colspan="{{ $beforeTotalCols }}" class="text-end">Page Total</th>
                                    <th class="text-end">₱{{ number_format($pageGrandTotal, 2) }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </x-white-card>
        <x-sweet-alert entity="Revenue" />
    </div>
@endsection
