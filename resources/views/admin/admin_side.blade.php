<a href="{{ route('index') }}" class="text-decoration-none ms-2">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 ms-2 hide-700">
</a>

<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">
    <li class="nav-item py-2 sidebar-selected fw-bold">
        <a href="{{ route('admin.users') }}" class="flex-fill nav-link link-dark" aria-current="page">
            <i class="fa-solid fa-user text-orange"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users
        </a>
    </li>
    <li class="my-1">
        <a href="#" class="nav-link link-dark">
            <i class="fa-regular fa-file"></i>
                <span class="text-dark hide-800">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posts
        </a>
    </li>
</ul>

<div class="dropdown login-icon">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock d-none d-lg-inline"></i>
    </button>
    <ul class="dropdown-menu">

        <!-- Admin Controls -->
        @can('admin')
            <a href="{{ route('admin.users') }}" class="dropdown-item">
                <i class="fa-solid fa-user-gear"></i> Admin
            </a>
            <hr class="dropdown-divider">
        @endcan

        <li class="dropdown-item dropdown">
            <div class="fw-bold">
                {{ Auth::user()->username }}
            </div>

            <a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
