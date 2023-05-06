<a href="#" class="text-decoration-none ms-2">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 ms-2 d-none d-lg-inline">
    <img src="{{ asset('images/logo-s.svg')}}" class="mt-3 d-inline d-lg-none">
</a>
<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ admin_users page --}}
    @if ( request()->is('*admin/users*') )
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('admin.users') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-user text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Users</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('admin.users') }}" class="text-muted flex-fill nav-link link-dark">
                <i class="fa-solid fa-user"></i>
                <span class="ms-2 d-none d-lg-inline">Users</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ admin_users page --}}
    @if ( request()->is('*admin/posts*') )
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('admin.posts') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-file text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Posts</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('admin.posts') }}" class="text-muted flex-fill nav-link link-dark">
                <i class="fa-solid fa-file"></i>
                <span class="ms-2 d-none d-lg-inline">Posts</span>
            </a>
        </li>
    @endif
</ul>

<div class="dropdown login-icon">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock d-none d-lg-inline"></i>
    </button>
    <ul class="dropdown-menu">

        <!-- Admin Controls -->
        @can('admin')
            <a href="{{ route('index') }}" class="dropdown-item">
                <i class="fa-solid fa-house"></i> Home
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
