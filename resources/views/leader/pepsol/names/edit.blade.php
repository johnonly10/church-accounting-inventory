@extends('layouts.staff')

@section('content')
    <div class="containerr-fluid p-0">
        <x-page-title title="Edit Pepsol Name" active="Edit Pepsol Name" home="Pepsol Name" :home-route="route('leader.pepsol-names.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Edit Pepsol Name's Information"
                        subTitle="Update the details to modify the Pepsol Name information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('leader.pepsol-names.update', $pepsolName->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-list me-2"></i>
                                        Pepsol Name Information
                                    </h5>

                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" for="name">
                                            Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter the Pepsol Name"
                                            value="{{ old('name', $pepsolName->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-3 mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="code">
                                                Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" placeholder="Enter the Pepsol Name code"
                                                value="{{ old('code', $pepsolName->code) }}" required>
                                            @error('code')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Update Pepsol Name" primaryId="updatePepsolNameBtn"
                                    :cancel-route="route('leader.pepsol-names.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
