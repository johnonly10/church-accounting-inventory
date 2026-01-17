@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create New Signatures" active="Create New Signatures" home="Signatures" :home-route="route('staff.signatures.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">

                    <x-white-card-header title="signature's Information"
                        subTitle="Fill in the details to fill the Signatures information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form action="{{ route('staff.signatures.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-signature me-2"></i>Signatures's Information
                                    </h5>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
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
                                                id="label" name="label" value="{{ old('label') }}"
                                                placeholder="Enter signature label" required>
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
                                                <option value="" disabled selected>-- Select Position --</option>

                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="1" id="is_active" role="switch"
                                                    {{ old('is_active') ? 'checked' : '' }}>
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

                                <x-buttons.form-action primaryTitle="Create Signatures" primaryId="createSignatureBtn"
                                    :cancel-route="route('staff.signatures.index')" />

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
