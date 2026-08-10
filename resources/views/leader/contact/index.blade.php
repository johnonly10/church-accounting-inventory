@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Contacts" active="Contacts" />
        <x-white-card title="Contact Messages" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or email...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td class="name">{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                            title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 50) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($contact->replied_at)
                                            <span class="badge bg-success">Replied</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('leader.contacts.show', $contact->id) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if (!$contact->replied_at)
                                            <a href="{{ route('leader.contacts.reply', $contact->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                        @endif
                                        {{-- <form action="{{ route('leader.contacts.destroy', $contact->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this contact?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No contact messages found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $contacts->links() }}
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
