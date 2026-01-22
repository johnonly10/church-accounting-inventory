@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Ministry" active="Archive" home="Ministry" :home-route="route('staff.ministries.index')" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.ministries.index')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search Archived Ministries...',
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
                            @forelse ($ministries as $ministry)
                                <tr>
                                    <td class="name">{{ $ministry->name }} </td>

                                    <td class="text-center">
                                        <x-icons.action-form :route="route('staff.ministries.restore', $ministry->id)"
                                            aClass="btn btn-sm btn-outline-success border-0" title="Restore"
                                            icon="fas fa-undo" name="restore" />
                                        <x-icons.action-form :route="route('staff.ministries.forceDelete', $ministry->id)" icon="fas fa-trash" title="Delete"
                                            method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                            name="force-delete" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No ministry found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $ministries->links() }}
                    <x-sweet-alert entity="Ministry" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
