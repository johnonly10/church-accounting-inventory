@extends('layouts.staff')

@section('content')
    <style>
        /* ✅ keep your styles (you can trim later). I removed index-only parts. */

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

        .revenue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .revenue-title {
            color: #334155;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
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

        .denomination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .denomination-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .denomination-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
            text-align: center;
            box-sizing: border-box;
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

        .breakdown-total-item.grand-total .breakdown-total-label,
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
            box-sizing: border-box;
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

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .revenue-fields {
                grid-template-columns: 1fr;
            }

            .denomination-grid {
                grid-template-columns: 1fr;
            }

            .breakdown-totals {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .form-section-title {
            color: #334155;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }
    </style>

    @php
        $revenue = $collection->revenue->first(); // pick the first revenue in the collection
        $cashCount = optional($revenue)->revenue_cash_count?->first();
    @endphp

    <div class="container-fluid p-0">
        <x-page-title title="Edit Revenue" active="Edit Revenue" home="Revenues" :home-route="route('staff.revenues.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Edit Revenue" subTitle="Update the details of this revenue" />
                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form id="revenueForm" action="{{ route('staff.revenues.update', $revenue->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-section-title">Revenue Information</div>

                                <div class="revenue-card">
                                    <div class="revenue-header">
                                        <h4 class="revenue-title">Revenue</h4>
                                    </div>

                                    <div class="revenue-fields">
                                        <div>
                                            <label class="field-label">
                                                Name <span class="required-asterisk">*</span>
                                            </label>
                                            <input class="field-input" type="text" name="name"
                                                value="{{ old('name', $revenue->name) }}" required>
                                            @error('name')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="field-label">
                                                Type <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" name="types" required>
                                                <option value="" disabled>Select type</option>
                                                <option value="tithes"
                                                    {{ old('types', $revenue->types) === 'tithes' ? 'selected' : '' }}>
                                                    Tithes
                                                </option>
                                                <option value="offering"
                                                    {{ old('types', $revenue->types) === 'offering' ? 'selected' : '' }}>
                                                    Offering
                                                </option>
                                            </select>
                                            @error('types')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="field-label">
                                                Payment Method <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input payment-method-select" name="payment_method"
                                                required>
                                                <option value="cash"
                                                    {{ old('payment_method', $revenue->payment_method) === 'cash' ? 'selected' : '' }}>
                                                    Cash
                                                </option>
                                                <option value="gcash"
                                                    {{ old('payment_method', $revenue->payment_method) === 'gcash' ? 'selected' : '' }}>
                                                    GCash
                                                </option>
                                            </select>
                                            @error('payment_method')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="field-label">
                                                Amount <span class="required-asterisk">*</span>
                                            </label>
                                            <input class="field-input revenue-amount" type="number" step="0.01"
                                                min="0" name="amount" value="{{ old('amount', $revenue->amount) }}"
                                                required>
                                            @error('amount')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div
                                        class="cash-breakdown-section {{ old('payment_method', $revenue->payment_method) === 'cash' ? 'active' : '' }}">
                                        <div class="cash-breakdown-header">
                                            <div class="cash-breakdown-title">
                                                <i class="fas fa-money-bill-wave"></i>
                                                Cash Denomination Breakdown
                                            </div>
                                            <i class="fas fa-chevron-down cash-breakdown-toggle expanded"></i>
                                        </div>

                                        <div class="cash-breakdown-content expanded">
                                            {{-- Bills --}}
                                            <div class="denomination-group">
                                                <div class="denomination-group-title">
                                                    <i class="fas fa-money-bill"></i> Bills
                                                </div>
                                                <div class="denomination-grid">
                                                    @php
                                                        $bills = [
                                                            'bill_1000' => ['label' => '₱1,000', 'value' => 1000],
                                                            'bill_500' => ['label' => '₱500', 'value' => 500],
                                                            'bill_200' => ['label' => '₱200', 'value' => 200],
                                                            'bill_100' => ['label' => '₱100', 'value' => 100],
                                                            'bill_50' => ['label' => '₱50', 'value' => 50],
                                                            'bill_20' => ['label' => '₱20', 'value' => 20],
                                                        ];
                                                    @endphp

                                                    @foreach ($bills as $name => $meta)
                                                        <div>
                                                            <label class="denomination-label">{{ $meta['label'] }}</label>
                                                            <input type="text" class="denomination-input"
                                                                inputmode="numeric" autocomplete="off"
                                                                name="{{ $name }}"
                                                                value="{{ old($name, $cashCount->$name ?? 0) }}"
                                                                data-value="{{ $meta['value'] }}">
                                                            <span class="denomination-calc">= ₱0.00</span>
                                                            @error($name)
                                                                <span class="error-message">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- Coins --}}
                                            <div class="denomination-group">
                                                <div class="denomination-group-title">
                                                    <i class="fas fa-coins"></i> Coins
                                                </div>
                                                <div class="denomination-grid">
                                                    @php
                                                        $coins = [
                                                            'coin_20' => ['label' => '₱20', 'value' => 20],
                                                            'coin_10' => ['label' => '₱10', 'value' => 10],
                                                            'coin_5' => ['label' => '₱5', 'value' => 5],
                                                            'coin_1' => ['label' => '₱1', 'value' => 1],
                                                        ];
                                                    @endphp

                                                    @foreach ($coins as $name => $meta)
                                                        <div>
                                                            <label class="denomination-label">{{ $meta['label'] }}</label>
                                                            <input type="text" class="denomination-input"
                                                                inputmode="numeric" autocomplete="off"
                                                                name="{{ $name }}"
                                                                value="{{ old($name, $cashCount->$name ?? 0) }}"
                                                                data-value="{{ $meta['value'] }}">
                                                            <span class="denomination-calc">= ₱0.00</span>
                                                            @error($name)
                                                                <span class="error-message">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- Centimos --}}
                                            <div class="denomination-group">
                                                <div class="denomination-group-title">
                                                    <i class="fas fa-money-bill-wave"></i> Centimos
                                                </div>
                                                <div class="denomination-grid">
                                                    @php
                                                        $centimos = [
                                                            'centimo_25' => ['label' => '25¢', 'value' => 0.25],
                                                            'centimo_10' => ['label' => '10¢', 'value' => 0.1],
                                                            'centimo_5' => ['label' => '5¢', 'value' => 0.05],
                                                            'centimo_1' => ['label' => '1¢', 'value' => 0.01],
                                                        ];
                                                    @endphp

                                                    @foreach ($centimos as $name => $meta)
                                                        <div>
                                                            <label class="denomination-label">{{ $meta['label'] }}</label>
                                                            <input type="text" class="denomination-input"
                                                                inputmode="numeric" autocomplete="off"
                                                                name="{{ $name }}"
                                                                value="{{ old($name, $cashCount->$name ?? 0) }}"
                                                                data-value="{{ $meta['value'] }}">
                                                            <span class="denomination-calc">= ₱0.00</span>
                                                            @error($name)
                                                                <span class="error-message">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
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

                                <div class="form-actions">
                                    <x-buttons.form-action primaryTitle="Update Revenue" primaryId="updateRevenueBtn"
                                        :cancel-route="route('staff.revenues.index')" />
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

            function fmtInt(v) {
                return intFormatter.format(toInt(v));
            }

            function setUpdateBtnDisabled(disabled) {
                const btn = $('#updateRevenueBtn');
                btn.prop('disabled', disabled);
                btn.attr('aria-disabled', disabled ? 'true' : 'false')
                    .toggleClass('disabled', disabled);

                btn.css(disabled ? {
                    pointerEvents: 'none',
                    opacity: 0.6
                } : {
                    pointerEvents: '',
                    opacity: ''
                });
            }

            const card = $('.revenue-card');

            function validateAndRender(breakdownTotal) {
                const method = card.find('.payment-method-select').val();
                const msg = card.find('.validation-message');

                if (method !== 'cash') {
                    msg.hide().removeClass('warning error success');
                    card.data('cash-valid', true);
                    return true;
                }

                const revenueAmountRaw = Number(card.find('.revenue-amount').val());
                const revenueAmount = Number.isFinite(revenueAmountRaw) ? revenueAmountRaw : 0;

                const diff = Math.abs(revenueAmount - breakdownTotal);
                const valid = diff < 0.01;

                msg.removeClass('warning error success');

                if (valid) {
                    msg.addClass('success').html(
                        '<i class="fas fa-check-circle"></i> Cash breakdown matches the revenue amount perfectly!'
                    ).show();
                } else if (breakdownTotal > revenueAmount) {
                    msg.addClass('error').html(
                        '<i class="fas fa-exclamation-circle"></i> Cash breakdown (' + fmtPHP(breakdownTotal) +
                        ') exceeds revenue amount (' + fmtPHP(revenueAmount) + ') by ' + fmtPHP(diff)
                    ).show();
                } else {
                    msg.addClass('warning').html(
                        '<i class="fas fa-exclamation-triangle"></i> Cash breakdown (' + fmtPHP(
                            breakdownTotal) +
                        ') is less than revenue amount (' + fmtPHP(revenueAmount) + ') by ' + fmtPHP(diff)
                    ).show();
                }

                card.data('cash-valid', valid);
                return valid;
            }

            function renderTotals() {
                const breakdownSection = card.find('.cash-breakdown-section');
                if (!breakdownSection.length) return;

                let billsTotal = 0,
                    coinsTotal = 0,
                    centimosTotal = 0;

                breakdownSection.find('.denomination-input').each(function() {
                    const input = $(this);
                    const count = toInt(input.val());
                    const value = Number(input.data('value')) || 0;
                    const total = count * value;

                    input.closest('div').find('.denomination-calc').text('= ' + fmtPHP(total));

                    const name = input.attr('name') || '';
                    if (name.includes('bill_')) billsTotal += total;
                    else if (name.includes('coin_')) coinsTotal += total;
                    else if (name.includes('centimo_')) centimosTotal += total;
                });

                const grandTotal = billsTotal + coinsTotal + centimosTotal;

                breakdownSection.find('.bills-total').text(fmtPHP(billsTotal));
                breakdownSection.find('.coins-total').text(fmtPHP(coinsTotal));
                breakdownSection.find('.centimos-total').text(fmtPHP(centimosTotal));
                breakdownSection.find('.grand-total-value').text(fmtPHP(grandTotal));

                validateAndRender(grandTotal);
                setUpdateBtnDisabled(card.find('.payment-method-select').val() === 'cash' && card.data(
                    'cash-valid') === false);
            }

            function toggleCashBreakdown() {
                const method = card.find('.payment-method-select').val();
                const cashSection = card.find('.cash-breakdown-section');

                if (method === 'cash') {
                    cashSection.addClass('active');
                    card.data('cash-valid', true);
                    renderTotals();
                } else {
                    cashSection.removeClass('active');
                    card.find('.validation-message').hide().removeClass('warning error success');
                    card.data('cash-valid', true);
                    setUpdateBtnDisabled(false);
                }
            }

            function normalizeDenominationInputs() {
                card.find('.denomination-input').each(function() {
                    $(this).val(fmtInt($(this).val()));
                });
            }

            $(document).on('click', '.cash-breakdown-header', function() {
                const content = $(this).siblings('.cash-breakdown-content');
                const toggle = $(this).find('.cash-breakdown-toggle');
                content.toggleClass('expanded');
                toggle.toggleClass('expanded');
            });

            $(document).on('change', '.payment-method-select', function() {
                toggleCashBreakdown();
            });

            $(document).on('focus', '.denomination-input', function() {
                const n = toInt($(this).val());
                $(this).val(n === 0 ? '' : String(n));
            });

            $(document).on('blur input', '.denomination-input', function() {
                const raw = cleanIntString($(this).val());
                $(this).val(raw === '' ? '' : raw.replace(/^0+(?=\d)/, ''));
                renderTotals();
            });

            $(document).on('input', '.revenue-amount', function() {
                if (card.find('.payment-method-select').val() === 'cash') renderTotals();
            });

            $('#revenueForm').on('submit', function(e) {
                // force numeric values for backend integer validation
                $(this).find('.denomination-input').each(function() {
                    $(this).val(toInt($(this).val()));
                });

                renderTotals();

                const disabled = $('#updateRevenueBtn').prop('disabled') || $('#updateRevenueBtn').attr(
                    'aria-disabled') === 'true';
                if (disabled) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    card[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return false;
                }
            });

            // init
            normalizeDenominationInputs();
            toggleCashBreakdown();
            renderTotals();
        });
    </script>
@endpush
