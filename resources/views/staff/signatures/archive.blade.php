@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Archived Expenses" active="Archived Expenses" home="Expenses" :home-route="route('staff.expenses.index')" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.expenses.index')">
            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Amount </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                            <tr>
                                <td class="name">{{ $expense->date }} </td>
                                <td>{{ $expense->category->code }} </td>
                                <td>{{ $expense->name }} - {{ $expense->description }}</td>
                                <td>{{ number_format($expense->amount) }} </td>
                                <td class="text-center">
                                    <x-icons.action-form :route="route('staff.expenses.restore', $expense->id)" aClass="btn btn-sm btn-outline-success border-0"
                                        title="Restore" icon="fas fa-undo" name="restore" />
                                    <x-icons.action-form :route="route('staff.expenses.forceDelete', $expense->id)" icon="fas fa-trash" title="Delete"
                                        method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                        name="force-delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Expenses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $expenses->links() }}
                <x-sweet-alert entity="Expenses" />
            </div>
        </x-white-card>
    </div>
@endsection
