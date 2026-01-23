@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Create New Expenses" active="Create New Expenses" home="Expenses" :home-route="route('staff.expenses.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">

                    <x-white-card-header title="Expense's Information"
                        subTitle="Fill in the details to fill the Expenses information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">

                            <form action="{{ route('staff.expenses.store') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-solid fa-money-bill me-2"></i>Expenses's Information
                                    </h5>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="Enter expense name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="description">
                                                Description
                                            </label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                id="description" name="description" value="{{ old('description') }}"
                                                placeholder="Enter expense description" required>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="amount">
                                                Amount <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                                id="amount" name="amount" value="{{ old('amount') }}"
                                                placeholder="Enter expenses amount" required step="1" min="0"
                                                inputmode="numeric">
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="category_id">
                                                Category <span class="text-danger">*</span>
                                            </label>
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror" required>
                                                <option value="" disabled selected>-- Select Category --</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->code }} - {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="date">
                                                Date <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                                id="date" name="date" value="{{ old('date') }}" required>

                                            @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="paid">
                                                Paid Through <span class="text-danger">*</span>
                                            </label>
                                            <select name="paid" id="paid"
                                                class="form-select @error('paid') is-invalid @enderror" required>
                                                <option value="" disabled selected>-- Paid by --</option>
                                                <option value="online" {{ old('paid') == 'online' ? 'selected' : '' }}>
                                                    Online </option>
                                                <option value="cash" {{ old('paid') == 'cash' ? 'selected' : '' }}> Cash
                                                </option>
                                            </select>

                                            @error('paid')
                                                <div class="invalid-feedback">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                        </div>

                        <x-buttons.form-action primaryTitle="Create Expenses" primaryId="createExpenseBtn"
                            :cancel-route="route('staff.expenses.index')" />

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
