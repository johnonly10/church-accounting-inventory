@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Pepsols" active="Pepsols" />
        <x-white-card title="Pepsols" :create-route="route('leader.pepsol.create')" :archive-route="null" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search title, subtitle...',
        
            'filter1Label' => 'Filter by Status',
            'filter1Name' => 'status',
            'filter1Value' => request('status'),
            'filter1Options' => \App\Models\Pepsol::getStatusOptions(),
        
            'filter2Label' => 'Filter by Category',
            'filter2Name' => 'category',
            'filter2Value' => request('category'),
            'filter2Options' => $categories->pluck('name', 'id')->toArray(),
        ]">

            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>Category</th>
                                <th>Lesson Title</th>
                                <th>Summary</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pepsols as $i => $pepsol)
                                @php $first = $pepsol->lessons->first(); @endphp
                                <tr>

                                    <td>
                                        @if ($pepsol->category)
                                            <span class="badge bg-secondary">{{ $pepsol->category->name }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($first)
                                            <div class="fw-semibold">{{ $first->title }}</div>
                                            @if ($first->subtitle)
                                                <div class="small text-muted">{{ $first->subtitle }}</div>
                                            @endif
                                            @if ($pepsol->lessons->count() > 1)
                                                <div class="small text-muted mt-1">
                                                    +{{ $pepsol->lessons->count() - 1 }} more lesson(s)
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-muted fst-italic">No lessons</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($first && $first->summary)
                                            <div class="text-secondary">{{ Str::limit($first->summary, 100) }}</div>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($pepsol->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        <x-icons.action-edit :route="route('leader.pepsol.edit', $pepsol->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol.destroy', $pepsol->id)" method="DELETE" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Pepsols found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $pepsols->appends(request()->query())->links() }}
                    <x-sweet-alert entity="Pepsols" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
