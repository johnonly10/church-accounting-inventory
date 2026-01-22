@extends('layouts.staff')

@section('content')
    <div class="container-fliud p-0">
        <x-page-title title="Revenue" active="Revenue" />
        <x-white-card title="Revenue" :create-route="route('staff.revenues.create')" :archive-route="route('staff.revenues.archived')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name...',
        
            'dateFromLabel' => 'From Date',
            'dateFromName' => 'date_from',
            'dateFromValue' => request('date_from'),
        
            'dateToLabel' => 'To Date',
            'dateToName' => 'date_to',
            'dateToValue' => request('date_to'),
        
            'filter1Label' => 'Payment Method',
            'filter1Name' => 'payment_method',
            'filter1Value' => request('payment_method'),
            'filter1Options' => \App\Models\User::getPaymentOptions(),
        
            'filter2Label' => 'Revenue Type',
            'filter2Name' => 'revenue_type',
            'filter2Value' => request('revenue_type'),
            'filter2Options' => $revenueTypes ?? [],
        
            'filter3Label' => 'Beneficiary',
            'filter3Name' => 'beneficiary',
            'filter3Value' => request('beneficiary'),
            'filter3Options' => \App\Models\User::getBeneficiaryOptions(),
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th class="payment-col">Payment</th>
                                <th>Amount </th>
                                <th class="text-center">Action</th>
                            </tr>

                        </thead>

                        <tbody>
                            @forelse ($revenues as $revenue)
                                <tr>
                                    <td>{{ $revenue->revenueCollection->collection_date->format('F d, Y') }} </td>
                                    <td class="name">{{ $revenue->name }} </td>
                                    <td>{{ $revenue->revenueType->name }} </td>
                                    <td>{{ $revenue->payment_method }}</td>
                                    <td>{{ $revenue->amount }}</td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('staff.revenues.edit', $revenue->revenue_collection_id)" />

                                        <x-icons.action-form :route="route('staff.revenues.archive', $revenue->id)" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"> No revenue found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $revenues->links() }}
                </div>
            </div>
        </x-white-card>
        <x-sweet-alert entity="Revenue" />
    </div>
@endsection

@push('styles')
    <style>

    </style>
@endpush
