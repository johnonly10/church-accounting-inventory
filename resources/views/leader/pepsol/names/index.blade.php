@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Pepsol Name" active="Pepsol Name" />
        <x-white-card title="Pepsol Name" :create-route="route('leader.pepsol-names.create')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or code...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pepsolNames as $pepsolName)
                                <tr>
                                    <td class="name">{{ $pepsolName->name }}</td>
                                    <td>{{ $pepsolName->code }}</td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('leader.pepsol-names.edit', $pepsolName->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol-names.destroy', $pepsolName->id)" method="DELETE" name="force-delete"
                                            title="Delete" aClass="btn btn-sm btn-outline-danger border-0"
                                            icon="fas fa-trash" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Pepsol Name found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pepsolNames->links() }}
                    <x-sweet-alert entity="Pepsol Name" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
