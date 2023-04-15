@extends('layouts.app')

@section('title', 'Admin: Users')

@section('styles')
<link href="{{ mix('css/admin_posts.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="ss-container p-0">
    <div class="row" style="height: 100%">
        <div class="col-2 p-0 bg-white">
        {{-- side bar --}}
            <div class="ss-sidebar">
                @include('admin.admin_posts_side')
            </div>
        </div>

        <div class="col-9 p-0" style="height: 100%">
            <div class="ss-main" style="height: 100%">
                <div class="container-fluid p-0" style="height: 100%">
                    <div class="row ps-5 mt-5">
                        @auth
                        <h1 class="mb-3 p-0 mt-5 text-heigt d-flex align-items-end">Users</h1>

                            <form action="{{ route('admin.users') }}">
                            </form>

                        @endauth
                        <table class="table table-hover bg-white border cell-padding text-heigt">
                            <thead class="small bg-orange">
                                <tr>
                                    <th></th>
                                    <th class="ps-5">Username</th>
                                    <th class="cell-padding">Email</th>
                                    <th class="cell-padding">Created at</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_users as $user)
                                    <tr>
                                        <td>
                                            @if ($user->avatar)
                                                <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="rounded-circle d-block mx-auto avatar-md">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-md"></i>
                                            @endif
                                        </td>
                                        <td class="ps-5">
                                            <a href="#" class="text-decoration-none text-dark">{{ $user->username }}</a>
                                        </td>
                                        <td class="cell-padding">
                                            {{ $user->email }}
                                        </td>
                                        <td class="cell-padding">
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
                                                @include('admin.posts.modal.status')
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
</div>
@endsection
