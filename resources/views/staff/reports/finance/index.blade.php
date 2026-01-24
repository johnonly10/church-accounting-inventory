@extends('layouts.staff')

@section('content')
    <div class="container-fluid px-4 py-4">
        <x-page-title title="Finance Report" active="Finance Report" />

        {{-- Filter Card --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold text-gray-800">
                        <i class="fas fa-filter me-2"></i>Filter Reports
                    </h6>
                </div>
            </div>

            <div class="card-body p-4">
                <form method="GET" action="{{ route('staff.finance-reports.index') }}" id="filterForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-2 col-md-6">
                            <label for="date_from" class="form-label text-gray-700 fw-medium">From Date</label>
                            <input type="date" class="form-control" id="date_from" name="date_from"
                                value="{{ request('date_from') }}" max="{{ request('date_to') }}">
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <label for="date_to" class="form-label text-gray-700 fw-medium">To Date</label>
                            <input type="date" class="form-control" id="date_to" name="date_to"
                                value="{{ request('date_to') }}" min="{{ request('date_from') }}">
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label for="payment_method" class="form-label text-gray-700 fw-medium">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method">
                                <option value="" selected>All Payment Methods</option>
                                <option value="online" {{ request('payment_method') == 'online' ? 'selected' : '' }}>
                                    Online
                                </option>
                                <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>
                                    Cash
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i>Apply
                            </button>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <a href="{{ route('staff.finance-reports.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-redo me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm summary-card revenue-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Total Revenue</p>
                                <h4 class="mb-0 fw-bold text-success">₱{{ number_format($totalRevenue, 2) }}</h4>
                            </div>
                            <div class="icon-wrapper bg-success-light">
                                <i class="fas fa-arrow-up text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm summary-card expense-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Total Expenses</p>
                                <h4 class="mb-0 fw-bold text-danger">₱{{ number_format($totalExpense, 2) }}</h4>
                            </div>
                            <div class="icon-wrapper bg-danger-light">
                                <i class="fas fa-arrow-down text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm summary-card net-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Net Income</p>
                                <h4 class="mb-0 fw-bold {{ $netIncome >= 0 ? 'text-success' : 'text-danger' }}">
                                    ₱{{ number_format($netIncome, 2) }}
                                </h4>
                            </div>
                            <div class="icon-wrapper {{ $netIncome >= 0 ? 'bg-success-light' : 'bg-danger-light' }}">
                                <i class="fas fa-chart-line {{ $netIncome >= 0 ? 'text-success' : 'text-danger' }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm summary-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Total Records</p>
                                <h4 class="mb-0 fw-bold text-primary">{{ $financeRecords->count() }}</h4>
                            </div>
                            <div class="icon-wrapper bg-primary-light">
                                <i class="fas fa-file-invoice text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Finance Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <h6 class="mb-1 fw-semibold text-gray-800">Finance Details</h6>
                        <small class="text-muted">
                            Showing {{ $financeRecords->count() }}
                            {{ $financeRecords->count() === 1 ? 'record' : 'records' }}
                        </small>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        {{-- Preview PDF --}}
                        <a class="btn btn-outline-primary btn-sm"
                            href="{{ route('staff.finance-report.pdf', request()->except('download') + ['download' => 0]) }}"
                            target="_blank" rel="noopener">
                            <i class="fas fa-eye me-1"></i>Preview PDF
                        </a>

                        {{-- Download PDF --}}
                        <a class="btn btn-outline-success btn-sm"
                            href="{{ route('staff.finance-report.pdf', request()->except('download') + ['download' => 1]) }}">
                            <i class="fas fa-download me-1"></i>Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="financeTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">#</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Type</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Date</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Category</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Details</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4">Payment Method</th>
                                <th class="border-0 fw-semibold text-gray-700 py-3 px-4 text-end">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($financeRecords as $index => $record)
                                <tr class="border-bottom">
                                    <td class="py-3 px-4">
                                        <span class="text-muted small">{{ $index + 1 }}</span>
                                    </td>

                                    <td class="py-3 px-4">
                                        <span
                                            class="badge {{ $record->type === 'revenue' ? 'badge-revenue' : 'badge-expense' }}">
                                            <i
                                                class="fas fa-{{ $record->type === 'revenue' ? 'arrow-up' : 'arrow-down' }} me-1"></i>
                                            {{ ucfirst($record->type) }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}
                                            </span>
                                            <span class="text-muted small">
                                                {{ \Carbon\Carbon::parse($record->date)->format('l') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="text-gray-900 small">
                                            {{ $record->category ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td class="py-3 px-4">
                                        <div class="fw-medium text-gray-900">
                                            {{ $record->details ?: '—' }}
                                        </div>
                                    </td>

                                    <td class="py-3 px-4">
                                        <span class="badge badge-payment">
                                            <i
                                                class="fas fa-{{ $record->payment_method === 'online' ? 'credit-card' : 'money-bill-wave' }} me-1"></i>
                                            {{ ucfirst($record->payment_method) }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-4 text-end">
                                        <span
                                            class="fw-bold {{ $record->type === 'revenue' ? 'text-success' : 'text-danger' }} fs-6">
                                            {{ $record->type === 'revenue' ? '+' : '-' }}₱{{ number_format($record->amount, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="empty-state-icon mb-3">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <h6 class="text-gray-600 mb-2">No Records Found</h6>
                                            <p class="text-muted mb-3 small">
                                                No finance records match your current filters
                                            </p>
                                            <a href="{{ route('staff.finance-reports.index') }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-redo me-1"></i>Clear Filters
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateFrom = document.getElementById('date_from');
            const dateTo = document.getElementById('date_to');

            // When date_from changes, set min for date_to
            dateFrom.addEventListener('change', function() {
                if (this.value) {
                    dateTo.min = this.value;

                    // If date_to is already set and is less than date_from, clear it
                    if (dateTo.value && dateTo.value < this.value) {
                        dateTo.value = '';
                    }
                } else {
                    dateTo.min = '';
                }
            });

            // When date_to changes, set max for date_from
            dateTo.addEventListener('change', function() {
                if (this.value) {
                    dateFrom.max = this.value;

                    // If date_from is already set and is greater than date_to, clear it
                    if (dateFrom.value && dateFrom.value > this.value) {
                        dateFrom.value = '';
                    }
                } else {
                    dateFrom.max = '';
                }
            });
        });
    </script>
@endpush

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

        .summary-card {
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-4px);
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .bg-success-light {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-danger-light {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-primary-light {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .form-control,
        .form-select {
            font-size: 0.95rem;
            padding: 0.65rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
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

        .badge-revenue {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-size: 0.75rem;
            padding: 0.4em 0.75em;
            border-radius: 6px;
            font-weight: 600;
        }

        .badge-expense {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 0.75rem;
            padding: 0.4em 0.75em;
            border-radius: 6px;
            font-weight: 600;
        }

        .badge-payment {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 0.75rem;
            padding: 0.4em 0.75em;
            border-radius: 6px;
            font-weight: 600;
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

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            #financeTable {
                min-width: 900px;
            }
        }
    </style>
@endpush
