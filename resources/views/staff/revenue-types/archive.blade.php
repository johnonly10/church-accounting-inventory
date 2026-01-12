@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Revenue Type" active=" Archived Revenue Type" home="Revenue Type" :home-route="route('staff.revenue-types.index')" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.revenue-types.index')">

            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($revenue_types as $revenue_type)
                            <tr>
                                <td class="name">{{ $revenue_type->name }} </td>

                                <td class="text-center">
                                    <x-icons.action-form :route="route('staff.revenue-types.restore', $revenue_type->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.revenue-type.forceDelete', $revenue_type->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No Revenue Type found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-sweet-alert entity="Revenue Type" />
            </div>
        </x-white-card>
    </div>
@endsection
