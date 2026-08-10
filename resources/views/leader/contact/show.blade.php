@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Contact Details" active="Contact Details" home="Contacts" :home-route="route('leader.contacts.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Contact Message Details" subTitle="View complete contact information" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <div class="mb-4">
                                <h5 class="mb-3 text-primary">
                                    <i class="fas fa-user me-2"></i>
                                    Sender Information
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Name</label>
                                        <p class="fw-bold">{{ $contact->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <p class="fw-bold">{{ $contact->email }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Status</label>
                                        <p>
                                            @if ($contact->replied_at)
                                                <span class="badge bg-success">Replied on
                                                    {{ $contact->replied_at->format('M d, Y h:i A') }}</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Submitted At</label>
                                        <p class="fw-bold">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3 text-primary">
                                    <i class="fas fa-envelope me-2"></i>
                                    Message
                                </h5>
                                <div class="p-4 bg-white border rounded"
                                    style="color: #000; background-color: #fff !important;">
                                    {{ $contact->message }}
                                </div>
                            </div>

                            @if ($contact->reply_message)
                                <div class="mb-4">
                                    <h5 class="mb-3 text-success">
                                        <i class="fas fa-reply me-2"></i>
                                        Reply
                                    </h5>
                                    <div class="p-4 bg-white border rounded border-start border-success border-4"
                                        style="color: #000; background-color: #fff !important;">
                                        {{ $contact->reply_message }}
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Replied by:
                                            {{ $contact->repliedBy->name ?? 'Unknown' }}</small>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4">
                                @if (!$contact->replied_at)
                                    <a href="{{ route('leader.contacts.reply', $contact->id) }}"
                                        class="btn btn-outline-success">
                                        <i class="fas fa-reply me-2"></i> Reply
                                    </a>
                                @endif
                                <a href="{{ route('leader.contacts.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
