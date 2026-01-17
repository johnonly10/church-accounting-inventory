@extends('layouts.staff')

@section('content')
    <div class="container-fliud p-0">
        <x-page-title title="Archived Revenue" active="Archived Revenue" home="Revenue" :home-route="route('staff.revenues.index')" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.revenues.index')">
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
                                    <x-icons.action-form :route="route('staff.revenues.restore', $revenue->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.revenues.forceDelete', $revenue->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center"> No revenue found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    {{ $revenues->links() }}
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
