@extends('layouts.staff')

@section('content')
    <div class="containerr-fluid p-0">
        <x-page-title title="Create New Revenue Type" active="Create New Revenue Type" home="Revenue Type" :home-route="route('staff.revenue-types.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Revenue Type's Information"
                        subTitle="Fill in the details to fill the Revenue Type information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.revenue-types.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-coins me-2"></i>
                                        Revenue Type Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter the Revenue Type name"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Create Revenue Type" primaryId="createRevenueTypeBtn"
                                    :cancel-route="route('staff.revenue-types.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
