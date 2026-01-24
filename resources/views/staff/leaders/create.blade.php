@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create New Leaders" active="Create New Leaders" home="Leaders" :home-route="route('staff.leaders.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">

                    <x-white-card-header title="Leader's Information"
                        subTitle="Fill in the details to fill the leader information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form action="{{ route('staff.leaders.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-user me-2"></i>Leader's Information
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Full Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter full name"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="nickname">
                                                Nickname <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nickname') is-invalid @enderror" id="nickname"
                                                name="nickname" placeholder="Enter your nickname"
                                                value="{{ old('nickname') }}" required>
                                            @error('nickname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="cell_name">
                                                Cell Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('cell_name') is-invalid @enderror" id="cell_name"
                                                name="cell_name" placeholder="Enter cell name"
                                                value="{{ old('cell_name') }}" required>
                                            @error('cell_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <x-buttons.form-action primaryTitle="Create Leaders" primaryId="createLeaderBtn"
                                    :cancel-route="route('staff.leaders.index')" />

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
