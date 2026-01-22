@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create Revenue Denomination  " active="Create Revenue Denomination  "
            home="Revenue Denomination  " :home-route="route('staff.revenue-cash-counts.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">

                    <x-white-card-header title="Revenue Denomination   Information"
                        subTitle="Fill in the details to create the Revenue Denomination   information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form action="{{ route('staff.revenue-cash-counts.store') }}" method="POST" id="cashCountForm">
                                @csrf

                                <div class="mb-4">
                                    <!-- Date Section -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" for="date">
                                                <i class="fas fa-calendar me-2"></i>Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                                id="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                                                required>
                                            @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Total Display -->
                                        <div class="col-md-8">
                                            <div class="alert alert-info mb-0 h-100 d-flex align-items-center">
                                                <div class="w-100">
                                                    <h5 class="mb-1">Total Amount</h5>
                                                    <h3 class="mb-0 text-primary fw-bold">₱<span
                                                            id="totalAmount">0.00</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bills Section -->
                                    <div class="denomination-section mb-4">
                                        <h5 class="mb-3 text-primary border-bottom pb-2">
                                            <i class="fas fa-money-bill-wave me-2"></i>Bills
                                            <small class="text-muted float-end fs-6">Subtotal: ₱<span
                                                    id="billsSubtotal">0.00</span></small>
                                        </h5>

                                        <div class="row g-3">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_1000">
                                                        <span>₱1,000</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_1000') is-invalid @enderror"
                                                        id="bill_1000" name="bill_1000" value="{{ old('bill_1000', 0) }}"
                                                        min="0" step="1" data-value="1000" placeholder="0">
                                                    @error('bill_1000')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_500">
                                                        <span>₱500</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_500') is-invalid @enderror"
                                                        id="bill_500" name="bill_500" value="{{ old('bill_500', 0) }}"
                                                        min="0" step="1" data-value="500" placeholder="0">
                                                    @error('bill_500')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_200">
                                                        <span>₱200</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_200') is-invalid @enderror"
                                                        id="bill_200" name="bill_200" value="{{ old('bill_200', 0) }}"
                                                        min="0" step="1" data-value="200" placeholder="0">
                                                    @error('bill_200')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_100">
                                                        <span>₱100</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_100') is-invalid @enderror"
                                                        id="bill_100" name="bill_100" value="{{ old('bill_100', 0) }}"
                                                        min="0" step="1" data-value="100" placeholder="0">
                                                    @error('bill_100')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_50">
                                                        <span>₱50</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_50') is-invalid @enderror"
                                                        id="bill_50" name="bill_50" value="{{ old('bill_50', 0) }}"
                                                        min="0" step="1" data-value="50" placeholder="0">
                                                    @error('bill_50')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="bill_20">
                                                        <span>₱20</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('bill_20') is-invalid @enderror"
                                                        id="bill_20" name="bill_20" value="{{ old('bill_20', 0) }}"
                                                        min="0" step="1" data-value="20" placeholder="0">
                                                    @error('bill_20')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coins Section -->
                                    <div class="denomination-section mb-4">
                                        <h5 class="mb-3 text-primary border-bottom pb-2">
                                            <i class="fas fa-coins me-2"></i>Coins
                                            <small class="text-muted float-end fs-6">Subtotal: ₱<span
                                                    id="coinsSubtotal">0.00</span></small>
                                        </h5>

                                        <div class="row g-3">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="coin_20">
                                                        <span>₱20</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('coin_20') is-invalid @enderror"
                                                        id="coin_20" name="coin_20" value="{{ old('coin_20', 0) }}"
                                                        min="0" step="1" data-value="20" placeholder="0">
                                                    @error('coin_20')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="coin_10">
                                                        <span>₱10</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('coin_10') is-invalid @enderror"
                                                        id="coin_10" name="coin_10" value="{{ old('coin_10', 0) }}"
                                                        min="0" step="1" data-value="10" placeholder="0">
                                                    @error('coin_10')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="coin_5">
                                                        <span>₱5</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('coin_5') is-invalid @enderror"
                                                        id="coin_5" name="coin_5" value="{{ old('coin_5', 0) }}"
                                                        min="0" step="1" data-value="5" placeholder="0">
                                                    @error('coin_5')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="coin_1">
                                                        <span>₱1</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('coin_1') is-invalid @enderror"
                                                        id="coin_1" name="coin_1" value="{{ old('coin_1', 0) }}"
                                                        min="0" step="1" data-value="1" placeholder="0">
                                                    @error('coin_1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Centavos Section -->
                                    <div class="denomination-section mb-4">
                                        <h5 class="mb-3 text-primary border-bottom pb-2">
                                            <i class="fas fa-circle-notch me-2"></i>Centavos
                                            <small class="text-muted float-end fs-6">Subtotal: ₱<span
                                                    id="centavosSubtotal">0.00</span></small>
                                        </h5>

                                        <div class="row g-3">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="centimo_25">
                                                        <span>25¢</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0.00</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('centimo_25') is-invalid @enderror"
                                                        id="centimo_25" name="centimo_25"
                                                        value="{{ old('centimo_25', 0) }}" min="0" step="1"
                                                        data-value="0.25" placeholder="0">
                                                    @error('centimo_25')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="centimo_10">
                                                        <span>10¢</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0.00</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('centimo_10') is-invalid @enderror"
                                                        id="centimo_10" name="centimo_10"
                                                        value="{{ old('centimo_10', 0) }}" min="0" step="1"
                                                        data-value="0.10" placeholder="0">
                                                    @error('centimo_10')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="centimo_5">
                                                        <span>5¢</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0.00</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('centimo_5') is-invalid @enderror"
                                                        id="centimo_5" name="centimo_5"
                                                        value="{{ old('centimo_5', 0) }}" min="0" step="1"
                                                        data-value="0.05" placeholder="0">
                                                    @error('centimo_5')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="denomination-input">
                                                    <label class="form-label fw-semibold d-flex justify-content-between"
                                                        for="centimo_1">
                                                        <span>1¢</span>
                                                        <span class="text-muted small">= ₱<span
                                                                class="item-total">0.00</span></span>
                                                    </label>
                                                    <input type="number"
                                                        class="form-control denomination-field @error('centimo_1') is-invalid @enderror"
                                                        id="centimo_1" name="centimo_1"
                                                        value="{{ old('centimo_1', 0) }}" min="0" step="1"
                                                        data-value="0.01" placeholder="0">
                                                    @error('centimo_1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-buttons.form-action primaryTitle="Create Revenue Denomination"
                                    primaryId="createRevenueCashCountBtn" :cancel-route="route('staff.revenue-cash-counts.index')" />

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const denominationFields = document.querySelectorAll('.denomination-field');

                function formatNumber(num) {
                    return num.toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }

                function normalizeEmptyToZero(field) {
                    if (field.value === '' || field.value === null) {
                        field.value = 0;
                    }
                }

                function calculateTotals() {
                    let total = 0;
                    let billsTotal = 0;
                    let coinsTotal = 0;
                    let centavosTotal = 0;

                    denominationFields.forEach(field => {
                        normalizeEmptyToZero(field);

                        const count = parseInt(field.value) || 0;
                        const value = parseFloat(field.dataset.value);
                        const itemTotal = count * value;

                        const itemTotalSpan = field.closest('.denomination-input').querySelector('.item-total');
                        if (itemTotalSpan) {
                            itemTotalSpan.textContent = formatNumber(itemTotal);
                        }

                        if (field.id.startsWith('bill_')) {
                            billsTotal += itemTotal;
                        } else if (field.id.startsWith('coin_')) {
                            coinsTotal += itemTotal;
                        } else if (field.id.startsWith('centimo_')) {
                            centavosTotal += itemTotal;
                        }

                        total += itemTotal;
                    });

                    document.getElementById('billsSubtotal').textContent = formatNumber(billsTotal);
                    document.getElementById('coinsSubtotal').textContent = formatNumber(coinsTotal);
                    document.getElementById('centavosSubtotal').textContent = formatNumber(centavosTotal);
                    document.getElementById('totalAmount').textContent = formatNumber(total);
                }

                denominationFields.forEach(field => {
                    field.addEventListener('input', calculateTotals);

                    field.addEventListener('blur', function() {
                        normalizeEmptyToZero(field);
                        calculateTotals();
                    });
                });

                calculateTotals();
            });
        </script>
    @endpush
@endsection
