@extends('layouts.guest')
@section('content')
    <x-hero-section title="Edit Profile" :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'My Account', 'url' => route('member.profiles.index')],
        ['label' => 'Edit Profile'],
    ]" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --ink: #12111a;
            --ink-2: #3d3a52;
            --muted: #8b87a8;
            --border: #e8e6f0;
            --surface: #f5f4fb;
            --card: #ffffff;
            --accent: #7c5cfc;
            --accent-d: #5b3de8;
            --accent-l: #ede8ff;
            --danger: #ef4444;
            --danger-l: #fef2f2;
            --success: #10b981;
            --success-l: #ecfdf5;
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 9px;
            --shadow-md: 0 8px 28px rgba(124, 92, 252, .13);
            --transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--surface);
            color: var(--ink);
        }

        .edit-page {
            padding: 56px 0 88px;
        }

        .edit-card {
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 40px 44px;
            max-width: 800px;
            margin: 0 auto;
        }

        .edit-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--accent-l);
        }

        .edit-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .edit-title i {
            color: var(--accent);
            font-size: 1.2rem;
        }

        .form-section {
            margin-bottom: 28px;
        }

        .form-section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            color: var(--accent);
            font-size: .9rem;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'Outfit', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            background: var(--surface);
            transition: var(--transition);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(124, 92, 252, .12);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
            background: var(--danger-l);
        }

        select.form-control {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%238b87a8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
            cursor: pointer;
        }

        .form-control::placeholder {
            color: var(--muted);
        }

        .form-text {
            font-size: .75rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .readonly-field {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--accent-l);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: .88rem;
            color: var(--ink-2);
        }

        .readonly-field i {
            color: var(--muted);
            font-size: .9rem;
        }

        .image-upload-section {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 16px;
            background: var(--surface);
            border: 1.5px dashed var(--border);
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .image-upload-section:hover {
            border-color: var(--accent);
            background: var(--accent-l);
        }

        .current-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-l);
            flex-shrink: 0;
        }

        .image-upload-info {
            flex-grow: 1;
        }

        .image-upload-info .upload-title {
            font-weight: 600;
            font-size: .85rem;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .image-upload-info .upload-hint {
            font-size: .75rem;
            color: var(--muted);
        }

        .btn-upload {
            background: var(--accent-l);
            color: var(--accent);
            border: 1.5px solid var(--accent);
            font-family: 'Outfit', sans-serif;
            font-size: .79rem;
            font-weight: 500;
            padding: 7px 18px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-upload:hover {
            background: var(--accent);
            color: #fff;
        }

        .btn-remove-image {
            background: var(--danger-l);
            color: var(--danger);
            border: 1.5px solid var(--danger);
            font-family: 'Outfit', sans-serif;
            font-size: .75rem;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 8px;
        }

        .btn-remove-image:hover {
            background: var(--danger);
            color: #fff;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .btn-cancel {
            background: none;
            border: 1.5px solid var(--border);
            color: var(--muted);
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: .85rem;
            padding: 10px 24px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-cancel:hover {
            border-color: var(--ink-2);
            color: var(--ink);
            background: var(--surface);
        }

        .btn-save {
            background: var(--accent);
            border: none;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: .85rem;
            padding: 10px 28px;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-save:hover {
            background: var(--accent-d);
            box-shadow: 0 6px 18px rgba(124, 92, 252, .35);
            transform: translateY(-1px);
        }

        .preview-image {
            max-width: 120px;
            max-height: 120px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            margin-top: 8px;
            border: 2px solid var(--accent-l);
            display: none;
        }

        @media (max-width: 767.98px) {
            .edit-card {
                padding: 24px 18px;
            }

            .image-upload-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-cancel,
            .btn-save {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <section class="edit-page">
        <div class="container">
            <div class="edit-card">
                <div class="edit-header">
                    <div class="edit-title">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </div>
                </div>

                <form action="{{ route('member.profiles.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-person-lock"></i> Account Information
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <div class="readonly-field">
                                        <i class="bi bi-person"></i>
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <div class="readonly-field">
                                        <i class="bi bi-envelope"></i>
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-gear"></i> Organization Details
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="department_id">Department</label>
                                    <select name="department_id" id="department_id"
                                        class="form-control @error('department_id') is-invalid @enderror">
                                        <option value="">-- Select Department --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="leader_id">Leader</label>
                                    <select name="leader_id" id="leader_id"
                                        class="form-control @error('leader_id') is-invalid @enderror">
                                        <option value="">-- Select Leader --</option>
                                        @foreach ($leaders as $leader)
                                            <option value="{{ $leader->id }}"
                                                {{ old('leader_id', $user->leader_id) == $leader->id ? 'selected' : '' }}>
                                                {{ $leader->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="ministry_id">Ministry</label>
                                    <select name="ministry_id" id="ministry_id"
                                        class="form-control @error('ministry_id') is-invalid @enderror">
                                        <option value="">-- Select Ministry --</option>
                                        @foreach ($ministries as $ministry)
                                            <option value="{{ $ministry->id }}"
                                                {{ old('ministry_id', $user->ministry_id) == $ministry->id ? 'selected' : '' }}>
                                                {{ $ministry->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="position_id">Position</label>
                                    <select name="position_id" id="position_id"
                                        class="form-control @error('position_id') is-invalid @enderror">
                                        <option value="">-- Select Position --</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="pepsol_type_id">PEPSOL</label>
                                    <select name="pepsol_type_id" id="pepsol_type_id"
                                        class="form-control @error('pepsol_type_id') is-invalid @enderror">
                                        <option value="">-- Select PEPSOL --</option>
                                        @foreach ($pepsolTypes as $pepsolType)
                                            <option value="{{ $pepsolType->id }}"
                                                {{ old('pepsol_type_id', $user->pepsol_type_id) == $pepsolType->id ? 'selected' : '' }}>
                                                {{ $pepsolType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="bi bi-camera"></i> Profile Image
                        </div>
                        <div class="image-upload-section">
                            <img src="{{ $user->path ? asset('storage/' . $user->path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=7c5cfc&color=ffffff&size=200&bold=true' }}"
                                alt="Current Profile" class="current-image" id="currentImage">
                            <div class="image-upload-info">
                                <div class="upload-title">Upload a new profile photo</div>
                                <div class="upload-hint">JPEG, PNG or GIF. Max 2MB.</div>
                                <input type="file" name="profile_image" id="profile_image"
                                    class="d-none @error('profile_image') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/gif" onchange="previewImage(event)">
                                <button type="button" class="btn-upload mt-2"
                                    onclick="document.getElementById('profile_image').click()">
                                    <i class="bi bi-upload"></i> Choose Image
                                </button>
                                @if ($user->path)
                                    <button type="button" class="btn-remove-image" onclick="removeImage()">
                                        <i class="bi bi-trash"></i> Remove Image
                                    </button>
                                @endif
                                <img id="imagePreview" class="preview-image" alt="Preview">
                                <div id="fileName"
                                    style="font-size:.75rem;color:var(--accent);margin-top:4px;display:none;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('member.profiles.index') }}" class="btn-cancel">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const fileName = document.getElementById('fileName');
            const currentImage = document.getElementById('currentImage');

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: 'File size must be less than 2MB.',
                        confirmButtonColor: '#7c5cfc'
                    });
                    event.target.value = '';
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Only JPEG, PNG, and GIF files are allowed.',
                        confirmButtonColor: '#7c5cfc'
                    });
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    currentImage.style.opacity = '0.5';
                };
                reader.readAsDataURL(file);

                fileName.textContent = 'Selected: ' + file.name;
                fileName.style.display = 'block';
            }
        }

        function removeImage() {
            Swal.fire({
                icon: 'warning',
                title: 'Remove Profile Image?',
                text: 'This will delete your current profile image from storage.',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#8b87a8'
            }).then((result) => {
                if (result.isConfirmed) {
                    let input = document.querySelector('input[name="remove_image"]');
                    if (!input) {
                        input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'remove_image';
                        input.value = '1';
                        document.querySelector('form').appendChild(input);
                    }

                    document.getElementById('currentImage').src =
                        'https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7c5cfc&color=ffffff&size=200&bold=true';
                    document.getElementById('currentImage').style.opacity = '1';
                    document.getElementById('imagePreview').style.display = 'none';
                    document.getElementById('fileName').style.display = 'none';
                    document.getElementById('profile_image').value = '';
                }
            });
        }

        document.getElementById('profile_image').addEventListener('change', function() {
            const removeInput = document.querySelector('input[name="remove_image"]');
            if (removeInput) {
                removeInput.remove();
            }
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                confirmButtonColor: '#7c5cfc'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Please correct the errors below',
                html: `<ul style="text-align:left;margin:0;padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>`,
                confirmButtonColor: '#7c5cfc'
            });
        @endif
    </script>
@endsection
