@extends('layouts.staff')

@section('content')
    <div class="row g-4">
        <x-page-title title="My Profile" active="Profile" />

        <div class="col-lg-12">
            <!-- Main Profile Card -->
            <div class="profile-card card shadow-lg border-0 overflow-hidden">
                <!-- Cover Image with Gradient -->
                <div class="cover-section position-relative">
                    <div class="cover-gradient"
                        style="background: linear-gradient(135deg, 
                                 #667eea 0%, 
                                 #764ba2 30%, 
                                 #f687b3 100%);">
                    </div>

                    <!-- Edit Button Floating -->
                    <div class="cover-actions position-absolute top-0 end-0 p-4">
                        <a href="{{ route('staff.profile.edit', Auth::user()->id) }}"
                            class="btn btn-white btn-sm px-4 rounded-pill shadow-sm hover-lift">
                            <i class="fa fa-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left Sidebar - Profile Overview -->
                        <div class="col-lg-4 col-xl-3 sidebar-section bg-white">
                            <div class="profile-overview px-4 pt-5 pb-4">
                                <!-- Profile Image with Status -->
                                <div class="avatar-container position-relative mx-auto mb-4" style="max-width: 160px;">
                                    <div class="avatar-wrapper position-relative">
                                        <img src="{{ Auth::user()->path ? asset('storage/Profile/' . Auth::user()->path) : asset('storage/Profile/default.jpg') }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="avatar-image rounded-circle shadow-lg border-4 border-white">

                                        <!-- Role Badge -->
                                        <div class="avatar-badge position-absolute bottom-0 end-0 shadow-sm">
                                            <div
                                                class="badge-icon bg-{{ Auth::user()->roletype == 'PASTOR' ? 'primary' : (Auth::user()->roletype == 'STAFF' ? 'info' : 'secondary') }}">
                                                <i
                                                    class="fa fa-{{ Auth::user()->roletype == 'PASTOR' ? 'crown' : (Auth::user()->roletype == 'STAFF' ? 'briefcase' : 'user') }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Info -->
                                <div class="text-center mb-4">
                                    <h4 class="mb-2 fw-bold text-dark">{{ Auth::user()->name }}</h4>
                                    <div class="role-badge mb-3">
                                        <span
                                            class="badge px-3 py-2 fw-medium 
                                              bg-{{ Auth::user()->roletype == 'PASTOR' ? 'primary' : (Auth::user()->roletype == 'STAFF' ? 'info' : 'secondary') }}-subtle 
                                              text-{{ Auth::user()->roletype == 'PASTOR' ? 'primary' : (Auth::user()->roletype == 'STAFF' ? 'info' : 'secondary') }}">
                                            {{ Auth::user()->roletype }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Quick Info Cards -->
                                <div class="quick-info">
                                    <!-- Email Card -->
                                    <div class="info-card mb-3">
                                        <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                            <div class="info-icon bg-primary-soft rounded-circle p-2 me-3">
                                                <i class="fa fa-envelope text-primary"></i>
                                            </div>
                                            <div class="info-content">
                                                <small
                                                    class="text-muted d-block mb-1 text-uppercase fw-semibold">Email</small>
                                                <p class="mb-0 text-dark text-break small">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Member Since Card -->
                                    <div class="info-card">
                                        <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                                            <div class="info-icon bg-success-soft rounded-circle p-2 me-3">
                                                <i class="fa fa-calendar-alt text-success"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted d-block mb-1 text-uppercase fw-semibold">Member
                                                    Since</small>
                                                <p class="mb-0 text-dark fw-medium">
                                                    {{ Auth::user()->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Content - Detailed Information -->
                        <div class="col-lg-8 col-xl-9 content-section">
                            <div class="p-4 p-lg-5">
                                <!-- Ministry & Organization Section -->
                                <div class="section-card mb-4">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <div class="icon-wrapper bg-primary-soft rounded-circle p-2 me-3">
                                            <i class="fa fa-church text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Ministry & Organization</h5>
                                            <p class="text-muted small mb-0">Your assigned roles and responsibilities</p>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Department -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-primary-subtle rounded p-2 me-3">
                                                        <i class="fa fa-sitemap text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small
                                                            class="text-muted d-block mb-1 text-uppercase">Department</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->department->name ?? 'Not Assigned' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ministry -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-success-subtle rounded p-2 me-3">
                                                        <i class="fa fa-hands-helping text-success"></i>
                                                    </div>
                                                    <div>
                                                        <small
                                                            class="text-muted d-block mb-1 text-uppercase">Ministry</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->ministry->name ?? 'Not Assigned' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Position -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-warning-subtle rounded p-2 me-3">
                                                        <i class="fa fa-id-badge text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <small
                                                            class="text-muted d-block mb-1 text-uppercase">Position</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->position->name ?? 'Not Assigned' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Last Updated -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-info-subtle rounded p-2 me-3">
                                                        <i class="fa fa-clock text-info"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block mb-1 text-uppercase">Last
                                                            Updated</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->updated_at->format('M d, Y') }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Leadership & Cell Group Section -->
                                <div class="section-card">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <div class="icon-wrapper bg-success-soft rounded-circle p-2 me-3">
                                            <i class="fa fa-users text-success"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Leadership & Cell Group</h5>
                                            <p class="text-muted small mb-0">Your leadership structure and community</p>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Leader -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-success-subtle rounded p-2 me-3">
                                                        <i class="fa fa-user-tie text-success"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block mb-1 text-uppercase">Leader</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->leader ? Auth::user()->leader->name . ' (' . Auth::user()->leader->nickname . ')' : 'Not Assigned' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Cell Group -->
                                        <div class="col-md-6">
                                            <div class="detail-item p-3 rounded-3 border bg-white">
                                                <div class="d-flex align-items-center">
                                                    <div class="detail-icon bg-primary-subtle rounded p-2 me-3">
                                                        <i class="fa fa-users-cog text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block mb-1 text-uppercase">Cell
                                                            Group</small>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ Auth::user()->leader->cell_name ?? 'Not Assigned' }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-sweet-alert entity="Profile" />
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Profile Design */
        .profile-card {
            border-radius: 20px;
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
        }

        /* Cover Section */
        .cover-section {
            height: 180px;
            overflow: hidden;
        }

        .cover-gradient {
            height: 100%;
            position: relative;
        }

        .cover-gradient::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3));
        }

        /* Sidebar */
        .sidebar-section {
            border-right: 1px solid #eef2f7;
            position: relative;
        }

        .sidebar-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        /* Avatar */
        .avatar-container {
            position: relative;
        }

        .avatar-wrapper {
            display: inline-block;
            position: relative;
        }

        .avatar-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .avatar-badge {
            width: 48px;
            height: 48px;
            z-index: 2;
        }

        .badge-icon {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            border: 4px solid white;
        }

        /* Content Section */
        .content-section {
            background: linear-gradient(135deg, #fafbfc 0%, #ffffff 100%);
        }

        /* Section Cards */
        .section-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .section-header {
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }

        /* Detail Items */
        .detail-item {
            transition: all 0.3s ease;
            border: 1px solid #eef2f7 !important;
        }

        .detail-item:hover {
            border-color: #667eea !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }

        .detail-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Quick Info */
        .quick-info .info-card {
            transition: all 0.3s ease;
        }

        .quick-info .info-card:hover {
            transform: translateX(4px);
        }

        .info-card .info-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Buttons */
        .btn-white {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        /* Color Utilities */
        .bg-primary-soft {
            background-color: rgba(102, 126, 234, 0.1) !important;
        }

        .bg-success-soft {
            background-color: rgba(72, 187, 120, 0.1) !important;
        }

        .bg-info-soft {
            background-color: rgba(6, 182, 212, 0.1) !important;
        }

        .bg-warning-soft {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }

        /* Typography */
        h5,
        h6 {
            color: #1e293b;
        }

        .text-muted {
            color: #64748b !important;
        }

        .text-dark {
            color: #334155 !important;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .cover-section {
                height: 140px;
            }

            .avatar-image {
                width: 120px;
                height: 120px;
            }

            .sidebar-section {
                border-right: none;
                border-bottom: 1px solid #eef2f7;
            }

            .content-section {
                padding: 20px !important;
            }

            .profile-overview {
                padding-top: 40px !important;
                padding-bottom: 40px !important;
            }
        }

        @media (max-width: 767.98px) {
            .section-card {
                padding: 20px !important;
            }

            .detail-item {
                margin-bottom: 12px;
            }

            .avatar-badge {
                width: 40px;
                height: 40px;
            }

            .badge-icon {
                font-size: 16px;
                border-width: 3px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .section-card:nth-child(2) {
            animation-delay: 0.2s;
        }
    </style>
@endsection
