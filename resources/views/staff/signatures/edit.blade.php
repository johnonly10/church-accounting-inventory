@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="UpdateSignatures" active="UpdateSignatures" home="Signatures" :home-route="route('staff.signatures.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">

                    <x-white-card-header title="Signature Information"
                        subTitle="Update the details to fill the signature information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form action="{{ route('staff.signatures.update', $signature->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-signature me-2"></i>Signature Information
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $signature->name) }}"
                                                placeholder="Enter signature name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="label">
                                                Label
                                            </label>
                                            <input type="text" class="form-control @error('label') is-invalid @enderror"
                                                id="label" name="label" value="{{ old('label', $signature->label) }}"
                                                placeholder="Enter signature label">
                                            @error('label')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="position_id">
                                                Position <span class="text-danger">*</span>
                                            </label>

                                            <select name="position_id" id="position_id"
                                                class="form-select @error('position_id') is-invalid @enderror" required>
                                                <option value="" disabled
                                                    {{ old('position_id', $signature->position_id) ? '' : 'selected' }}>
                                                    -- Select Position --
                                                </option>

                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ old('position_id', $signature->position_id) == $position->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <input type="hidden" name="is_active" value="0">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="1" id="is_active" role="switch"
                                                    {{ old('is_active', $signature->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="is_active">
                                                    Set as Active
                                                </label>
                                            </div>
                                            @error('is_active')
                                                <div class="text-danger small ms-4">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <x-buttons.form-action primaryTitle="Update Signatures" primaryId="updateSignatureBtn"
                                    :cancel-route="route('staff.signatures.index')" />
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
