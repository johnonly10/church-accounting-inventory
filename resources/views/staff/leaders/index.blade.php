@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Leader" active="Leader" />
        <x-white-card title="Leader" :create-route="route('staff.leaders.create')" :archive-route="route('staff.leaders.archived')">
            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nickname</th>
                            <th>Cell Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($leaders as $leader)
                            <tr>
                                <td class="name">{{ $leader->name }} </td>
                                <td>{{ $leader->nickname }} </td>
                                <td>{{ $leader->cell_name }}</td>
                                <td class="text-center">
                                    <x-icons.action-edit :route="route('staff.leaders.edit', $leader)" />
                                    <x-icons.action-form :route="route('staff.leaders.archive', $leader)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No leaders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-sweet-alert entity="Leader" />
            </div>
        </x-white-card>
    </div>
@endsection
