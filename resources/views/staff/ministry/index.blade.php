@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Ministry" active="Ministry" />
        <x-white-card title="Ministry" :create-route="route('staff.ministries.create')" :archive-route="route('staff.ministries.archived')">

            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($ministries as $ministry)
                            <tr>
                                <td class="name">{{ $ministry->name }} </td>

                                <td class="text-center">
                                    <x-icons.action-edit :route="route('staff.ministries.edit', $ministry->id)" />
                                    <x-icons.action-form :route="route('staff.ministries.archive', $ministry->id)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1" class="text-center">No ministry found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $ministries->links() }}
                <x-sweet-alert entity="Ministry" />
            </div>
        </x-white-card>
    </div>
@endsection
