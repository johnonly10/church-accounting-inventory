@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Sliders" active="Sliders" />

        <x-white-card title="Sliders" :create-route="route('leader.sliders.create')" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search by title or subtitle...',
        ]">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 140px;">Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Button</th>
                                <th>Link</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>


                                        <img src="{{ asset($slider->images) }}" alt="{{ $slider->title }}"
                                            class="img-fluid rounded" style="max-height: 70px; object-fit: contain;"
                                            onerror="this.style.display='none';">
                                    </td>

                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->subtitle }}</td>
                                    <td>{{ $slider->button }}</td>
                                    <td><small>{{ $slider->link }}</small></td>

                                    <td class="text-center">
                                        @if ($slider->is_active)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('leader.sliders.edit', $slider->id)" />

                                        <x-icons.action-form :route="route('leader.sliders.destroy', $slider->id)" method="DELETE" title="Delete"
                                            aClass="btn btn-sm btn-outline-danger border-0" icon="fas fa-trash" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No sliders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $sliders->links() }}

                    <x-sweet-alert entity="Sliders" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
