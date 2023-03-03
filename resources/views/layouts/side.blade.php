<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('img/logo.svg')}}" class="my-3 hide-700">
    <img src="{{ asset('img/logo-s.svg')}}" class="show-700">
</a>
<ul class="ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ home page --}}
    @if ( request()->is('*home*'))
        <li class="py-2 ps-3 bg-light">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-house text-orange"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold">Home</span></span>
            </a>
        </li>
    @else
        <li class="py-2 ps-3">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-house"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home</span>
            </a>
        </li>
    @endif

    <li class="py-2 ps-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-user"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Profile</span>
        </a>
    </li>
    <li class="py-2 ps-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-comment-dots"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Message</span>
        </a>
    </li>
    <li class="py-2 ps-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-magnifying-glass"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search</span>
        </a>
    </li>

    {{-- orange icon, bold text, gray backcround @ contact page --}}
    @if ( request()->is('*contact*'))
        <li class="py-2 ps-3 bg-light">
            <a href="#" class="nav-link link-dark">
                <i class="fa-solid fa-circle-question text-orange"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold">Contact Us</span></span>
            </a>
        </li>
    @else
        <li class="py-2 ps-3">
            <a href="#" class="nav-link link-dark">
                <i class="fa-solid fa-circle-question"></i><span class="hide-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us</span>
            </a>
        </li>
    @endif
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
