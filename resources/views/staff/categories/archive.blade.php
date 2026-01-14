@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Categories" active="Expense Category" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.categories.index')">

            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Type </th>
                            <th>Code </th>
                            <th>Name</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td> {{ $category->type }}</td>
                                <td>{{ $category->code }} </td>
                                <td class="name">{{ $category->name }} </td>
                                <td class="text-center">
                                    <x-icons.action-form :route="route('staff.categories.restore', $category->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.categories.forceDelete', $category->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
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
        </x-white-card>
    </div>
@endsection
