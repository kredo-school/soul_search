<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 hide-700">
    <img src="{{ asset('images/logo-s.svg')}}" class="show-700">
</a>
<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">
    <li class="my-3">
        <a href="#" class="nav-link active" aria-current="page">
            <i class="fa-solid fa-house"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home
        </a>
    </li>
    <li class="my-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Profile
        </a>
    </li>
    <li class="my-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-comment-dots"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Message
        </a>
    </li>
    <li class="my-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search
        </a>
    </li>

    {{-- orange icon, bold text, gray backcround @ contact page --}}
    @if ( request()->is('*contact*'))
        <li class="nav-item ms-3 bg-light">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-circle-question text-orange"></i>&nbsp;&nbsp;
                <span class="text-dark hide-700">
                    Contact Us</span>
            </a>
        </li>
    @else
        <li class="nav-item ms-3">
            <a href="#" class="flex-fill nav-link link-dark">
                <i class="fa-solid fa-circle-question"></i>&nbsp;&nbsp;
                <span class="text-dark hide-700">
                    Contact Us</span>
            </a>
        </li>
    @endif
</ul>

<a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>


<div class="dropdown login-icon">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock hide-700"></i>
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
