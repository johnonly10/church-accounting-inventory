@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Expense Category" active="Expense Category" />
        <x-white-card title="Expense Category" :create-route="route('staff.expense-categories.create')" :archive-route="route('staff.expense-categories.archived')">



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
                                    <x-icons.action-edit :route="route('staff.expense-categories.edit', $ecategory->id)" />
                                    <x-icons.action-form :route="route('staff.expense-categories.archive', $ecategory->id)" />
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
