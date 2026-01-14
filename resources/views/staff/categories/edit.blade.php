@extends('layouts.staff')

@section('content')
    <div class="containerr-fluid p-0">
        <x-page-title title="Edit Category " active="Edit Category" home="Category " :home-route="route('staff.categories.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Category's Information"
                        subTitle="Fill in the details to Update the Category information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('staff.categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-list me-2"></i>
                                        Edit Category Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                id="code" name="code" placeholder="Enter the Category code"
                                                value="{{ old('code', $category->code) }}" required>
                                            @error('code')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter the Category name"
                                                value="{{ old('name', $category->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold" for="type">
                                                Tyoe <span class="text-danger">*</span>
                                            </label>
                                            <select name="type" class="form-select @error('type') is-invalid @enderror"
                                                required>

                                                <option value="" selected disabled>Select Category </option>
                                                <option value="asset"
                                                    {{ old('type', $category->type) === 'asset' ? 'selected' : '' }}>
                                                    Asset </option>
                                                <option value="liability"
                                                    {{ old('type', $category->type) === 'liability' ? 'selected' : '' }}>
                                                    Liability </option>
                                                <option value="equity"
                                                    {{ old('type', $category->type) === 'equity' ? 'selected' : '' }}>
                                                    Equity
                                                </option>
                                                <option value="expenses"
                                                    {{ old('type', $category->type) == 'expenses' ? 'selected' : '' }}>
                                                    Expenses
                                                </option>

                                                <option value="funds"
                                                    {{ old('type', $category->type) === 'funds' ? 'selected' : '' }}>
                                                    Funds </option>
                                                <option value="receipts"
                                                    {{ old('type', $category->type) === 'receipts' ? 'selected' : '' }}>
                                                    Receipts </option>
                                            </select>

                                            </select>
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>



                                    </div>
                                </div>
                                <x-buttons.form-action primaryTitle="Update Category " primaryId="createCategoryBtn"
                                    :cancel-route="route('staff.categories.index')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
