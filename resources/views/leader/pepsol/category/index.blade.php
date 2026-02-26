@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title=" Category" active=" Category" />
        <x-white-card title=" Category" :create-route="route('leader.pepsol-categories.create')" :archive-route="route('leader.pepsol-categories.archived')" :showFilters="true" :filterProps="[
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
                                        <x-icons.action-edit :route="route('leader.pepsol-categories.edit', $category->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol-categories.archive', $category->id)" />
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
