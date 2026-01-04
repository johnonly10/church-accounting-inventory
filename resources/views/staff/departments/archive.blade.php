@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Department" active="Department" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.departments.index')">

            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($departments as $department)
                            <tr>
                                <td class="name">{{ $department->name }} </td>

                                <td class="text-center">

                                    <x-icons.action-form :route="route('staff.departments.restore', $department->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.departments.forceDelete', $department->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1" class="text-center">No departments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-sweet-alert entity="Department" />
            </div>
        </x-white-card>
    </div>
@endsection
