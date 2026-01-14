@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Expense Category" active="Expense Category" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.expense-categories.index')">

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
                        @forelse ($ecategories as $ecategory)
                            <tr>
                                <td class="name">{{ $ecategory->name }} </td>
                                <td>{{ $ecategory->code }} </td>
                                <td class="text-center">
                                    <x-icons.action-form :route="route('staff.expense-categories.restore', $ecategory->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.expense-categories.forceDelete', $ecategory->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Expense Category found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-sweet-alert entity="Expense Category" />
            </div>
        </x-white-card>
    </div>
@endsection
