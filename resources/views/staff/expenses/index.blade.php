@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Expenses" active="Expenses" />
        <x-white-card title="Expenses" :create-route="route('staff.expenses.create')" :archive-route="route('staff.expenses.archived')">
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
                                <td class="name">{{ $expense->date->toDateString() }} </td>
                                <td>{{ $expense->category->code }} </td>
                                <td>{{ $expense->name }} - {{ $expense->description }}</td>
                                <td>₱{{ number_format($expense->amount, 2) }} </td>
                                <td class="text-center">
                                    <x-icons.action-edit :route="route('staff.expenses.edit', $expense->id)" />
                                    <x-icons.action-form :route="route('staff.expenses.archive', $expense->id)" />
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
