@extends('layouts.staff')

@section('content')
    <style>
        .global-selectors {
            background: #f8fafc;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            border: 2px solid #e2e8f0;
        }

        .global-selectors-title {
            color: #334155;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .global-fields {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

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
            background: #6f42c1;
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
            background: #6f42c1;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
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
            border-color: #6f42c1;
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.15);
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
            .global-fields {
                grid-template-columns: 1fr;
            }

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

    @php
        $revenueTypeItems = collect($revenueTypes ?? [])
            ->map(fn($t) => ['id' => $t->id, 'name' => $t->name])
            ->values();
    @endphp

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

                                <div class="global-selectors">
                                    <div class="global-selectors-title">
                                        <i class="fas fa-cog"></i>
                                        Global Settings (Apply to All Entries)
                                    </div>
                                    <div class="global-fields">
                                        <div class="field-group">
                                            <label class="field-label">
                                                Revenue Type <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" id="global-revenue-type" required>
                                                <option value="" disabled selected>Select type</option>
                                                @foreach ($revenueTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="field-group">
                                            <label class="field-label">
                                                Beneficiary <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" id="global-beneficiary" required>
                                                <option value="general" selected>General</option>
                                                <option value="pastor">Pastor</option>
                                            </select>
                                        </div>

                                        <div class="field-group">
                                            <label class="field-label">
                                                Payment Method <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" id="global-payment-method" required>
                                                <option value="cash" selected>Cash</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

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
                                                    Amount <span class="required-asterisk">*</span>
                                                </label>
                                                <input class="field-input revenue-amount" type="number" step="0.01"
                                                    min="0" placeholder="0.00" name="revenues[0][amount]"
                                                    value="{{ old('revenues.0.amount') }}" required>
                                                @error('revenues.0.amount')
                                                    <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <input type="hidden" name="revenues[0][revenue_type_id]"
                                                class="revenue-type-hidden">
                                            <input type="hidden" name="revenues[0][beneficiary]" class="beneficiary-hidden"
                                                value="general">
                                            <input type="hidden" name="revenues[0][payment_method]"
                                                class="payment-method-hidden" value="cash">
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

            const revenueTypes = @json($revenueTypeItems);

            function updateAllHiddenFields() {
                const revenueType = $('#global-revenue-type').val();
                const beneficiary = $('#global-beneficiary').val();
                const paymentMethod = $('#global-payment-method').val();

                $('.revenue-type-hidden').val(revenueType);
                $('.beneficiary-hidden').val(beneficiary);
                $('.payment-method-hidden').val(paymentMethod);
            }

            $('#global-revenue-type, #global-beneficiary, #global-payment-method').on('change', function() {
                updateAllHiddenFields();
            });

            function escapeHtml(str) {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
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
                cards.last().find('.remove-revenue').trigger('click');
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

            $('#add-revenue').click(function() {
                const revenueType = $('#global-revenue-type').val();
                const beneficiary = $('#global-beneficiary').val();
                const paymentMethod = $('#global-payment-method').val();

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
                                    Amount <span class="required-asterisk">*</span>
                                </label>
                                <input class="field-input revenue-amount" type="number" step="0.01" min="0" placeholder="0.00"
                                    name="revenues[${revenueCount}][amount]" required>
                            </div>

                            <input type="hidden" name="revenues[${revenueCount}][revenue_type_id]" class="revenue-type-hidden" value="${revenueType || ''}">
                            <input type="hidden" name="revenues[${revenueCount}][beneficiary]" class="beneficiary-hidden" value="${beneficiary || 'general'}">
                            <input type="hidden" name="revenues[${revenueCount}][payment_method]" class="payment-method-hidden" value="${paymentMethod || 'cash'}">
                        </div>
                    </div>
                `;

                $('#revenues-container').append(newEntry);

                const newCard = $(`#revenue-${revenueCount}`);
                newCard.css('opacity', '0').animate({
                    opacity: 1
                }, 300);

                revenueCount++;
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
                    $(this).find('input[name*="[amount]"]').attr('name', 'revenues[' + index + '][amount]');
                    $(this).find('input[name*="[revenue_type_id]"]').attr('name', 'revenues[' + index +
                        '][revenue_type_id]');
                    $(this).find('input[name*="[beneficiary]"]').attr('name', 'revenues[' + index +
                        '][beneficiary]');
                    $(this).find('input[name*="[payment_method]"]').attr('name', 'revenues[' + index +
                        '][payment_method]');
                });

                revenueCount = $('.revenue-card').length;
            }

            $('#revenueForm').on('submit', function(e) {
                const revenueType = $('#global-revenue-type').val();

                if (!revenueType) {
                    e.preventDefault();
                    alert('Please select a Revenue Type in the Global Settings.');
                    $('#global-revenue-type').focus();
                    return false;
                }

                updateAllHiddenFields();
            });
        });
    </script>
@endpush
