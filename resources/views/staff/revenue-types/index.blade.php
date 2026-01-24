@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Revenue Type" active="Revenue Type" />
        <x-white-card title="Revenue Type" :create-route="route('staff.revenue-types.create')" :archive-route="route('staff.revenue-types.archived')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by Revenue Type...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($revenue_types as $revenue_type)
                                <tr>
                                    <td class="name">{{ $revenue_type->name }} </td>

                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('staff.revenue-types.edit', $revenue_type->id)" />
                                        <x-icons.action-form :route="route('staff.revenue-types.archive', $revenue_type->id)" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No Revenue Type found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $revenue_types->links() }}
                    <x-sweet-alert entity="Revenue Type" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
