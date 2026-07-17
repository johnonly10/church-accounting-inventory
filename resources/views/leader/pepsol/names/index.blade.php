@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Pepsol Name" active="Pepsol Name" />
        <x-white-card title="Pepsol Name" :create-route="route('leader.pepsol-names.create')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by name or code...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pepsolNames as $pepsolName)
                                <tr>
                                    <td class="text-center align-middle">
                                        <img src="{{ asset('Images/Pepsol/Name/' . $pepsolName->image) }}"
                                            alt="{{ $pepsolName->name }}" class="img-thumbnail preview-image"
                                            style="width: 50px; height: 50px; object-fit: cover;"
                                            onerror="this.src='{{ asset('images/no-image.png') }}'">
                                    </td>
                                    <td class="name">{{ $pepsolName->name }}</td>
                                    <td>{{ $pepsolName->code }}</td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('leader.pepsol-names.edit', $pepsolName->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol-names.destroy', $pepsolName->id)" method="DELETE" name="force-delete"
                                            title="Delete" aClass="btn btn-sm btn-outline-danger border-0"
                                            icon="fas fa-trash" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Pepsol Name found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pepsolNames->links() }}
                    <x-sweet-alert entity="Pepsol Name" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection

@push('styles')
    <style>
        .preview-image {
            border-radius: 4px;
            padding: 2px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .preview-image:hover {
            transform: scale(3);
            position: relative;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush
