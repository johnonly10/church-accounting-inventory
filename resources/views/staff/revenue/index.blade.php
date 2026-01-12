@extends('layouts.staff')

@section('content')
    <div class="container-fliud p-0">
        <x-page-title title="Revenue" active="Revenue" />
        <x-white-card title="Revenue" :create-route="route('staff.revenues.create')" :archive-route="route('staff.revenues.archived')">
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
                                <td>{{ $revenue->types }} </td>
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
            </div>
        </x-white-card>
        <x-sweet-alert entity="Revenue" />
    </div>
@endsection

@push('styles')
    <style>

    </style>
@endpush
