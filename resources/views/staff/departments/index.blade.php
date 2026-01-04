@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Department" active="Department" />
        <x-white-card title="Department" :create-route="route('staff.departments.create')" :archive-route="route('staff.departments.archived')">

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
                                    <x-icons.action-edit :route="route('staff.departments.edit', $department->id)" />
                                    <x-icons.action-form :route="route('staff.departments.archive', $department->id)" />
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
