@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Expenses" active="Expenses" />
        <x-white-card title="Expenses" :create-route="route('staff.expenses.create')" :archive-route="route('staff.expenses.archived')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or description...',
        
            'dateFromLabel' => 'From Date',
            'dateFromName' => 'date_from',
            'dateFromValue' => request('date_from'),
        
            'dateToLabel' => 'To Date',
            'dateToName' => 'date_to',
            'dateToValue' => request('date_to'),
        
            'filter1Label' => 'Category Codes',
            'filter1Name' => 'category_code',
            'filter1Options' => \App\Models\Category::orderBy('code')->pluck('code', 'code')->toArray(),
            'filter1Value' => request('category_code'),
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th> Paid by </th>
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
                                    <td>{{ ucfirst($expense->paid) }} </td>
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
            </div>
        </x-white-card>
    </div>
@endsection
