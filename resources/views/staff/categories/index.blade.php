@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title=" Category" active=" Category" />
        <x-white-card title=" Category" :create-route="route('staff.categories.create')" :archive-route="route('staff.categories.archived')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or code...',
        
            'filter1Label' => 'Filter by Type',
            'filter1Name' => 'type',
            'filter1Value' => request('type'), // Explicit - shows selected
            'filter1Options' => \App\Models\Category::getTypeOptions(),
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type </th>
                                <th>Code </th>
                                <th>Name</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ ucfirst($category->type) }} </td>
                                    <td>{{ $category->code }} </td>
                                    <td class="name">{{ $category->name }} </td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('staff.categories.edit', $category->id)" />
                                        <x-icons.action-form :route="route('staff.categories.archive', $category->id)" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Category found.</td>
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
