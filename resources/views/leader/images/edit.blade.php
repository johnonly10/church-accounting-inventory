@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Edit Image" active="Edit Images" :home-route="route('leader.images.index')" home="Images" />

        <x-white-card title="Edit Image" :back-route="route('leader.images.index')">
            <form action="{{ route('leader.images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control form-select @error('type') is-invalid @enderror"
                                id="imageType">
                                <option value="" disabled>-- Select Type --</option>
                                <option value="logo" {{ old('type', $image->type) === 'logo' ? 'selected' : '' }}>Logo
                                </option>
                                <option value="background"
                                    {{ old('type', $image->type) === 'background' ? 'selected' : '' }}>Background</option>
                                <option value="background_2"
                                    {{ old('type', $image->type) === 'background_2' ? 'selected' : '' }}>Background 2
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $image->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="e.g., Company Logo">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Image File</label>

                            <div class="position-relative">
                                <button type="button" class="btn btn-outline-primary w-100" id="uploadBtn">
                                    <i class="bi bi-cloud-upload me-2"></i>
                                    <span id="uploadBtnText">Choose Image File</span>
                                </button>

                                <input type="file" name="path"
                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0 @error('path') is-invalid @enderror"
                                    id="imageInput" style="cursor:pointer;">
                            </div>

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Supported formats: JPG, PNG, GIF, SVG, WEBP. Max size: 2MB
                            </small>

                            @error('path')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    id="is_active" role="switch"
                                    {{ old('is_active', $image->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Set as Active
                                </label>
                            </div>
                            <small class="text-muted ms-4">
                                Active images will be displayed on the website
                            </small>
                            @error('is_active')
                                <div class="text-danger small ms-4">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Preview</label>

                            <div class="border rounded-3 bg-light position-relative overflow-hidden"
                                style="min-height: 300px; max-height: 400px;" id="previewContainer">

                                <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 {{ $image->path ? 'd-none' : '' }}"
                                    id="emptyState" style="min-height: 300px;">
                                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                                    <p class="text-muted mt-3 mb-0">No image selected</p>
                                    <small class="text-muted">Upload an image to see preview</small>
                                </div>

                                <div class="{{ $image->path ? '' : 'd-none' }} w-100 h-100 position-relative"
                                    id="imagePreview">
                                    @php
                                        $src = str_starts_with($image->path, 'Images/')
                                            ? asset($image->path)
                                            : asset('Images/' . ltrim($image->path, '/'));
                                    @endphp

                                    <img src="{{ $src }}" alt="Preview" id="previewImg"
                                        class="img-fluid w-100 h-100" style="object-fit: contain; max-height: 400px;">

                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                        id="removeImageBtn" title="Remove image">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-3 {{ $image->path ? '' : 'd-none' }}" id="imageDetails">
                                <small class="text-muted d-block">
                                    <strong>Current:</strong>
                                    <span id="currentPath">{{ $image->path }}</span>
                                </small>
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

                    <div class="col-12 mt-3">
                        <x-buttons.form-action primaryTitle="Update Image" primaryId="updateImagesBtn" :cancel-route="route('leader.images.index')" />
                    </div>

                    <x-sweet-alert entity="Images" />
                </div>
            </form>
        </x-white-card>
    </div>

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

                const allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
                const allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
                const maxBytes = 2 * 1024 * 1024;

                function swalError(message, title) {
                    if (window.SwalKit && typeof window.SwalKit.error === "function") {
                        window.SwalKit.error(message, {
                            title: title || "Upload Error"
                        });
                        return;
                    }
                    alert(message);
                }

                function resetFileUI() {
                    imageInput.value = '';
                    uploadBtnText.textContent = 'Choose Image File';
                    uploadBtn.classList.remove('btn-primary');
                    uploadBtn.classList.add('btn-outline-primary');
                    fileName.textContent = '';
                    fileSize.textContent = '';
                    fileDimensions.textContent = '';
                }

                imageInput.addEventListener('click', function() {
                    this.value = null;
                });

                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const ext = (file.name.split('.').pop() || '').toLowerCase();
                    const isAllowedType = (file.type && allowedMimeTypes.includes(file.type)) || (!file.type &&
                        allowedExt.includes(ext)) || allowedExt.includes(ext);

                    if (!isAllowedType) {
                        resetFileUI();
                        swalError('Invalid file type. Please upload only JPG, PNG, GIF, SVG, or WEBP.',
                            'Invalid File Type');
                        return;
                    }

                    if (file.size > maxBytes) {
                        resetFileUI();
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
                    };
                    reader.readAsDataURL(file);
                });

                removeImageBtn.addEventListener('click', function() {
                    resetFileUI();
                    emptyState.classList.remove('d-none');
                    imagePreview.classList.add('d-none');
                    if (!document.getElementById('currentPath')?.textContent) {
                        imageDetails.classList.add('d-none');
                    }
                    previewImg.src = '';
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
    @endpush
@endsection
