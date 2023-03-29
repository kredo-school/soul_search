@extends('layouts.app')

@section('title', 'Admin: Users')

@section('styles')
<link href="{{ mix('css/admin_users.css') }}" rel="stylesheet">
@endsection

@section('content')
    @auth
        <div class="mb-2 ml-auto d-flex justify-content-end mt-5">

            <form action="{{ route('users') }}" style="width:300px">

            </form>
        </div>
    @endauth
    <h1 class="ms-5 mb-2">Users</h1>
    <div class="contaoiner display-user ms-5">
        <div class="colmd-8">
    <table class="table table-hover align-middle bg-white border cell-padding">
        <thead class="small bg-orange">
            <tr>
                <th></th>
                <th class="ps-5">Username</th>
                <th class="cell-tiny">Email</th>
                <th class="cell-padding">Created at</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{--  @foreach ($all_users as $user)  --}}
                <tr>
                    <td>
                        {{--  @if ($user->avatar)  --}}
                            <img src="{{ asset('images/cat.png')}}" alt="#" class="rounded-circle d-block mx-auto avatar-md">
                        {{--  @else  --}}
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-md"></i>
                        {{--  @endif  --}}
                    </td>
                    <td class="ps-5">
                        <a href="#" class="text-decoration-none text-dark">Ben</a>
                    </td>
                    <td class="cell-tiny">
                        ben@mail.com
                    </td>
                    <td class="cell-padding">
                        2023-3-28 22:00
                    </td>
                    <td>
                        {{--  @if ($user->trashed())  --}}
                             <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        {{--  @else  --}}
                             <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                        {{--  @endif  --}}

                    </td>
                    <td>
                        {{--  @if (Auth::user()->id !== $user->id)  --}}
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                {{--  @if ($user->trashed())  --}}
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#">
                                        <i class="fa-solid fa-user-check"></i> Activate
                                    </button>
                                </div>
                                {{--  @else  --}}
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#">
                                        <i class="fa-solid fa-user-slash"></i> Deactivate
                                    </button>
                                </div>
                                {{--  @endif  --}}

                            </div>
                            @include('admin.users.modal.status')
                            {{--  @endif  --}}
                        </td>
                     </tr>
                 {{--  @endforeach  --}}
            </tbody>
        </table>
        </div>
    </div>
    {{--  {{ $all_users->appends(request()->query())->links() }}  --}}
@endsection
