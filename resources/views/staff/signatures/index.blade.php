@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Signatures" active="Signatures" />
        <x-white-card title="Signatures" :create-route="route('staff.signatures.create')" :showFilters="true" :filterProps="[
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
                                        <x-icons.action-edit :route="route('staff.signatures.edit', $signature->id)" />
                                        {{-- <x-icons.action-form :route="route('staff.Signatures.archive', $signature->id)" /> --}}
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
