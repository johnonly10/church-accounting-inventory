@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title=" Archive Type" active=" Archive Type" />
        <x-white-card title=" Back to Types" :home-route="route('leader.pepsol-types.index')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or code...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code </th>


                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($types as $type)
                                <tr>
                                    <td class="name">{{ $type->name }} </td>
                                    <td>{{ $type->code }} </td>

                                    <td class="text-center">
                                        <x-icons.action-form :route="route('leader.pepsol-types.restore', $type->id)"
                                            aClass="btn btn-sm btn-outline-success border-0" title="Restore"
                                            icon="fas fa-undo" name="restore" />
                                        <x-icons.action-form :route="route('leader.pepsol-types.forceDelete', $type->id)" icon="fas fa-trash" title="Delete"
                                            method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                            name="force-delete" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Type found.</td>
                                </tr>
                            @endforelse

                        </tbody>


                    </table>
                    {{ $types->links() }}
                    <x-sweet-alert entity="Type" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
