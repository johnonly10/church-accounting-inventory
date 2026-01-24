@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Position" active="Archive" home="Position" :home-route="route('staff.positions.index')" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.positions.index')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search Archived Positions...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($positions as $position)
                                <tr>
                                    <td class="name">{{ $position->name }} </td>

                                    <td class="text-center">
                                        <x-icons.action-form :route="route('staff.positions.restore', $position->id)"
                                            aClass="btn btn-sm btn-outline-success border-0" title="Restore"
                                            icon="fas fa-undo" name="restore" />
                                        <x-icons.action-form :route="route('staff.positions.forceDelete', $position->id)" icon="fas fa-trash" title="Delete"
                                            method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                            name="force-delete" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="1" class="text-center">No position found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $positions->links() }}
                    <x-sweet-alert entity="Position" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
