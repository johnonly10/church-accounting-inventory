@extends('layouts.staff')

@section('content')
    <style>
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
                                            <label class="field-label">Name</label>
                                            <input class="field-input" type="text" name="name"
                                                value="{{ old('name', $revenue->name) }}">
                                            @error('name')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="field-label">
                                                Revenue Type <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" name="revenue_type_id" required>
                                                <option value="" disabled
                                                    {{ old('revenue_type_id', $revenue->revenue_type_id) ? '' : 'selected' }}>
                                                    Select type
                                                </option>
                                                @foreach ($revenueTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        {{ (string) old('revenue_type_id', $revenue->revenue_type_id) === (string) $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('revenue_type_id')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="field-label">
                                                Beneficiary <span class="required-asterisk">*</span>
                                            </label>
                                            <select class="field-input" name="beneficiary" required>
                                                <option value="general"
                                                    {{ old('beneficiary', $revenue->beneficiary) === 'general' ? 'selected' : '' }}>
                                                    General
                                                </option>
                                                <option value="pastor"
                                                    {{ old('beneficiary', $revenue->beneficiary) === 'pastor' ? 'selected' : '' }}>
                                                    Pastor
                                                </option>
                                            </select>
                                            @error('beneficiary')
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
                                                <option value="online"
                                                    {{ old('payment_method', $revenue->payment_method) === 'online' ? 'selected' : '' }}>
                                                    Online
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
            const card = $('.revenue-card');

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

            setUpdateBtnDisabled(false);
        });
    </script>
@endpush
