@extends('layouts.staff')

@section('content')
    <div class="row">
        <x-page-title title="Edit Profile" active="Edit Profile" :home-route="route('staff.profile.index')" home="Profile" />

        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 border-0 shadow-sm overflow-hidden">
                <div class="profile-cover position-relative"
                    style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="position-absolute top-0 end-0 p-4">
                        <a href="{{ route('staff.profile.index') }}"
                            class="btn btn-light btn-sm px-4 rounded-pill shadow-sm">
                            <i class="fa fa-arrow-left me-2"></i>Back to Profile
                        </a>
                    </div>
                </div>

                <div class="white_card_body bg-white">
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('staff.profile.update', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-4 col-xl-3">
                                    <div class="text-center" style="margin-top: -80px;">
                                        <div class="position-relative d-inline-block mb-3">
                                            <div class="profile-image-container">
                                                <img id="profileImagePreview"
                                                    src="{{ Auth::user()->path ? asset('storage/Profile/' . Auth::user()->path) : asset('storage/Profile/default.jpg') }}"
                                                    alt="{{ Auth::user()->name }}"
                                                    class="rounded-circle shadow-lg border border-5 border-white bg-white"
                                                    style="width: 160px; height: 160px; object-fit: cover;">

                                                <label for="profile_image"
                                                    class="position-absolute bottom-0 end-0 bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm border border-3 border-white cursor-pointer"
                                                    style="width: 44px; height: 44px;">
                                                    <i class="fa fa-camera text-white" style="font-size: 16px;"></i>
                                                </label>
                                                <input type="file"
                                                    class="form-control d-none @error('profile_image') is-invalid @enderror"
                                                    name="profile_image" id="profile_image" accept="image/*"
                                                    onchange="previewImage(event)">
                                            </div>
                                            @error('profile_image')
                                                <div class="invalid-feedback d-block small mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <h4 class="mb-2 fw-bold text-dark">{{ Auth::user()->name }}</h4>
                                        <span
                                            class="badge rounded-pill px-3 py-2 mb-3
                                              bg-{{ Auth::user()->roletype == 'PASTOR' ? 'primary' : (Auth::user()->roletype == 'STAFF' ? 'info' : 'secondary') }}-subtle 
                                              text-{{ Auth::user()->roletype == 'PASTOR' ? 'primary' : (Auth::user()->roletype == 'STAFF' ? 'info' : 'secondary') }}">
                                            {{ Auth::user()->roletype }}
                                        </span>

                                        <div class="card border-0 shadow-sm mt-4">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                                    <div class="flex-shrink-0 bg-primary-subtle rounded-circle p-2 me-3"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fa fa-envelope text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1 text-start">
                                                        <small class="text-muted d-block mb-1">Email</small>
                                                        <p class="mb-0 small fw-medium text-dark text-break">
                                                            {{ Auth::user()->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 bg-success-subtle rounded-circle p-2 me-3"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fa fa-calendar-check text-success"></i>
                                                    </div>
                                                    <div class="flex-grow-1 text-start">
                                                        <small class="text-muted d-block mb-1">Member Since</small>
                                                        <p class="mb-0 small fw-medium text-dark">
                                                            {{ Auth::user()->created_at->format('M d, Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-xl-9">
                                    <div class="mt-4 mt-lg-0">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header bg-gradient-light border-0 py-3">
                                                        <h6 class="mb-0 fw-semibold text-dark">
                                                            <i class="fa fa-building text-primary me-2"></i>Ministry &
                                                            Organization
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-4">
                                                        <div class="row g-4">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label
                                                                        class="text-muted small d-block mb-2 text-uppercase"
                                                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">Department</label>
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="info-icon bg-primary-subtle rounded p-2 me-3">
                                                                            <i class="fa fa-sitemap text-primary"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <select
                                                                                class="form-select @error('department_id') is-invalid @enderror"
                                                                                name="department_id" id="department_id"
                                                                                style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                                                <option value="">Select Department
                                                                                </option>
                                                                                @foreach ($departments as $department)
                                                                                    <option value="{{ $department->id }}"
                                                                                        {{ Auth::user()->department_id == $department->id ? 'selected' : '' }}>
                                                                                        {{ $department->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('department_id')
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label
                                                                        class="text-muted small d-block mb-2 text-uppercase"
                                                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">Ministry</label>
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="info-icon bg-success-subtle rounded p-2 me-3">
                                                                            <i class="fa fa-hands-helping text-success"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <select
                                                                                class="form-select @error('ministry_id') is-invalid @enderror"
                                                                                name="ministry_id" id="ministry_id"
                                                                                style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                                                <option value="">Select Ministry
                                                                                </option>
                                                                                @foreach ($ministries as $ministry)
                                                                                    <option value="{{ $ministry->id }}"
                                                                                        {{ Auth::user()->ministry_id == $ministry->id ? 'selected' : '' }}>
                                                                                        {{ $ministry->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('ministry_id')
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label
                                                                        class="text-muted small d-block mb-2 text-uppercase"
                                                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">Position</label>
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="info-icon bg-warning-subtle rounded p-2 me-3">
                                                                            <i class="fa fa-id-badge text-warning"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <select
                                                                                class="form-select @error('position_id') is-invalid @enderror"
                                                                                name="position_id" id="position_id"
                                                                                style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                                                <option value="">Select Position
                                                                                </option>
                                                                                @foreach ($positions as $position)
                                                                                    <option value="{{ $position->id }}"
                                                                                        {{ Auth::user()->position_id == $position->id ? 'selected' : '' }}>
                                                                                        {{ $position->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('position_id')
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header bg-gradient-light border-0 py-3">
                                                        <h6 class="mb-0 fw-semibold text-dark">
                                                            <i class="fa fa-users text-success me-2"></i>Leadership & Cell
                                                            Group
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-4">
                                                        <div class="row g-4">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label
                                                                        class="text-muted small d-block mb-2 text-uppercase"
                                                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">Leader</label>
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="info-icon bg-success-subtle rounded p-2 me-3">
                                                                            <i class="fa fa-user-tie text-success"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <select
                                                                                class="form-select @error('leader_id') is-invalid @enderror"
                                                                                name="leader_id" id="leader_id"
                                                                                style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                                                <option value="">Select Leader
                                                                                </option>
                                                                                @foreach ($leaders as $leader)
                                                                                    <option value="{{ $leader->id }}"
                                                                                        {{ Auth::user()->leader_id == $leader->id ? 'selected' : '' }}>
                                                                                        {{ $leader->name }}
                                                                                        ({{ $leader->nickname }})
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('leader_id')
                                                                                <div class="invalid-feedback d-block">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="info-item">
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="info-icon bg-primary-subtle rounded p-2 me-3">
                                                                            <i class="fa fa-users-cog text-primary"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <label
                                                                                class="text-muted small d-block mb-1 text-uppercase"
                                                                                style="font-size: 0.7rem; letter-spacing: 0.5px;">Cell
                                                                                Name</label>
                                                                            <p class="mb-0 text-dark fw-semibold">
                                                                                {{ Auth::user()->leader->cell_name ?? 'Not Assigned' }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <x-buttons.form-action primaryTitle="Edit Profile"
                                                primaryId="updateProfileBtn" :cancel-route="route('staff.profile.index')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .white_card {
            border-radius: 16px;
            overflow: hidden;
        }

        .profile-cover {
            position: relative;
        }

        .profile-cover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.1), transparent);
        }

        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
        }

        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-select {
            padding: 0.75rem 1rem;
            font-weight: 500;
            color: #2d3748;
            background-color: white;
            border: 1px solid #e2e8f0;
        }

        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .btn-light,
        .btn-primary {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .bg-primary-subtle {
            background-color: #e9ecf9 !important;
        }

        .bg-success-subtle {
            background-color: #d1f4e0 !important;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }

        .bg-info-subtle {
            background-color: #d1ecf1 !important;
        }

        .bg-secondary-subtle {
            background-color: #e9ecef !important;
        }

        .text-primary {
            color: #667eea !important;
        }

        .text-success {
            color: #48bb78 !important;
        }

        .text-warning {
            color: #f59e0b !important;
        }

        .text-info {
            color: #06b6d4 !important;
        }

        .text-dark {
            color: #2d3748 !important;
        }

        .text-muted {
            color: #718096 !important;
        }

        .border-bottom {
            border-color: #e2e8f0 !important;
        }

        @media (max-width: 991px) {
            .profile-cover {
                height: 150px !important;
            }

            .text-center img {
                width: 120px !important;
                height: 120px !important;
            }
        }
    </style>

    @push('scripts')
        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profileImagePreview').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }

            document.getElementById('profileImagePreview').addEventListener('click', function() {
                document.getElementById('profile_image').click();
            });
        </script>
    @endpush
@endsection
