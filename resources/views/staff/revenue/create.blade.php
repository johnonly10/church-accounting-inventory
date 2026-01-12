@extends('layouts.staff')
@section('content')
    <style>
        .revenues-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-bottom: 32px;
        }

        .revenue-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .revenue-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .revenue-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #e2e8f0;
        }

        .revenue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .revenue-number {
            background: #f8fafc;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 600;
            font-size: 18px;
            border: 2px solid #e2e8f0;
        }

        .revenue-title {
            color: #334155;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            flex-grow: 1;
            margin-left: 16px;
        }

        .remove-revenue {
            background: #ac0927;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            color: #e3e6eb;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .remove-revenue:hover {
            background: #6b0409;
            color: #f2f3f5;
            border-color: #cbd5e1;
        }

        .revenue-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .cash-breakdown-section {
            margin-top: 24px;
            border-top: 2px dashed #e2e8f0;
            padding-top: 20px;
            display: none;
        }

        .cash-breakdown-section.active {
            display: block;
        }

        .cash-breakdown-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .cash-breakdown-header:hover {
            background: #f1f5f9;
        }

        .cash-breakdown-title {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-weight: 600;
            font-size: 15px;
        }

        .cash-breakdown-toggle {
            transition: transform 0.3s ease;
            color: #64748b;
        }

        .cash-breakdown-toggle.expanded {
            transform: rotate(180deg);
        }

        .cash-breakdown-content {
            display: none;
            padding: 16px 0;
        }

        .cash-breakdown-content.expanded {
            display: block;
        }

        .denomination-group {
            background: #fafbfc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            border: 1px solid #e8ecef;
        }

        .denomination-group-title {
            color: #334155;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .denomination-group-title i {
            color: #64748b;
        }

        .denomination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .denomination-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .denomination-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .denomination-input-wrapper {
            position: relative;
        }

        .denomination-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
            text-align: center;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .denomination-input:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.1);
        }

        .denomination-calc {
            color: #64748b;
            font-size: 12px;
            text-align: center;
            font-weight: 500;
            margin-top: 4px;
            display: block;
        }

        .breakdown-totals {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 20px;
            padding: 16px;
            background: white;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .breakdown-total-item {
            text-align: center;
            padding: 12px;
            background: #f8fafc;
            border-radius: 6px;
        }

        .breakdown-total-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .breakdown-total-value {
            color: #334155;
            font-size: 18px;
            font-weight: 700;
        }

        .breakdown-total-item.grand-total {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .breakdown-total-item.grand-total .breakdown-total-label {
            color: rgba(255, 255, 255, 0.9);
        }

        .breakdown-total-item.grand-total .breakdown-total-value {
            color: white;
        }

        .validation-message {
            display: none;
            margin-top: 12px;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .validation-message.warning {
            display: block;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .validation-message.error {
            display: block;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .validation-message.success {
            display: block;
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        @media (max-width: 768px) {
            .revenue-fields {
                grid-template-columns: 1fr;
            }

            .revenue-header {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .revenue-title {
                margin-left: 0;
            }

            .denomination-grid {
                grid-template-columns: 1fr;
            }

            .breakdown-totals {
                grid-template-columns: 1fr;
            }
        }

        .field-group {
            position: relative;
        }

        .field-label {
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .required-asterisk {
            color: #dc2626;
            margin-left: 4px;
        }

        .field-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            color: #334155;
            font-size: 16px;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .field-input::placeholder {
            color: #94a3b8;
        }

        .field-input:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            background: #fef2f2;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #fecaca;
        }

        .add-revenue-btn {
            background: white;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 14px 28px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-revenue-btn:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .add-revenue-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="container-fluid p-0">
        <x-page-title title="Create Revenue Collection" active="Create Revenue Collection" home="Revenue" :home-route="route('staff.revenues.index')" />
        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Revenue Collection Information"
                        subTitle="Fill in the details to create a collection of revenue" />
                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form id="revenueForm" action="{{ route('staff.revenues.store') }}" method="POST">
                                @csrf

                                <div id="revenues-container" class="revenues-container">
                                    <div class="revenue-card" id="revenue-0" data-index="0">
                                        <div class="revenue-header">
                                            <div class="revenue-number">1</div>
                                            <h4 class="revenue-title">Revenue #1</h4>
                                            <button type="button" class="remove-revenue" data-id="0">
                                                <i class="fas fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>

                                        <div class="revenue-fields">
                                            <div class="field-group">
                                                <label class="field-label">Name (optional)</label>
                                                <input class="field-input" type="text" placeholder="e.g., John Doe"
                                                    name="revenues[0][name]" value="{{ old('revenues.0.name') }}">
                                                @error('revenues.0.name')
                                                    <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="field-group">
                                                <label class="field-label">
                                                    Type <span class="required-asterisk">*</span>
                                                </label>
                                                <select class="field-input" name="revenues[0][types]" required>
                                                    <option value="" disabled
                                                        {{ old('revenues.0.types') ? '' : 'selected' }}>Select type
                                                    </option>
                                                    <option value="tithes"
                                                        {{ old('revenues.0.types') === 'tithes' ? 'selected' : '' }}>
                                                        Tithes
                                                    </option>
                                                    <option value="offering"
                                                        {{ old('revenues.0.types') === 'offering' ? 'selected' : '' }}>
                                                        Offering
                                                    </option>
                                                </select>
                                                @error('revenues.0.types')
                                                    <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="field-group">
                                                <label class="field-label">
                                                    Payment Method <span class="required-asterisk">*</span>
                                                </label>
                                                <select class="field-input payment-method-select"
                                                    name="revenues[0][payment_method]" required>
                                                    <option value="cash"
                                                        {{ old('revenues.0.payment_method', 'cash') === 'cash' ? 'selected' : '' }}>
                                                        Cash
                                                    </option>
                                                    <option value="gcash"
                                                        {{ old('revenues.0.payment_method') === 'gcash' ? 'selected' : '' }}>
                                                        GCash
                                                    </option>
                                                </select>
                                                @error('revenues.0.payment_method')
                                                    <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="field-group">
                                                <label class="field-label">
                                                    Amount <span class="required-asterisk">*</span>
                                                </label>
                                                <input class="field-input revenue-amount" type="number" step="0.01"
                                                    min="0" placeholder="0.00" name="revenues[0][amount]"
                                                    value="{{ old('revenues.0.amount') }}" required>
                                                @error('revenues.0.amount')
                                                    <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="cash-breakdown-section active" data-index="0">
                                            <div class="cash-breakdown-header">
                                                <div class="cash-breakdown-title">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                    Cash Denomination Breakdown
                                                </div>
                                                <i class="fas fa-chevron-down cash-breakdown-toggle expanded"></i>
                                            </div>

                                            <div class="cash-breakdown-content expanded">
                                                <div class="denomination-group">
                                                    <div class="denomination-group-title">
                                                        <i class="fas fa-money-bill"></i>
                                                        Bills
                                                    </div>
                                                    <div class="denomination-grid">
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱1,000</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_1000]" value="0"
                                                                    data-value="1000">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱500</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_500]" value="0"
                                                                    data-value="500">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱200</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_200]" value="0"
                                                                    data-value="200">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱100</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_100]" value="0"
                                                                    data-value="100">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱50</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_50]" value="0"
                                                                    data-value="50">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱20</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][bill_20]" value="0"
                                                                    data-value="20">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="denomination-group">
                                                    <div class="denomination-group-title">
                                                        <i class="fas fa-coins"></i>
                                                        Coins
                                                    </div>
                                                    <div class="denomination-grid">
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱20</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][coin_20]" value="0"
                                                                    data-value="20">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱10</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][coin_10]" value="0"
                                                                    data-value="10">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱5</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][coin_5]" value="0"
                                                                    data-value="5">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">₱1</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][coin_1]" value="0"
                                                                    data-value="1">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="denomination-group">
                                                    <div class="denomination-group-title">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                        Centimos
                                                    </div>
                                                    <div class="denomination-grid">
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">25¢</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][centimo_25]" value="0"
                                                                    data-value="0.25">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">10¢</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][centimo_10]" value="0"
                                                                    data-value="0.10">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">5¢</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][centimo_5]" value="0"
                                                                    data-value="0.05">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="denomination-item">
                                                            <label class="denomination-label">1¢</label>
                                                            <div class="denomination-input-wrapper">
                                                                <input type="text" class="denomination-input"
                                                                    inputmode="numeric" autocomplete="off"
                                                                    name="revenues[0][centimo_1]" value="0"
                                                                    data-value="0.01">
                                                                <span class="denomination-calc">= ₱0.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="breakdown-totals">
                                                    <div class="breakdown-total-item">
                                                        <div class="breakdown-total-label">Bills Total</div>
                                                        <div class="breakdown-total-value bills-total">₱0.00</div>
                                                    </div>
                                                    <div class="breakdown-total-item">
                                                        <div class="breakdown-total-label">Coins Total</div>
                                                        <div class="breakdown-total-value coins-total">₱0.00</div>
                                                    </div>
                                                    <div class="breakdown-total-item">
                                                        <div class="breakdown-total-label">Centimos Total</div>
                                                        <div class="breakdown-total-value centimos-total">₱0.00</div>
                                                    </div>
                                                    <div class="breakdown-total-item grand-total">
                                                        <div class="breakdown-total-label">Grand Total</div>
                                                        <div class="breakdown-total-value grand-total-value">₱0.00</div>
                                                    </div>
                                                </div>

                                                <div class="validation-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" id="add-revenue" class="add-revenue-btn">
                                        <i class="icon-plus"></i>
                                        Add Another Collection
                                    </button>

                                    <x-buttons.form-action cancelTitle="Cancel"
                                        cancelRoute="{{ route('staff.revenues.index') }}" cancelIcon="fas fa-times"
                                        primaryTitle="Create All" primaryIcon="fas fa-user-plus"
                                        primaryColor="background:#6f42c1;border-color:#6f42c1;color:#fff;"
                                        primaryButton="btn px-4" primaryId="createRevenueBtn" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let revenueCount = 1;

            const phpCurrency = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });

            const intFormatter = new Intl.NumberFormat('en-US', {
                maximumFractionDigits: 0
            });

            function fmtPHP(n) {
                return phpCurrency.format(Number(n) || 0);
            }

            function cleanIntString(v) {
                return String(v ?? '').replace(/[^\d]/g, '');
            }

            function toInt(v) {
                const s = cleanIntString(v);
                const n = parseInt(s, 10);
                return Number.isFinite(n) ? n : 0;
            }

            function fmtInt(n) {
                return intFormatter.format(toInt(n));
            }

            function getDenomCount($input) {
                return toInt($input.val());
            }

            function setCreateBtnDisabled(disabled) {
                const btn = $('#createRevenueBtn');
                btn.prop('disabled', disabled);
                btn.attr('aria-disabled', disabled ? 'true' : 'false').toggleClass('disabled', disabled);
                if (disabled) {
                    btn.css({
                        pointerEvents: 'none',
                        opacity: 0.6
                    });
                } else {
                    btn.css({
                        pointerEvents: '',
                        opacity: ''
                    });
                }
            }

            $(document).on('click', '#createRevenueBtn', function(e) {
                if ($(this).attr('aria-disabled') === 'true' || $(this).prop('disabled')) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
            });

            function toggleCashBreakdown(card) {
                const paymentMethod = card.find('.payment-method-select').val();
                const cashSection = card.find('.cash-breakdown-section');

                if (paymentMethod === 'cash') {
                    cashSection.addClass('active');
                } else {
                    cashSection.removeClass('active');
                    card.find('.validation-message').hide().removeClass('warning error success');
                }

                updateCreateButtonState();
            }

            function getBreakdownTotal(card) {
                let billsTotal = 0;
                let coinsTotal = 0;
                let centimosTotal = 0;

                card.find('.cash-breakdown-section .denomination-input').each(function() {
                    const input = $(this);
                    const count = getDenomCount(input);
                    const value = parseFloat(input.data('value')) || 0;
                    const total = count * value;

                    const name = input.attr('name') || '';
                    if (name.includes('bill_')) {
                        billsTotal += total;
                    } else if (name.includes('coin_')) {
                        coinsTotal += total;
                    } else if (name.includes('centimo_')) {
                        centimosTotal += total;
                    }
                });

                return billsTotal + coinsTotal + centimosTotal;
            }

            function isCashCardValid(card) {
                const method = card.find('.payment-method-select').val();
                if (method !== 'cash') return true;

                const revenueAmount = parseFloat(card.find('.revenue-amount').val()) || 0;
                const breakdownTotal = getBreakdownTotal(card);

                return Math.abs(revenueAmount - breakdownTotal) < 0.01;
            }

            function updateCreateButtonState() {
                let allValid = true;

                $('.revenue-card').each(function() {
                    if (!isCashCardValid($(this))) {
                        allValid = false;
                        return false;
                    }
                });

                setCreateBtnDisabled(!allValid);
            }

            function calculateDenominationTotals(card) {
                const breakdownSection = card.find('.cash-breakdown-section');
                let billsTotal = 0;
                let coinsTotal = 0;
                let centimosTotal = 0;

                breakdownSection.find('.denomination-input').each(function() {
                    const input = $(this);
                    const count = getDenomCount(input);
                    const value = parseFloat(input.data('value')) || 0;
                    const total = count * value;

                    input.closest('.denomination-item').find('.denomination-calc').text('= ' + fmtPHP(
                        total));

                    const name = input.attr('name') || '';
                    if (name.includes('bill_')) {
                        billsTotal += total;
                    } else if (name.includes('coin_')) {
                        coinsTotal += total;
                    } else if (name.includes('centimo_')) {
                        centimosTotal += total;
                    }
                });

                const grandTotal = billsTotal + coinsTotal + centimosTotal;

                breakdownSection.find('.bills-total').text(fmtPHP(billsTotal));
                breakdownSection.find('.coins-total').text(fmtPHP(coinsTotal));
                breakdownSection.find('.centimos-total').text(fmtPHP(centimosTotal));
                breakdownSection.find('.grand-total-value').text(fmtPHP(grandTotal));

                validateCashBreakdown(card, grandTotal);

                return grandTotal;
            }

            function validateCashBreakdown(card, breakdownTotal) {
                const revenueAmount = parseFloat(card.find('.revenue-amount').val()) || 0;
                const validationMsg = card.find('.validation-message');
                const difference = Math.abs(revenueAmount - breakdownTotal);

                validationMsg.removeClass('warning error success');

                if (difference < 0.01) {
                    validationMsg.addClass('success')
                        .html(
                            '<i class="fas fa-check-circle"></i> Cash breakdown matches the revenue amount perfectly!'
                        )
                        .show();
                } else if (breakdownTotal > revenueAmount) {
                    validationMsg.addClass('error')
                        .html(
                            '<i class="fas fa-exclamation-circle"></i> Cash breakdown (' + fmtPHP(breakdownTotal) +
                            ') exceeds revenue amount (' + fmtPHP(revenueAmount) + ') by ' + fmtPHP(difference)
                        )
                        .show();
                } else {
                    validationMsg.addClass('warning')
                        .html(
                            '<i class="fas fa-exclamation-triangle"></i> Cash breakdown (' + fmtPHP(
                                breakdownTotal) +
                            ') is less than revenue amount (' + fmtPHP(revenueAmount) + ') by ' + fmtPHP(difference)
                        )
                        .show();
                }

                updateCreateButtonState();
            }

            function addRevenueCard() {
                $('#add-revenue').trigger('click');
            }

            function removeLastRevenueCard() {
                const cards = $('.revenue-card');
                if (cards.length <= 1) {
                    alert('You must have at least one revenue entry.');
                    return;
                }
                const lastCard = cards.last();
                const id = lastCard.attr('id') ? lastCard.attr('id').split('-')[1] : null;
                if (id !== null) {
                    lastCard.find('.remove-revenue').trigger('click');
                }
            }

            $(document).on('keydown', function(e) {
                if (!e.ctrlKey || !e.shiftKey) return;

                const key = e.key;

                if (key === '+' || key === '=') {
                    e.preventDefault();
                    addRevenueCard();
                }

                if (key === '-' || key === '_') {
                    e.preventDefault();
                    removeLastRevenueCard();
                }
            });

            $(document).on('click', '.cash-breakdown-header', function() {
                const content = $(this).siblings('.cash-breakdown-content');
                const toggle = $(this).find('.cash-breakdown-toggle');
                content.toggleClass('expanded');
                toggle.toggleClass('expanded');
            });

            $(document).on('change', '.payment-method-select', function() {
                const card = $(this).closest('.revenue-card');
                toggleCashBreakdown(card);
                if (card.find('.payment-method-select').val() === 'cash') {
                    calculateDenominationTotals(card);
                }
            });

            $(document).on('focus', '.denomination-input', function() {
                const n = toInt($(this).val());
                $(this).val(n === 0 ? '' : String(n));
            });

            $(document).on('blur', '.denomination-input', function() {
                $(this).val(fmtInt(toInt($(this).val())));
            });

            $(document).on('input', '.denomination-input', function() {
                const raw = cleanIntString($(this).val());
                const normalized = raw === '' ? '0' : raw.replace(/^0+(?=\d)/, '');
                $(this).val(fmtInt(normalized));

                const card = $(this).closest('.revenue-card');
                calculateDenominationTotals(card);
            });

            $(document).on('input', '.revenue-amount', function() {
                const card = $(this).closest('.revenue-card');
                if (card.find('.payment-method-select').val() === 'cash') {
                    calculateDenominationTotals(card);
                } else {
                    updateCreateButtonState();
                }
            });

            $('#revenueForm').on('submit', function() {
                $(this).find('.denomination-input').each(function() {
                    $(this).val(toInt($(this).val()));
                });
            });

            function normalizeCardDenominationInputs(card) {
                card.find('.denomination-input').each(function() {
                    $(this).val(fmtInt(toInt($(this).val())));
                });
            }

            $('#add-revenue').click(function() {
                const newEntry = `
                    <div class="revenue-card" id="revenue-${revenueCount}" data-index="${revenueCount}">
                        <div class="revenue-header">
                            <div class="revenue-number">${revenueCount + 1}</div>
                            <h4 class="revenue-title">Revenue #${revenueCount + 1}</h4>
                            <button type="button" class="remove-revenue" data-id="${revenueCount}">
                                <i class="icon-trash-2"></i>
                                Remove
                            </button>
                        </div>

                        <div class="revenue-fields">
                            <div class="field-group">
                                <label class="field-label">Name (optional)</label>
                                <input class="field-input" type="text" placeholder="e.g., Full Name"
                                    name="revenues[${revenueCount}][name]">
                            </div>

                            <div class="field-group">
                                <label class="field-label">
                                    Type <span class="required-asterisk">*</span>
                                </label>
                                <select class="field-input" name="revenues[${revenueCount}][types]" required>
                                    <option value="" disabled selected>Select type</option>
                                    <option value="tithes">Tithes</option>
                                    <option value="offering">Offering</option>
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label">
                                    Payment Method <span class="required-asterisk">*</span>
                                </label>
                                <select class="field-input payment-method-select" name="revenues[${revenueCount}][payment_method]" required>
                                    <option value="cash" selected>Cash</option>
                                    <option value="gcash">GCash</option>
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label">
                                    Amount <span class="required-asterisk">*</span>
                                </label>
                                <input class="field-input revenue-amount" type="number" step="0.01" min="0" placeholder="0.00"
                                    name="revenues[${revenueCount}][amount]" required>
                            </div>
                        </div>

                        <div class="cash-breakdown-section active" data-index="${revenueCount}">
                            <div class="cash-breakdown-header">
                                <div class="cash-breakdown-title">
                                    <i class="fas fa-money-bill-wave"></i>
                                    Cash Denomination Breakdown
                                </div>
                                <i class="fas fa-chevron-down cash-breakdown-toggle expanded"></i>
                            </div>

                            <div class="cash-breakdown-content expanded">
                                <div class="denomination-group">
                                    <div class="denomination-group-title">
                                        <i class="fas fa-money-bill"></i>
                                        Bills
                                    </div>
                                    <div class="denomination-grid">
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱1,000</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_1000]" value="0" data-value="1000">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱500</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_500]" value="0" data-value="500">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱200</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_200]" value="0" data-value="200">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱100</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_100]" value="0" data-value="100">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱50</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_50]" value="0" data-value="50">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱20</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][bill_20]" value="0" data-value="20">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="denomination-group">
                                    <div class="denomination-group-title">
                                        <i class="fas fa-coins"></i>
                                        Coins
                                    </div>
                                    <div class="denomination-grid">
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱20</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][coin_20]" value="0" data-value="20">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱10</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][coin_10]" value="0" data-value="10">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱5</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][coin_5]" value="0" data-value="5">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">₱1</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][coin_1]" value="0" data-value="1">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="denomination-group">
                                    <div class="denomination-group-title">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Centimos
                                    </div>
                                    <div class="denomination-grid">
                                        <div class="denomination-item">
                                            <label class="denomination-label">25¢</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][centimo_25]" value="0" data-value="0.25">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">10¢</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][centimo_10]" value="0" data-value="0.10">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">5¢</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][centimo_5]" value="0" data-value="0.05">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                        <div class="denomination-item">
                                            <label class="denomination-label">1¢</label>
                                            <div class="denomination-input-wrapper">
                                                <input type="text" class="denomination-input" inputmode="numeric" autocomplete="off"
                                                    name="revenues[${revenueCount}][centimo_1]" value="0" data-value="0.01">
                                                <span class="denomination-calc">= ₱0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="breakdown-totals">
                                    <div class="breakdown-total-item">
                                        <div class="breakdown-total-label">Bills Total</div>
                                        <div class="breakdown-total-value bills-total">₱0.00</div>
                                    </div>
                                    <div class="breakdown-total-item">
                                        <div class="breakdown-total-label">Coins Total</div>
                                        <div class="breakdown-total-value coins-total">₱0.00</div>
                                    </div>
                                    <div class="breakdown-total-item">
                                        <div class="breakdown-total-label">Centimos Total</div>
                                        <div class="breakdown-total-value centimos-total">₱0.00</div>
                                    </div>
                                    <div class="breakdown-total-item grand-total">
                                        <div class="breakdown-total-label">Grand Total</div>
                                        <div class="breakdown-total-value grand-total-value">₱0.00</div>
                                    </div>
                                </div>

                                <div class="validation-message"></div>
                            </div>
                        </div>
                    </div>
                `;

                $('#revenues-container').append(newEntry);
                const newCard = $(`#revenue-${revenueCount}`);

                newCard.css('opacity', '0').animate({
                    opacity: 1
                }, 300);

                toggleCashBreakdown(newCard);
                normalizeCardDenominationInputs(newCard);
                calculateDenominationTotals(newCard);

                revenueCount++;
                updateCreateButtonState();
            });

            $(document).on('click', '.remove-revenue', function() {
                const id = $(this).data('id');
                if (id !== 0 && id !== '0') {
                    const cardToRemove = $(`#revenue-${id}`);
                    cardToRemove.animate({
                        opacity: 0,
                        height: 0,
                        marginBottom: 0,
                        paddingTop: 0,
                        paddingBottom: 0
                    }, 300, function() {
                        cardToRemove.remove();
                        updateRevenueNumbers();
                        updateCreateButtonState();
                    });
                } else {
                    alert('You must have at least one revenue entry.');
                }
            });

            function updateRevenueNumbers() {
                $('.revenue-card').each(function(index) {
                    $(this).attr('id', 'revenue-' + index);
                    $(this).attr('data-index', index);
                    $(this).find('.revenue-number').text(index + 1);
                    $(this).find('.revenue-title').text('Revenue #' + (index + 1));
                    $(this).find('.remove-revenue').data('id', index);

                    $(this).find('input[name*="[name]"]').attr('name', 'revenues[' + index + '][name]');
                    $(this).find('select[name*="[types]"]').attr('name', 'revenues[' + index + '][types]');
                    $(this).find('select[name*="[payment_method]"]').attr('name', 'revenues[' + index +
                        '][payment_method]');
                    $(this).find('input[name*="[amount]"]').attr('name', 'revenues[' + index + '][amount]');

                    $(this).find('input[name*="[bill_1000]"]').attr('name', 'revenues[' + index +
                        '][bill_1000]');
                    $(this).find('input[name*="[bill_500]"]').attr('name', 'revenues[' + index +
                        '][bill_500]');
                    $(this).find('input[name*="[bill_200]"]').attr('name', 'revenues[' + index +
                        '][bill_200]');
                    $(this).find('input[name*="[bill_100]"]').attr('name', 'revenues[' + index +
                        '][bill_100]');
                    $(this).find('input[name*="[bill_50]"]').attr('name', 'revenues[' + index +
                        '][bill_50]');
                    $(this).find('input[name*="[bill_20]"]').attr('name', 'revenues[' + index +
                        '][bill_20]');

                    $(this).find('input[name*="[coin_20]"]').attr('name', 'revenues[' + index +
                        '][coin_20]');
                    $(this).find('input[name*="[coin_10]"]').attr('name', 'revenues[' + index +
                        '][coin_10]');
                    $(this).find('input[name*="[coin_5]"]').attr('name', 'revenues[' + index + '][coin_5]');
                    $(this).find('input[name*="[coin_1]"]').attr('name', 'revenues[' + index + '][coin_1]');

                    $(this).find('input[name*="[centimo_25]"]').attr('name', 'revenues[' + index +
                        '][centimo_25]');
                    $(this).find('input[name*="[centimo_10]"]').attr('name', 'revenues[' + index +
                        '][centimo_10]');
                    $(this).find('input[name*="[centimo_5]"]').attr('name', 'revenues[' + index +
                        '][centimo_5]');
                    $(this).find('input[name*="[centimo_1]"]').attr('name', 'revenues[' + index +
                        '][centimo_1]');

                    $(this).find('.cash-breakdown-section').attr('data-index', index);
                });

                revenueCount = $('.revenue-card').length;
            }

            function initCard(card) {
                toggleCashBreakdown(card);
                normalizeCardDenominationInputs(card);
                calculateDenominationTotals(card);
                updateCreateButtonState();
            }

            initCard($('#revenue-0'));
        });
    </script>
@endpush
