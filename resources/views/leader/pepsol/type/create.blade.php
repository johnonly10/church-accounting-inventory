@extends('layouts.staff')

@section('content')
    <div class="containerr-fluid p-0">
        <x-page-title title="Create New Type " active="Create New Type" home="Type " :home-route="route('leader.pepsol-types.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Type's Information"
                        subTitle="Fill in the details to fill the Type information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('leader.pepsol-types.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-list me-2"></i>
                                        Type Information
                                    </h5>

                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" for="name">
                                            Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter the Type name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" placeholder="Enter the Type code"
                                                value="{{ old('code') }}" required>
                                            @error('code')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>





                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Create Type " primaryId="createTypeBtn"
                                    :cancel-route="route('leader.pepsol-types.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
