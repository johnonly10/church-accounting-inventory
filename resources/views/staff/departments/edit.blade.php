@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Edit Departments" active="Edit Department" home="Departments" :home-route="route('staff.departments.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Department's Information"
                        subtitke="Fill in the details to fill the Department information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.departments.update', $department) }}" method="POST">

                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-building me-2"></i>
                                        Department Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter the department name"
                                                value="{{ old('name', $department->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Update Departments" primaryId="updateDepartmentBtn"
                                    :cancel-route="route('staff.departments.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
