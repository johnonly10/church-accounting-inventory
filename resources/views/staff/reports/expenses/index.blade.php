@extends('layouts.staff')

@section('content')
    <div class="container-fluid px-4 py-4">
        <x-page-title title="Expense Reports" active="Expense Reports" />

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold text-gray-800">
                        <i class="fas fa-filter me-2"></i>Filter Reports
                    </h6>

                </div>
            </div>

            <div class="card-body p-4">
                <form method="GET" action="{{ route('staff.expense-reports.index') }}" id="filterForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-2 col-md-6">
                            <label for="date_from" class="form-label text-gray-700 fw-medium">From Date</label>
                            <input type="date" class="form-control" id="date_from" name="date_from"
                                value="{{ request('date_from') }}">
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <label for="date_to" class="form-label text-gray-700 fw-medium">To Date</label>
                            <input type="date" class="form-control" id="date_to" name="date_to"
                                value="{{ request('date_to') }}">
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <label for="category_id" class="form-label text-gray-700 fw-medium">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">All Categories</option>

                                @php $grouped = $categories->groupBy('type'); @endphp

                                @foreach ($grouped as $type => $items)
                                    <optgroup label="{{ ucfirst($type) }}">
                                        @foreach ($items as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->code }} - {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <label for="paid" class="form-label text-gray-700 fw-medium">Paid Through</label>
                            <select class="form-select" id="paid" name="paid">
                                <option value="" selected>All Payments </option>
                                <option value="online" {{ request('paid') == 'online' ? 'selected' : '' }}> Online </option>
                                <option value="cash" {{ request('paid') == 'cash' ? 'selected' : '' }}> Cash </option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i>Apply
                            </button>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <a href="{{ route('staff.expense-reports.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-redo me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    {{-- Left --}}
                    <div>
                        <h6 class="mb-1 fw-semibold text-gray-800">Expense Details</h6>
                        <small class="text-muted">
                            Showing {{ $expenses->count() }} {{ $expenses->count() === 1 ? 'record' : 'records' }}
                        </small>
                    </div>

                    {{-- Right --}}
                    <div class="d-flex gap-2 flex-wrap">
                        {{-- Preview --}}
                        <a class="btn btn-outline-primary btn-sm"
                            href="{{ route('staff.expense-reports.pdf', request()->except('download') + ['download' => 0]) }}"
                            target="_blank" rel="noopener">
                            <i class="fas fa-eye me-1"></i>Preview PDF
                        </a>

                        {{-- Download --}}
                        <a class="btn btn-outline-success btn-sm"
                            href="{{ route('staff.expense-reports.pdf', request()->except('download') + ['download' => 1]) }}">
                            <i class="fas fa-download me-1"></i>Download PDF
                        </a>
                    </div>

                </div>
            </div>



            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="expenseTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">#</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Date</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Category</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Details</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Paid through</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4 text-end">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $grandTotal = 0; @endphp

                            @forelse($expenses as $index => $expense)
                                @php $grandTotal += $expense->amount; @endphp

                                <tr class="border-bottom">
                                    <td class="py-3 px-4">
                                        <span class="text-muted small">{{ $index + 1 }}</span>
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                                            </span>
                                            <span class="text-muted small">
                                                {{ \Carbon\Carbon::parse($expense->date)->format('l') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-3 px-4">
                                        <span class="badge badge-category">
                                            {{ $expense->category?->code ?? 'N/A' }}
                                        </span>
                                        <div class="text-muted small mt-1">
                                            {{ $expense->category?->name ?? 'Uncategorized' }}
                                        </div>
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="fw-medium text-gray-900">
                                            {{ $expense->name ?? '—' }}
                                        </div>
                                        @if (!empty($expense->description))
                                            <div class="text-muted small mt-1">
                                                {{ Str::limit($expense->description, 60) }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="fw-medium text-gray-900">
                                            {{ ucfirst($expense->paid) }}
                                        </div>

                                    </td>

                                    <td class="py-3 px-4 text-end">
                                        <span class="fw-bold text-success fs-6">
                                            ₱{{ number_format($expense->amount, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="empty-state-icon mb-3">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <h6 class="text-gray-600 mb-2">No Expenses Found</h6>
                                            <p class="text-muted mb-3 small">
                                                No expense records match your current filters
                                            </p>
                                            <a href="{{ route('staff.expense-reports.index') }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-redo me-1"></i>Clear Filters
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if ($expenses->count() > 0)
                            <tfoot class="table-light">
                                <tr class="fw-bold">
                                    <td colspan="4" class="py-3 px-4 text-gray-800">
                                        <i class="fas fa-calculator me-2"></i>Grand Total
                                    </td>
                                    <td class="py-3 px-4 text-end">
                                        <span class="text-success fs-5 fw-bold">
                                            ₱{{ number_format($grandTotal, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        :root {
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        .text-gray-900 {
            color: var(--gray-900) !important;
        }

        .text-gray-800 {
            color: var(--gray-800) !important;
        }

        .text-gray-700 {
            color: var(--gray-700) !important;
        }

        .text-gray-600 {
            color: var(--gray-600) !important;
        }

        .card {
            border-radius: 12px !important;
        }

        .card-header .btn {
            width: auto !important;
        }

        .form-control,
        .form-select {
            font-size: 0.95rem;
            padding: 0.65rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            width: 100%;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .form-label {
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .btn {
            font-size: 0.9rem;
            padding: 0.55rem 1.15rem;
            border-radius: 8px !important;
            font-weight: 500;
            width: 100%;
            white-space: nowrap;
        }

        .table thead th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: var(--gray-50);
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
            border-color: var(--gray-200);
        }

        .badge-category {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 0.75rem;
            padding: 0.4em 0.75em;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            max-width: 100%;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-state-icon i {
            font-size: 2rem;
            color: var(--gray-400);
        }

        @media (min-width: 1400px) {
            .container-fluid {
                max-width: none;
                margin-left: auto;
                margin-right: auto;
            }

            .card-body.p-4 {
                padding: 1.75rem !important;
            }

            .table {
                font-size: 0.98rem;
            }
        }

        @media (min-width: 992px) and (max-width: 1399.98px) {
            .card-body.p-4 {
                padding: 1.5rem !important;
            }

            .form-control,
            .form-select {
                padding: 0.6rem 0.9rem;
            }

            .btn {
                padding: 0.55rem 1rem;
            }
        }

        @media (max-width: 991.98px) {
            .card-body.p-4 {
                padding: 1.25rem !important;
            }
        }

        @media (max-width: 575.98px) {
            .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .table {
                font-size: 0.875rem;
            }

            .empty-state-icon {
                width: 64px;
                height: 64px;
            }

            .empty-state-icon i {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            #expenseTable {
                min-width: 780px;
            }
        }
    </style>
@endpush
