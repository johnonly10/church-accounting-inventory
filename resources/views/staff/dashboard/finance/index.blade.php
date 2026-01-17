@extends('layouts.staff')

<link rel="stylesheet" href="{{ asset('/css/dashboard/finance.css') }}">

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Finance Dashboard" active="Finance Dashboard" />

        <div class="container">
            <!-- Metrics Row -->
            <div class="row g-3 g-md-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="metric-card revenue-card">
                        <div class="icon-wrapper icon-revenue">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="metric-label">Total Revenue</div>
                        <div class="metric-value text-primary">₱{{ number_format($currentRevenue) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="metric-card expense-card">
                        <div class="icon-wrapper icon-expense">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="metric-label">Total Expenses</div>
                        <div class="metric-value text-danger">₱{{ number_format($currentExpenses) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="metric-card savings-card">
                        <div class="icon-wrapper icon-net">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="metric-label">Savings</div>
                        <div class="metric-value text-success">₱{{ number_format($savings) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="metric-card collections-card">
                        <div class="icon-wrapper icon-count">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="metric-label">Collections</div>
                        <div class="metric-value text-warning">{{ number_format($currentCollections) }}</div>
                    </div>
                </div>
            </div>

            <!-- Revenue Trend Chart -->
            <div class="row mt-3 mt-md-4">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-chart-line text-primary"></i>
                            <span>Revenue Trends</span>
                        </div>
                        <div id="revenueTrendChart"></div>
                    </div>
                </div>
            </div>

            <!-- Pie Charts Row -->
            <div class="row g-3 g-md-4">
                <div class="col-12 col-lg-6">
                    <div class="chart-card pie-chart-card">
                        <div class="chart-title">
                            <i class="fas fa-chart-pie text-success"></i>
                            <span>Revenue by Type</span>
                        </div>
                        <div id="revenueTypeChart"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="chart-card pie-chart-card">
                        <div class="chart-title">
                            <i class="fas fa-tags text-danger"></i>
                            <span>Expense Categories</span>
                        </div>
                        <div id="expenseCategoryChart"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions Tables -->
            <div class="row g-3 g-md-4 mb-4 mt-4 mt-md-5">
                <div class="col-12 col-xl-6">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-arrow-circle-down text-success"></i>
                            <span>Recent Revenues</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Method</th>
                                        {{-- <th>Beneficiary</th> --}}
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentRevenues as $r)
                                        <tr>
                                            <td>{{ $r['date'] }}</td>
                                            <td><span
                                                    class="badge bg-primary-subtle text-primary">{{ $r['type'] }}</span>
                                            </td>
                                            <td>{{ ucfirst($r['method']) }}</td>
                                            {{-- <td>{{ $r['beneficiary'] }}</td> --}}
                                            <td class="text-end fw-bold text-success">
                                                ₱{{ number_format($r['amount'] ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No revenues found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 ">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-arrow-circle-up text-danger"></i>
                            <span>Recent Expenses</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        {{-- <th>Description</th> --}}
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentExpenses as $expense)
                                        <tr>
                                            <td>{{ $expense['date'] ?? 'N/A' }}</td>
                                            <td><span
                                                    class="badge bg-danger-subtle text-danger">{{ $expense['category'] ?? 'N/A' }}</span>
                                            </td>
                                            {{-- <td>{{ $expense['name'] }} - {{ $expense['description'] }}</td> --}}
                                            <td class="text-end fw-bold text-danger">
                                                ₱{{ number_format($expense['amount'] ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No Recent Expenses Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/dashboard/finance.js') }}"></script>

    {{-- Keep this here so your JS file can read the PHP data --}}
    <script>
        window.financeData = {
            revenueByMonth: @json($revenueByMonth ?? []),
            revenueByType: @json($revenueByType ?? []),
            expensesByCategory: @json($expensesByCategory ?? []),
        };
    </script>
@endpush
