@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Edit Event" active="Edit Event" home="Events" :home-route="route('leader.events.index')" />
        <x-sweet-alert entity="Event" />

        @php
            $rawPath = $event->image_path;
            $normalized = $rawPath ? ltrim(str_replace('\\', '/', $rawPath), '/') : null;
            $isUrl = $normalized && preg_match('/^https?:\/\//i', $normalized);

            $existingImageUrl = null;
            if ($normalized) {
                if ($isUrl) {
                    $existingImageUrl = $normalized;
                } elseif (str_starts_with($normalized, 'Images/Events/')) {
                    $existingImageUrl = asset($normalized);
                } else {
                    $existingImageUrl = asset('Images/Events/' . $normalized);
                }
            }

            $existingImageName = $existingImageUrl
                ? basename(parse_url($existingImageUrl, PHP_URL_PATH) ?? $existingImageUrl)
                : null;

            $startAtValue = optional($event->start_at)->format('Y-m-d\TH:i');
            $endsAtValue = optional($event->ends_at)->format('Y-m-d\TH:i');
        @endphp

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Event's Information" subTitle="Update the details for this event" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('leader.events.update', $event) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="remove_image" id="removeImageInput" value="0">

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        Basic Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter event name"
                                                value="{{ old('name', $event->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="short_description">
                                                Short Description <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                                name="short_description" rows="4" placeholder="Enter a brief description" required>{{ old('short_description', $event->short_description) }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="description">
                                                Full Description <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="8" placeholder="Enter detailed description" required>{{ old('description', $event->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-clock me-2"></i>
                                        Date & Time
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="start_at">
                                                Start Date & Time <span class="text-danger">*</span>
                                            </label>
                                            <input type="datetime-local"
                                                class="form-control @error('start_at') is-invalid @enderror" id="start_at"
                                                name="start_at" value="{{ old('start_at', $startAtValue) }}" required>
                                            @error('start_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="ends_at">
                                                End Date & Time <span class="text-danger">*</span>
                                            </label>
                                            <input type="datetime-local"
                                                class="form-control @error('ends_at') is-invalid @enderror" id="ends_at"
                                                name="ends_at" value="{{ old('ends_at', $endsAtValue) }}" required>
                                            @error('ends_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        Location & Media
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="location">
                                                Location <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" id="location"
                                                name="location" placeholder="Enter event location"
                                                value="{{ old('location', $event->location) }}" required>
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold d-block">
                                                Event Image <span class="text-danger">*</span>
                                            </label>

                                            <div class="position-relative">
                                                <button type="button" class="btn btn-outline-primary w-100" id="uploadBtn">
                                                    <i class="bi bi-cloud-upload me-2"></i>
                                                    <span id="uploadBtnText">Choose Image File</span>
                                                </button>

                                                <input type="file" name="image_path"
                                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0 @error('image_path') is-invalid @enderror"
                                                    id="imageInput" accept="image/*" style="cursor:pointer;">
                                            </div>

                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)
                                            </small>

                                            @error('image_path')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold d-block">Preview</label>

                                            <div class="border rounded-3 bg-light position-relative overflow-hidden"
                                                style="min-height: 300px; max-height: 400px;" id="previewContainer">
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5"
                                                    id="emptyState" style="min-height: 300px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                                                    <p class="text-muted mt-3 mb-0">No image selected</p>
                                                    <small class="text-muted">Upload an image to see preview</small>
                                                </div>

                                                <div class="d-none w-100 h-100 position-relative" id="imagePreview">
                                                    <img src="" alt="Preview" id="previewImg"
                                                        class="img-fluid w-100 h-100"
                                                        style="object-fit: contain; max-height: 400px;">

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                        id="removeImageBtn" title="Remove image">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-3 d-none" id="imageDetails">
                                                <small class="text-muted d-block">
                                                    <strong>Filename:</strong> <span id="fileName"></span>
                                                </small>
                                                <small class="text-muted d-block">
                                                    <strong>Size:</strong> <span id="fileSize"></span>
                                                </small>
                                                <small class="text-muted d-block">
                                                    <strong>Dimensions:</strong> <span id="fileDimensions"></span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-buttons.form-action primaryTitle="Update Event" primaryId="updateEventBtn"
                                    :cancel-route="route('leader.events.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageInput');
            const uploadBtn = document.getElementById('uploadBtn');
            const uploadBtnText = document.getElementById('uploadBtnText');
            const emptyState = document.getElementById('emptyState');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const removeImageBtn = document.getElementById('removeImageBtn');
            const imageDetails = document.getElementById('imageDetails');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const fileDimensions = document.getElementById('fileDimensions');
            const removeImageInput = document.getElementById('removeImageInput');

            const allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
            const allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
            const maxBytes = 2 * 1024 * 1024;

            const existingImageUrl = @json($existingImageUrl);
            const existingImageName = @json($existingImageName);
            const hasExisting = !!existingImageUrl;

            function swalError(message, title = "Upload Error") {
                if (window.SwalKit && typeof window.SwalKit.error === "function") {
                    window.SwalKit.error(message, {
                        title
                    });
                    return;
                }

                if (window.Swal && typeof window.Swal.fire === "function") {
                    Swal.fire({
                        icon: "error",
                        title,
                        text: message,
                        confirmButtonText: "Okay",
                        allowOutsideClick: false,
                    });
                }
            }

            function setRequiredIfNeeded() {
                const removedExisting = removeImageInput.value === "1";
                const hasNewFile = imageInput.files && imageInput.files.length > 0;

                if ((!hasExisting && !hasNewFile) || (removedExisting && !hasNewFile)) {
                    imageInput.setAttribute('required', 'required');
                } else {
                    imageInput.removeAttribute('required');
                }
            }

            function showPreviewFromUrl(url, nameForUi = '') {
                previewImg.src = url;
                emptyState.classList.add('d-none');
                imagePreview.classList.remove('d-none');
                imageDetails.classList.remove('d-none');

                if (nameForUi) fileName.textContent = nameForUi;
                fileSize.textContent = hasExisting ? '—' : '';

                const img = new Image();
                img.onload = function() {
                    fileDimensions.textContent = `${this.width} × ${this.height} px`;
                };
                img.src = url;
            }

            function resetFileUI(options = {}) {
                const keepExisting = options.keepExisting === true;

                imageInput.value = '';
                uploadBtnText.textContent = keepExisting && existingImageName ? existingImageName :
                    'Choose Image File';
                uploadBtn.classList.remove('btn-primary');
                uploadBtn.classList.add('btn-outline-primary');

                previewImg.src = '';
                fileName.textContent = '';
                fileSize.textContent = '';
                fileDimensions.textContent = '';

                if (keepExisting && hasExisting && removeImageInput.value !== "1") {
                    showPreviewFromUrl(existingImageUrl, existingImageName || 'Current Image');
                } else {
                    emptyState.classList.remove('d-none');
                    imagePreview.classList.add('d-none');
                    imageDetails.classList.add('d-none');
                }

                setRequiredIfNeeded();
            }

            if (hasExisting) {
                removeImageInput.value = "0";
                uploadBtnText.textContent = existingImageName || 'Current Image';
                showPreviewFromUrl(existingImageUrl, existingImageName || 'Current Image');
            }

            setRequiredIfNeeded();

            imageInput.addEventListener('click', function() {
                this.value = null;
            });

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    setRequiredIfNeeded();
                    return;
                }

                removeImageInput.value = "0";

                const ext = (file.name.split('.').pop() || '').toLowerCase();
                const isAllowedType = (file.type && allowedMimeTypes.includes(file.type)) || (!file.type &&
                    allowedExt.includes(ext)) || allowedExt.includes(ext);

                if (!isAllowedType) {
                    resetFileUI({
                        keepExisting: hasExisting
                    });
                    swalError('Invalid file type. Please upload only JPEG, PNG, JPG, or GIF.',
                        'Invalid File Type');
                    return;
                }

                if (file.size > maxBytes) {
                    resetFileUI({
                        keepExisting: hasExisting
                    });
                    swalError(`File size exceeded 2MB. Your file is ${formatFileSize(file.size)}.`,
                        'File Too Large');
                    return;
                }

                uploadBtnText.textContent = file.name;
                uploadBtn.classList.remove('btn-outline-primary');
                uploadBtn.classList.add('btn-primary');

                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    emptyState.classList.add('d-none');
                    imagePreview.classList.remove('d-none');
                    imageDetails.classList.remove('d-none');
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);

                    const img = new Image();
                    img.onload = function() {
                        fileDimensions.textContent = `${this.width} × ${this.height} px`;
                    };
                    img.src = event.target.result;

                    setRequiredIfNeeded();
                };
                reader.readAsDataURL(file);
            });

            removeImageBtn.addEventListener('click', function() {
                removeImageInput.value = "1";
                resetFileUI({
                    keepExisting: false
                });
            });

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
            }
        });
    </script>

    @error('image_path')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const msg = @json($message);

                if (window.SwalKit && typeof window.SwalKit.error === "function") {
                    window.SwalKit.error(msg, {
                        title: "Invalid Image"
                    });
                    return;
                }

                if (window.Swal && typeof window.Swal.fire === "function") {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid Image",
                        text: msg,
                        confirmButtonText: "Okay",
                        allowOutsideClick: false,
                    });
                }
            });
        </script>
    @enderror
@endpush
