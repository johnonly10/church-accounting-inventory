@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title=" Types" active=" Types" />
        <x-white-card title=" Type" :create-route="route('leader.pepsol-types.create')" :archive-route="route('leader.pepsol-types.archived')" :showFilters="true" :filterProps="[
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
                                        <x-icons.action-edit :route="route('leader.pepsol-types.edit', $type->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol-types.archive', $type->id)" />
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
