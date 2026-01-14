@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Leaders" active="Archived Leaders" home="Leader" :home-route="route('staff.leaders.index')" />

        <x-white-card title="Back to Index Page" :home-route="route('staff.leaders.index')">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nickname</th>
                            <th>Cell Name</th>
                            <th>Archived At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($leaders as $leader)
                            <tr>
                                <td class="name">{{ $leader->name }}</td>
                                <td>{{ $leader->nickname }}</td>
                                <td>{{ $leader->cell_name }}</td>
                                <td>{{ $leader->deleted_at->format('M d, Y') }}</td>
                                <td>

                                    <x-icons.action-form :route="route('staff.leaders.restore', $leader->id)" icon="fas fa-undo" title="Restore" name="restore"
                                        aClass="btn btn-sm btn-outline-success border-0" />
                                    <x-icons.action-form :route="route('staff.leaders.forceDelete', $leader->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No archived leaders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-sweet-alert entity="Leader" />
                {{ $leaders->links() }}
            </div>
        </x-white-card>
    </div>
@endsection
