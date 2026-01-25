@extends('layouts.staff')
<link rel="stylesheet" href="{{ asset('/css/dashboard/finance.css') }}">
@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Finance Dashboard" active="Finance Dashboard" />
        <div class="container-fluid px-2 px-md-3 px-lg-4">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="btn-group w-100 w-sm-auto" role="group">
                        <input type="radio" class="btn-check" name="periodFilter" id="weeklyFilter" value="weekly"
                            autocomplete="off" {{ request('period', 'yearly') === 'weekly' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="weeklyFilter">Weekly</label>
                        <input type="radio" class="btn-check" name="periodFilter" id="monthlyFilter" value="monthly"
                            autocomplete="off" {{ request('period', 'yearly') === 'monthly' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="monthlyFilter">Monthly</label>
                        <input type="radio" class="btn-check" name="periodFilter" id="yearlyFilter" value="yearly"
                            autocomplete="off" {{ request('period', 'yearly') === 'yearly' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="yearlyFilter">Yearly</label>
                    </div>
                </div>
            </div>
            <div class="row g-3 g-md-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card revenue-card">
                        <div class="icon-wrapper icon-revenue">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="metric-label">Total Revenue</div>
                        <div class="metric-value text-primary">₱{{ number_format($currentRevenue) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card expense-card">
                        <div class="icon-wrapper icon-expense">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="metric-label">Total Expenses</div>
                        <div class="metric-value text-danger">₱{{ number_format($currentExpenses) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card savings-card">
                        <div class="icon-wrapper icon-net">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="metric-label">Savings</div>
                        <div class="metric-value text-success">₱{{ number_format($savings) }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card collections-card">
                        <div class="icon-wrapper icon-count">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="metric-label">Collections</div>
                        <div class="metric-value text-warning">{{ number_format($currentCollections) }}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mt-md-4">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-chart-line text-primary"></i>
                            <span>Revenue Trends</span>
                        </div>
                        <div class="chart-container">
                            <div id="revenueTrendChart" style="min-height: 300px; width: 100%;"></div>
                            <div id="revenueTrendEmpty" class="chart-empty-state" style="display: none;">
                                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Revenue Data Available</h5>
                                <p class="text-muted">There are no revenue records for the selected period.</p>
                            </div>
                            <div id="revenueTrendPlaceholder" class="chart-placeholder" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Loading chart data...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 g-md-4 mt-1">
                <div class="col-12 col-xl-6">
                    <div class="chart-card pie-chart-card">
                        <div class="chart-title">
                            <i class="fas fa-chart-pie text-success"></i>
                            <span>Revenue by Type</span>
                        </div>
                        <div class="chart-container">
                            <div id="revenueTypeChart" style="min-height: 300px; width: 100%;"></div>
                            <div id="revenueTypeEmpty" class="chart-empty-state" style="display: none;">
                                <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Revenue Type Data</h5>
                                <p class="text-muted">There are no revenue types recorded for this period.</p>
                            </div>
                            <div id="revenueTypePlaceholder" class="chart-placeholder" style="display: none;">
                                <div class="spinner-border text-success" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Loading chart data...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="chart-card pie-chart-card">
                        <div class="chart-title">
                            <i class="fas fa-tags text-danger"></i>
                            <span>Expense Categories</span>
                        </div>
                        <div class="chart-container">
                            <div id="expenseCategoryChart" style="min-height: 300px; width: 100%;"></div>
                            <div id="expenseCategoryEmpty" class="chart-empty-state" style="display: none;">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Expense Data</h5>
                                <p class="text-muted">There are no expenses recorded for this period.</p>
                            </div>
                            <div id="expenseCategoryPlaceholder" class="chart-placeholder" style="display: none;">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Loading chart data...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 g-md-4 mb-4 mt-1">
                <div class="col-12 col-xl-6">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-arrow-circle-down text-success"></i>
                            <span>Recent Revenues</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Date</th>
                                        <th class="text-nowrap">Type</th>
                                        <th class="text-nowrap">Method</th>
                                        <th class="text-end text-nowrap">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentRevenues as $r)
                                        <tr>
                                            <td class="text-nowrap">{{ $r['date'] }}</td>
                                            <td><span
                                                    class="badge bg-primary-subtle text-primary text-nowrap">{{ $r['type'] }}</span>
                                            </td>
                                            <td class="text-nowrap">{{ ucfirst($r['method']) }}</td>
                                            <td class="text-end fw-bold text-success text-nowrap">
                                                ₱{{ number_format($r['amount'] ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No revenues found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="chart-card">
                        <div class="chart-title">
                            <i class="fas fa-arrow-circle-up text-danger"></i>
                            <span>Recent Expenses</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Date</th>
                                        <th class="text-nowrap">Category</th>
                                        <th class="text-end text-nowrap">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentExpenses as $expense)
                                        <tr>
                                            <td class="text-nowrap">{{ $expense['date'] ?? 'N/A' }}</td>
                                            <td><span
                                                    class="badge bg-danger-subtle text-danger text-nowrap">{{ $expense['category'] ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-end fw-bold text-danger text-nowrap">
                                                ₱{{ number_format($expense['amount'] ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No Recent Expenses Found
                                            </td>
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
    <script>
        window.financeData = {
            revenueByMonth: @json($revenueByMonth ?? []),
            revenueByType: @json($revenueByType ?? []),
            expensesByCategory: @json($expensesByCategory ?? []),
        };
        document.addEventListener('DOMContentLoaded', function() {
            const filterInputs = document.querySelectorAll('input[name="periodFilter"]');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const period = this.value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('period', period);
                    window.location.href = url.toString();
                });
            });
        });

        function showEmptyState(chartId) {
            const chart = document.getElementById(chartId);
            const emptyState = document.getElementById(chartId.replace('Chart', 'Empty'));
            if (chart) {
                chart.style.display = 'none';
            }
            if (emptyState) {
                emptyState.style.display = 'flex';
            }
        }

        function hideEmptyState(chartId) {
            const chart = document.getElementById(chartId);
            const emptyState = document.getElementById(chartId.replace('Chart', 'Empty'));
            if (chart) {
                chart.style.display = 'block';
            }
            if (emptyState) {
                emptyState.style.display = 'none';
            }
        }

        function checkDataAndRender(chartId, data, renderCallback) {
            if (!data || data.length === 0 || (Array.isArray(data) && data.every(item => !item.amount && !item.revenue))) {
                showEmptyState(chartId);
            } else {
                hideEmptyState(chartId);
                renderCallback(data);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const financeData = window.financeData || {};
            checkDataAndRender('revenueTrendChart', financeData.revenueByMonth, function(data) {
                renderRevenueTrendChart(data);
            });
            checkDataAndRender('revenueTypeChart', financeData.revenueByType, function(data) {
                renderRevenueTypeChart(data);
            });
            checkDataAndRender('expenseCategoryChart', financeData.expensesByCategory, function(data) {
                renderExpenseCategoryChart(data);
            });

            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.renderRevenueTrendChart) renderRevenueTrendChart(financeData
                        .revenueByMonth);
                    if (window.renderRevenueTypeChart) renderRevenueTypeChart(financeData
                        .revenueByType);
                    if (window.renderExpenseCategoryChart) renderExpenseCategoryChart(financeData
                        .expensesByCategory);
                }, 250);
            });
        });

        function renderRevenueTrendChart(data) {
            console.log('Rendering Revenue Trend Chart', data);
        }

        function renderRevenueTypeChart(data) {
            console.log('Rendering Revenue Type Chart', data);
        }

        function renderExpenseCategoryChart(data) {
            console.log('Rendering Expense Category Chart', data);
        }
    </script>
    <style>
        @media (max-width: 1399px) {
            .metric-card {
                min-height: 120px;
            }
        }

        @media (max-width: 991px) {
            .chart-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 767px) {
            .btn-group {
                display: flex !important;
            }

            .btn-group .btn {
                flex: 1;
                font-size: 0.875rem;
                padding: 0.5rem 0.25rem;
            }

            .metric-value {
                font-size: 1.5rem !important;
            }

            .metric-label {
                font-size: 0.875rem;
            }
        }

        @media (max-width: 575px) {
            .table {
                font-size: 0.875rem;
            }

            .badge {
                font-size: 0.75rem;
            }
        }

        .chart-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        #revenueTrendChart,
        #revenueTypeChart,
        #expenseCategoryChart {
            max-width: 100%;
            height: auto !important;
        }

        .chart-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
        }

        .chart-empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            text-align: center;
            padding: 2rem;
        }

        .chart-empty-state i {
            opacity: 0.3;
        }

        .chart-empty-state h5 {
            margin-bottom: 0.5rem;
        }

        .chart-empty-state p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .container-fluid.px-2 {
            max-width: 100%;
        }

        @media (min-width: 1400px) {
            .container-fluid.px-2 {
                max-width: 1400px;
                margin: 0 auto;
            }
        }

        @media (min-width: 1600px) {
            .container-fluid.px-2 {
                max-width: 1600px;
            }
        }
    </style>
@endpush
