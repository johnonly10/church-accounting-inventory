@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Position" active="Position" />
        <x-white-card title="Position" :create-route="route('staff.positions.create')" :archive-route="route('staff.positions.archived')">

            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($positions as $position)
                            <tr>
                                <td class="name">{{ $position->name }} </td>

                                <td class="text-center">
                                    <x-icons.action-edit :route="route('staff.positions.edit', $position->id)" />
                                    <x-icons.action-form :route="route('staff.positions.archive', $position->id)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No position found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $positions->links() }}
                <x-sweet-alert entity="position" />
            </div>
        </x-white-card>
    </div>
@endsection
