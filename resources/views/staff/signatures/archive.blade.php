@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Signatures" active="Signatures" />
        <x-white-card title="Back to Index Page" :home-route="route('staff.signatures.index')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or label...',
        ]">

            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Label</th>
                                <th>Position</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($signatures as $signature)
                                <tr>
                                    <td class="name">{{ $signature->name }} </td>
                                    <td>{{ $signature->label }} </td>
                                    <td>{{ $signature->position->name }}</td>
                                    <td class="text-center">
                                        @if ($signature->is_active)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <x-icons.action-form :route="route('staff.signatures.restore', $signature->id)"
                                            aClass="btn btn-sm btn-outline-success border-0" title="Restore"
                                            icon="fas fa-undo" name="restore" />
                                        <x-icons.action-form :route="route('staff.signatures.forceDelete', $signature->id)" icon="fas fa-trash" title="Delete"
                                            method="DELETE" aClass="btn btn-sm btn-outline-danger border-0"
                                            name="force-delete" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Signatures found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $signatures->links() }}
                    <x-sweet-alert entity="Signatures" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
