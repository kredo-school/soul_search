<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('img/logo.svg')}}" class="m-3 hide-700">
    <img src="{{ asset('img/logo-s.svg')}}" class="show-700">
</a>
<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ home page --}}
    <li class="nav-item ms-3 px-0">
        <a href="#" class="flex-fill nav-link active fw-bold" aria-current="page" style="background-color: #F4F7FC;">
            <i class="fa-solid fa-house text-orange"></i>&nbsp;&nbsp;
            <span class="text-dark hide-700">Home</span>
        </a>
    </li>
    <li class="nav-item ms-3">
        <a href="#" class="flex-fill nav-link link-dark">
            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;
            <span class="text-dark hide-700">My Profile</span>
        </a>
    </li>
    <li class="nav-item ms-3">
        <a href="#" class="flex-fill nav-link link-dark">
            <i class="fa-solid fa-comment-dots"></i>&nbsp;&nbsp;
            <span class="text-dark hide-700">Message</span>
        </a>
    </li>
    <li class="nav-item ms-3">
        <a href="#" class="flex-fill nav-link link-dark">
            <i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;
            <span class="text-dark hide-700">Search</span>
        </a>
    </li>

    <li class="nav-item ms-3">
        <a href="#" class="flex-fill nav-link link-dark">
            <i class="fa-solid fa-circle-question"></i>&nbsp;&nbsp;
            <span class="text-dark hide-700">
                Contact Us</span>
        </a>
    </li>
</ul>


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
                <li>
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li class="ps-3">
            @endif
        @else
        <li class="ps-3">
            <a class="nav-link dropdown-toggle" href="#" role="button"
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
