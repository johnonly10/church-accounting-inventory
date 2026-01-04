@extends('layouts.staff')

@section('content')
    <div class="container-fluid p-0">

        <x-page-title title="Users" active="Users" />

        <x-white-card title='Users' :create-route="route('staff.users.create')">
            <div class="table-responsive m-b-30">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mininstry</th>
                            <th>Leader</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="name">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->ministry->name }}</td>
                                <td>{{ $user->leader->name }}</td>
                                <td class="text-center">
                                    <x-icons.action-edit :route="route('staff.users.edit', $user)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-white-card>

        <x-sweet-alert entity="User" />
    </div>
@endsection
