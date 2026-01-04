@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Edit User" active="Edit User" home="Users" :home-route="route('staff.users.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="User Information" subTitle="Update the details for this user account" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.users.update', $user) }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-user me-2"></i>Personal Information
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Full Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter full name"
                                                value="{{ old('name', $user->name) }}" readonly>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">Full name is required.</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="email">
                                                Email Address <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="user@example.com"
                                                value="{{ old('email', $user->email) }}" readonly>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">A valid email is required.</div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-building me-2"></i>Organization Details
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="department_id">
                                                Department
                                            </label>
                                            <select class="form-select @error('department_id') is-invalid @enderror"
                                                id="department_id" name="department_id">
                                                <option value="">-- Select Department --</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="ministry_id">
                                                Ministry
                                            </label>
                                            <select class="form-select @error('ministry_id') is-invalid @enderror"
                                                id="ministry_id" name="ministry_id">
                                                <option value="">-- Select Ministry --</option>
                                                @foreach ($ministries as $ministry)
                                                    <option value="{{ $ministry->id }}"
                                                        {{ old('ministry_id', $user->ministry_id) == $ministry->id ? 'selected' : '' }}>
                                                        {{ $ministry->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ministry_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="leader_id">
                                                Assigned Leader
                                            </label>
                                            <select class="form-select @error('leader_id') is-invalid @enderror"
                                                id="leader_id" name="leader_id">
                                                <option value="">-- Select Leader --</option>
                                                @foreach ($leaders as $leader)
                                                    <option value="{{ $leader->id }}"
                                                        {{ old('leader_id', $user->leader_id) == $leader->id ? 'selected' : '' }}>
                                                        {{ $leader->name }} - {{ $leader->nickname }} -
                                                        {{ $leader->cell_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('leader_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <x-buttons.form-action primaryTitle="Update User" primaryIcon="fas fa-save"
                                    primaryColor="background:#6f42c1;border-color:#6f42c1;color:#fff;"
                                    primaryButton="btn px-4" />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .white_card_header {
                padding: 1.5rem 1.5rem 0;
            }
        </style>
    @endpush
@endsection
