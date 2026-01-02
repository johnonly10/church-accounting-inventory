@extends('layouts.staff')
@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create New User" active="Create New User" home="Users" :home-route="route('staff.users.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">User Information</h3>
                                <p class="text-muted mb-0">Fill in the details to create a new user account</p>
                            </div>
                        </div>
                    </div>

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.users.store') }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf

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
                                                value="{{ old('name') }}" required>
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
                                                value="{{ old('email') }}" required>
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
                                                id="department_id" name="department_id" required>
                                                <option value="">-- Select Department --</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                                                id="ministry_id" name="ministry_id" required>
                                                <option value="">-- Select Ministry --</option>
                                                @foreach ($ministries as $ministry)
                                                    <option value="{{ $ministry->id }}"
                                                        {{ old('ministry_id') == $ministry->id ? 'selected' : '' }}>
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
                                                id="leader_id" name="leader_id" required>
                                                <option value="">-- Select Leader --</option>
                                                @foreach ($leaders as $leader)
                                                    <option value="{{ $leader->id }}"
                                                        {{ old('leader_id') == $leader->id ? 'selected' : '' }}>
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

                                <hr class="my-4">

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-user-lock me-2"></i>Password
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="password">
                                                Password <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" placeholder="Enter password"
                                                    autocomplete="new-password" required minlength="8"
                                                    pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$"
                                                    title="Password must be at least 8 characters and include an uppercase letter, a number, and a special character.">

                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword" aria-label="Toggle password visibility">
                                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                                </button>
                                            </div>

                                            <small class="text-muted d-block mt-1">
                                                Must be at least 8 characters and include: 1 uppercase, 1 number, 1 special
                                                character.
                                            </small>

                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Password must be at least 8 characters and include an uppercase letter, a
                                                number, and a special character.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="password_confirmation">
                                                Confirm Password <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Confirm password" autocomplete="new-password" required
                                                    onpaste="return false;">

                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="toggleConfirmPassword"
                                                    aria-label="Toggle confirm password visibility">
                                                    <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                                                </button>
                                            </div>

                                            <div class="invalid-feedback" id="confirmPasswordFeedback">
                                                Passwords do not match.
                                            </div>

                                            @error('password_confirmation')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <x-buttons.form-action cancelTitle="Cancel"
                                    cancelRoute="{{ route('staff.users.index') }}" cancelIcon="fas fa-times"
                                    primaryTitle="Create New User" primaryIcon="fas fa-user-plus"
                                    primaryColor="background:#6f42c1;border-color:#6f42c1;color:#fff;"
                                    primaryButton="btn px-4" primaryId="createUserBtn" :primaryDisabled="true" />
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form.needs-validation') || document.querySelector('form');
                const nameEl = document.getElementById('name');
                const emailEl = document.getElementById('email');
                const passwordEl = document.getElementById('password');
                const confirmEl = document.getElementById('password_confirmation');
                const submitBtn = document.getElementById('createUserBtn');

                const togglePasswordBtn = document.getElementById('togglePassword');
                const togglePasswordIcon = document.getElementById('togglePasswordIcon');
                const toggleConfirmBtn = document.getElementById('toggleConfirmPassword');
                const toggleConfirmIcon = document.getElementById('toggleConfirmPasswordIcon');

                const confirmFeedback = document.getElementById('confirmPasswordFeedback');

                function toggleVisibility(input, icon) {
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }

                if (togglePasswordBtn && passwordEl && togglePasswordIcon) {
                    togglePasswordBtn.addEventListener('click', function() {
                        toggleVisibility(passwordEl, togglePasswordIcon);
                    });
                }

                if (toggleConfirmBtn && confirmEl && toggleConfirmIcon) {
                    toggleConfirmBtn.addEventListener('click', function() {
                        toggleVisibility(confirmEl, toggleConfirmIcon);
                    });
                }

                if (confirmEl) {
                    confirmEl.addEventListener('paste', function(e) {
                        e.preventDefault();
                    });
                }

                function setConfirmMismatchState(isMismatch) {
                    if (isMismatch) {
                        confirmEl.classList.add('is-invalid');
                        if (confirmFeedback) confirmFeedback.style.display = 'block';
                        confirmEl.setCustomValidity('Passwords do not match');
                    } else {
                        confirmEl.classList.remove('is-invalid');
                        if (confirmFeedback) confirmFeedback.style.display = 'none';
                        confirmEl.setCustomValidity('');
                    }
                }

                function validatePasswordMatchRealtime() {
                    const confirmHasValue = confirmEl.value.trim() !== '';
                    const mismatch = confirmHasValue && confirmEl.value !== passwordEl.value;
                    setConfirmMismatchState(mismatch);
                }

                function updateSubmitState() {
                    validatePasswordMatchRealtime();

                    const hasAllValues =
                        nameEl.value.trim() !== '' &&
                        emailEl.value.trim() !== '' &&
                        passwordEl.value.trim() !== '' &&
                        confirmEl.value.trim() !== '';

                    const isValid =
                        nameEl.checkValidity() &&
                        emailEl.checkValidity() &&
                        passwordEl.checkValidity() &&
                        confirmEl.checkValidity();

                    submitBtn.disabled = !(hasAllValues && isValid);
                }

                [nameEl, emailEl, passwordEl, confirmEl].forEach(function(el) {
                    el.addEventListener('input', updateSubmitState);
                    el.addEventListener('blur', updateSubmitState);
                });

                form.addEventListener('submit', function(event) {
                    updateSubmitState();
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);

                if (confirmFeedback) confirmFeedback.style.display = 'none';
                updateSubmitState();
            });
        </script>
    @endpush
@endsection
