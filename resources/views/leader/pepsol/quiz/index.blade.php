@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">
        <x-page-title title="Pepsol Quizzes" active="Pepsol Quizzes" />
        <x-white-card title="Pepsol Quizzes" :create-route="route('leader.pepsol-quiz.create')" :archive-route="null" :showFilters="true" :filterProps="[
            'searchPlaceholder' => 'Search quiz title...',
        
            'filter1Label' => 'Filter by Status',
            'filter1Name' => 'status',
            'filter1Value' => request('status'),
            'filter1Options' => \App\Http\Controllers\Leader\LPepsolQuizController::getStatusOptions(),
        
            'filter2Label' => 'Filter by Lesson',
            'filter2Name' => 'lesson',
            'filter2Value' => request('lesson'),
            'filter2Options' => $lessons->pluck('title', 'id')->toArray(),
        ]">

            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Quiz Title</th>
                                <th>Lesson</th>
                                <th>Questions</th>
                                <th>Passing Score</th>
                                <th>Time Limit</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($quizzes as $quiz)
                                <tr>
                                    <td>
                                        <div class="name">{{ $quiz->title }}</div>
                                        @if ($quiz->description)
                                            <div class="small text-muted">{{ Str::limit($quiz->description, 60) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($quiz->lesson)
                                            <span>{{ $quiz->lesson->title }}</span>
                                            @if ($quiz->lesson->pepsol)
                                                <div class="small text-muted">
                                                    {{ $quiz->lesson->pepsol->description ? Str::limit($quiz->lesson->pepsol->description, 40) : '' }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $quiz->questions->count() }} questions</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $quiz->passing_score }}%</span>
                                    </td>
                                    <td>
                                        @if ($quiz->time_limit)
                                            <span>{{ $quiz->time_limit }} min</span>
                                        @else
                                            <span class="text-muted">No limit</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($quiz->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('leader.pepsol-quiz.edit', $quiz->id)" />
                                        <x-icons.action-form :route="route('leader.pepsol-quiz.destroy', $quiz->id)" method="DELETE" name="force-delete"
                                            title="Delete" aClass="btn btn-sm btn-outline-danger border-0"
                                            icon="fas fa-trash" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Quizzes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $quizzes->appends(request()->query())->links() }}
                    <x-sweet-alert entity="Quizzes" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
