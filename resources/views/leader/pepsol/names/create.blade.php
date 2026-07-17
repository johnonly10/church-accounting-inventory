@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create New Pepsol Name" active="Create New Pepsol Name" home="Pepsol Name" :home-route="route('leader.pepsol-names.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Pepsol Name's Information"
                        subTitle="Fill in the details to fill the Pepsol Name information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('leader.pepsol-names.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-list me-2"></i>
                                        Pepsol Name Information
                                    </h5>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter the Pepsol Name"
                                                value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="code">
                                                Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" placeholder="Enter the Pepsol Name code"
                                                value="{{ old('code') }}" required>
                                            @error('code')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-image me-2"></i>
                                        Pepsol Name Image
                                    </h5>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label fw-semibold d-block">Image File <span
                                                        class="text-danger">*</span></label>

                                                <div class="position-relative">
                                                    <button type="button" class="btn btn-outline-primary w-100"
                                                        id="uploadBtn">
                                                        <i class="bi bi-cloud-upload me-2"></i>
                                                        <span id="uploadBtnText">Choose Image File</span>
                                                    </button>

                                                    <input type="file" name="image"
                                                        class="position-absolute top-0 start-0 w-100 h-100 opacity-0 @error('image') is-invalid @enderror"
                                                        id="imageInput" style="cursor:pointer;" accept="image/*">
                                                </div>

                                                <small class="text-muted d-block mt-2">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Supported formats: JPG, PNG, GIF, SVG. Max size: 2MB
                                                </small>

                                                @error('image')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label fw-semibold d-block">Preview</label>

                                                <div class="border rounded-3 bg-light position-relative overflow-hidden"
                                                    style="min-height: 250px; max-height: 350px;" id="previewContainer">
                                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 p-4"
                                                        id="emptyState" style="min-height: 250px;">
                                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                                        <p class="text-muted mt-2 mb-0">No image selected</p>
                                                        <small class="text-muted">Upload an image to see preview</small>
                                                    </div>

                                                    <div class="d-none w-100 h-100 position-relative" id="imagePreview">
                                                        <img src="" alt="Preview" id="previewImg"
                                                            class="img-fluid w-100 h-100"
                                                            style="object-fit: contain; max-height: 350px;">

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
                                </div>

                                <x-buttons.form-action primaryTitle="Create Pepsol Name" primaryId="createPepsolNameBtn"
                                    :cancel-route="route('leader.pepsol-names.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

                const allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
                const allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
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
                    emptyState.classList.remove('d-none');
                    imagePreview.classList.add('d-none');
                    imageDetails.classList.add('d-none');
                    previewImg.src = '';
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
                        swalError('Invalid file type. Please upload only JPG, PNG, GIF, or SVG.',
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
