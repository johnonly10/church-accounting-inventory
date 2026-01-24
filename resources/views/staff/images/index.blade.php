@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Images" active="Images" />

        <x-white-card title="Images" :create-route="route('staff.images.create')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by image name...',
        
            'filter1Label' => 'Filter by Type',
            'filter1Name' => 'type',
            'filter1Value' => request('type'),
            'filter1Options' => \App\Models\Image::getTypeOptions(),
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Path</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($images as $image)
                                <tr>
                                    <td style="width: 120px;">
                                        @php
                                            $src = str_starts_with($image->path, 'Images/')
                                                ? asset($image->path)
                                                : asset('Images/' . ltrim($image->path, '/'));
                                        @endphp

                                        <img src="{{ $src }}" alt="{{ $image->name }}" class="img-fluid rounded"
                                            style="max-height: 70px; object-fit: contain;"
                                            onerror="this.style.display='none';">
                                    </td>

                                    <td class="text-capitalize">{{ str_replace('_', ' ', $image->type) }}</td>
                                    <td class="name">{{ $image->name }}</td>

                                    <td>
                                        <small>{{ $image->path }}</small>
                                    </td>

                                    <td class="text-center">
                                        @if ($image->is_active)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('staff.images.edit', $image->id)" />
                                        <x-icons.action-form :route="route('staff.images.destroy', $image->id)" method="DELETE" name="force-delete"
                                            title="Delete" aClass="btn btn-sm btn-outline-danger border-0"
                                            icon="fas fa-trash" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Images found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $images->links() }}
                    <x-sweet-alert entity="Images" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
