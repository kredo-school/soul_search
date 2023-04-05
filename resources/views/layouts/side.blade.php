<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 hide-800">
    <img src="{{ asset('images/logo-s.svg')}}" class="show-800">
</a>
<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ home page --}}
    @if ( !request()->is('*profile*') && !request()->is('*message*') && !request()->is('*search*') && !request()->is('*contact*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-house text-orange"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Home</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="#" class="flex-fill nav-link link-dark" title="Home">
                <i class="fa-solid fa-house"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Home</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ profile page --}}
    @if ( request()->is('*profile*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-user text-orange"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;My Profile</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="#" class="flex-fill nav-link link-dark" title="My Profile">
                <i class="fa-solid fa-user"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;My Profile</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ message page --}}
    @if ( request()->is('*message*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-comment-dots text-orange"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Message</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="#" class="flex-fill nav-link link-dark" title="Message">
                <i class="fa-solid fa-comment-dots"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Message</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ search page --}}
    @if ( request()->is('*search*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-magnifying-glass text-orange"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Search</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="#" class="flex-fill nav-link link-dark" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Search</span>
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ contact page --}}
    @if ( request()->is('*contact*'))
        <li class="nav-item py-2 sidebar-selected fw-bold">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-circle-question text-orange"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Contact Us</span>
            </a>
        </li>
    @else
        <li class="nav-item py-2">
            <a href="#" class="flex-fill nav-link link-dark" title="Contact Us">
                <i class="fa-solid fa-circle-question"></i>
                <span class="text-dark hide-800">
                    &nbsp;&nbsp;Contact Us</span>
            </a>
        </li>
    @endif
</ul>

<div class="dropdown login-icon">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock hide-800"></i>
    </button>
    <ul class="dropdown-menu">

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
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

            <a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
        @endguest

    </ul>
</div>
