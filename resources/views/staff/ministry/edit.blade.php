@extends('layouts.staff')

@section('content')
    <div class="containerr-fluid p-0">
        <x-page-title title="Update Ministry" active="Update  Ministry" home="Ministry" :home-route="route('staff.ministries.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Ministry's Information"
                        subTitle="Update in the details to the Ministry information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.ministries.update', $ministry->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-church me-2"></i>
                                        Ministry Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter the ministry name"
                                                value="{{ old('name', $ministry->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Edit Ministry" primaryId="createMinistryBtn"
                                    :cancel-route="route('staff.ministries.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
