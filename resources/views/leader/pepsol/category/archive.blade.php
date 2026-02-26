@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title=" Archive Category" active=" Archive Category" />
        <x-white-card title=" Back to Categories" :home-route="route('leader.pepsol-categories.index')" :showFilters="true" :filterProps="[
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
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="name">{{ $category->name }} </td>
                                    <td>{{ $category->code }} </td>

                                    <td class="text-center">
                                        <x-icons.action-form :route="route('leader.pepsol-categories.restore', $category->id)"
                                            aClass="btn btn-sm btn-outline-success border-0" title="Restore"
                                            icon="fas fa-undo" name="restore" />
                                        <x-icons.action-form :route="route('leader.pepsol-categories.forceDelete', $category->id)" icon="fas fa-trash" title="Delete"
                                            method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                            name="force-delete" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Category found.</td>
                                </tr>
                            @endforelse

                        </tbody>


                    </table>
                    {{ $categories->links() }}
                    <x-sweet-alert entity="Category" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
