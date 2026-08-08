@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Quiz Results" active="Quiz Results" />
        <x-white-card title="Quiz Results" :create-route="null" :archive-route="null" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search user name, quiz title...',
        
            'filter1Label' => 'Filter by Status',
            'filter1Name' => 'status',
            'filter1Value' => request('status'),
            'filter1Options' => $statusOptions,
        
            'filter2Label' => 'Filter by Passed',
            'filter2Name' => 'passed',
            'filter2Value' => request('passed'),
            'filter2Options' => [
                '1' => 'Passed',
                '0' => 'Failed',
            ],
        ]">

            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Quiz</th>
                                <th class="text-center">Attempt #</th>
                                <th class="text-center">Score</th>
                                <th class="text-center">Total Points</th>
                                <th class="text-center">Percentage</th>
                                <th class="text-center">Passed</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($attempts as $attempt)
                                <tr>
                                    <td>
                                        <div class="name">{{ $attempt->user->name ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div class="name">{{ $attempt->quiz->title ?? 'N/A' }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $attempt->attempt_number }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($attempt->score !== null)
                                            <strong>{{ $attempt->score }}</strong>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($attempt->total_points !== null)
                                            <strong>{{ $attempt->total_points }}</strong>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($attempt->percentage !== null)
                                            @php
                                                $badgeClass = 'bg-danger';
                                                if ($attempt->percentage >= 90) {
                                                    $badgeClass = 'bg-success';
                                                } elseif ($attempt->percentage >= 70) {
                                                    $badgeClass = 'bg-warning text-dark';
                                                } elseif ($attempt->percentage >= 50) {
                                                    $badgeClass = 'bg-orange';
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ $attempt->percentage }}%
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($attempt->passed)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle"></i> Passed
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle"></i> Failed
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <a href="{{ route('leader.pepsol.quiz-results.show', $attempt->id) }}"
                                            class="btn btn-sm btn-outline-info border-0" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <x-icons.action-form :route="route('leader.pepsol.quiz-results.destroy', $attempt->id)" method="DELETE" name="force-delete"
                                            title="Delete" aClass="btn btn-sm btn-outline-danger border-0"
                                            icon="fas fa-trash" />
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No quiz attempts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $attempts->appends(request()->query())->links() }}
                    <x-sweet-alert entity="Quiz Attempts" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
