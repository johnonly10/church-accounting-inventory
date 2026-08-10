@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Reply to Contact" active="Reply to Contact" home="Contacts" :home-route="route('leader.contacts.index')" />

        <div class="row">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <x-white-card-header title="Reply to Contact Message" subTitle="Send a reply to the contact's inquiry" />

                    <div class="white_card_body">
                        <div class="card-body pt-4">
                            <form action="{{ route('leader.contacts.send-reply', $contact->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-envelope me-2"></i>
                                        Original Message
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
                                            <label class="form-label fw-semibold">Message</label>
                                            <div class="p-3 bg-white border rounded"
                                                style="color: #000; background-color: #fff !important;">
                                                {{ $contact->message }}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Submitted At</label>
                                            <p class="fw-bold">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3 text-success">
                                        <i class="fas fa-reply me-2"></i>
                                        Your Reply
                                    </h5>

                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" for="reply_message">
                                            Reply Message <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('reply_message') is-invalid @enderror" id="reply_message" name="reply_message"
                                            rows="6" placeholder="Type your reply here..." required>{{ old('reply_message') }}</textarea>
                                        @error('reply_message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-outline-success" id="sendReplyBtn">
                                        <i class="fas fa-paper-plane me-2"></i> Send Reply
                                    </button>
                                    <a href="{{ route('leader.contacts.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
