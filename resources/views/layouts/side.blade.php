<a href="#" class="text-decoration-none ms-2">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 ms-2 d-none d-lg-inline">
    <img src="{{ asset('images/logo-s.svg')}}" class="mt-3 d-inline d-lg-none">
</a>
<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ home page --}}
    @if ( !request()->is('*profile*') && !request()->is('*message*') && !request()->is('*search*') && !request()->is('*contact*') && !request()->is('*passwords*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('index') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-house text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Home</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('index') }}" class="text-muted flex-fill nav-link link-dark" title="Home">
                <i class="fa-solid fa-house"></i>
                <span class="ms-2 d-none d-lg-inline">Home</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ profile page --}}
    @if ( request()->is('*profile*') || request()->is('*passwords*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('profiles.index') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-user text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">My Profile</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('profiles.index') }}" class="text-muted flex-fill nav-link link-dark" title="My Profile">
                <i class="fa-solid fa-user"></i>
                <span class="ms-2 d-none d-lg-inline">My Profile</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ message page --}}
    @if ( request()->is('*message*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('messages.show', ['user' => Auth::id()]) }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-comment-dots text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Message</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('messages.show', ['user' => Auth::id()]) }}" class="text-muted flex-fill nav-link link-dark" title="Message">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="ms-2 d-none d-lg-inline">Message</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ search page --}}
    @if ( request()->is('*search*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('search.index') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-magnifying-glass text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Search</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('search.index') }}" class="text-muted flex-fill nav-link link-dark" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="ms-2 d-none d-lg-inline">Search</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ contact page --}}
    @if ( request()->is('*contact*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="{{ route('contact.index') }}" class="text-dark flex-fill nav-link link-dark">
                <i class="fa-solid fa-circle-question text-orange"></i>
                <span class="ms-2 d-none d-lg-inline">Contact Us</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="{{ route('contact.index') }}" class="text-muted flex-fill nav-link link-dark" title="Contact Us">
                <i class="fa-solid fa-circle-question"></i>
                <span class="ms-2 d-none d-lg-inline">Contact Us</span>
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
            <a href="{{ route('admin.users') }}" class="dropdown-item">
                <i class="fa-solid fa-user-gear"></i> Admin
            </a>
            <hr class="dropdown-divider">
        @endcan

        @guest
            @if (Route::has('login'))
                <li class="ps-3">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

@if (Route::has('register'))
    <li class="dropdown-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
@endif
@else
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
