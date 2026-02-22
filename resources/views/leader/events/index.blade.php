@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Events" active="Events" />
        <x-white-card title="Events" :create-route="route('leader.events.create')">
            <div id="ajax-results-container">
                <div class="table-responsive m-b-30">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td>{{ $event->name }}</td>

                                    <td>{{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->ends_at)->format('d M Y, h:i A') }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td class="text-center">
                                        <x-icons.action-edit :route="route('leader.events.edit', $event->id)" />
                                        {{-- <x-icons.action-form :route="route('leader.events.archive', $event->id)" /> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Events found.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $events->links() }}
                    <x-sweet-alert entity="Event" />
                </div>
            </div>
        </x-white-card>
    </div>
@endsection
