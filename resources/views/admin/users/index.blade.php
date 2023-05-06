@extends('layouts.app')

@section('title', 'Admin: Users')

@section('styles')
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="ss-container">
    <div class="row">
        {{-- side bar --}}
        <div class="ss-sidebar p-0 m-0">
            <div class="sidebar-fix m-0 p-0">
                @include('admin.admin_side')
            </div>
        </div>

        <div class="col p-0">
            <div class="ss-main">
                <div class="mx-4 admin-container">
                    <h2 class="mb-3 p-0 mt-4">Users</h2>

                    <table class="table table-hover bg-white border">
                        <thead class="small bg-orange">
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('profiles.show', $user->id) }}" class="text-decoration-none">
                                            @if ($user->avatar)
                                                <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->avatar }}" class="rounded-circle d-block mx-auto avatar-md">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-md"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td class="">
                                        {{ $user->username }}
                                    </td>
                                    <td class="">
                                        {{ $user->email }}
                                    </td>
                                    <td class="">
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        @if ($user->trashed())
                                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                                        @else
                                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                                        @endif

                                    </td>
                                    <td>
                                        @if (Auth::user()->id !== $user->id)
                                            <div class="dropdown">
                                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </button>
                                                @if ($user->trashed())
                                                    <div class="dropdown-menu">
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                                            <i class="fa-solid fa-user-check"></i> Activate {{ $user->username }}
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="dropdown-menu">
                                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->username }}
                                                        </button>
                                                    </div>
                                                @endif

                                            </div>
                                            @include('admin.users.modal.status')
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-0">
                        {{ $all_users->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
