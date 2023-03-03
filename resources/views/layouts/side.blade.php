<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('img/logo.png')}}" class="my-3">
</a>
<ul class="ms-0 mb-auto mt-4">

    {{-- orange icon, bold text, gray backcround @ home page --}}
    @if ( request()->is('*home*'))
        <li class="py-2 ps-3 bg-light">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-house text-orange"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold">Home</span>
            </a>
        </li>
    @else
        <li class="py-2 ps-3">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-house"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home
            </a>
        </li>
    @endif

    {{-- orange icon, bold text, gray backcround @ profile page --}}
    @if ( request()->is('*profile*'))
        <li class="py-2 ps-3 bg-light">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-user text-orange"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold">My Profile</span>
            </a>
        </li>
    @else
        <li class="py-2 ps-3">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Profile
            </a>
        </li>
    @endif

    <li class="py-2 ps-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-comment-dots"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Message
        </a>
    </li>
    <li class="py-2 ps-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search
        </a>
    </li>

    {{-- orange icon, bold text, gray backcround @ contact page --}}
    @if ( request()->is('*contact*'))
        <li class="py-2 ps-3 bg-light">
            <a href="#" class="nav-link link-dark">
                <i class="fa-solid fa-circle-question text-orange"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fw-bold">Contact Us</span>
            </a>
        </li>
    @else
        <li class="py-2 ps-3">
            <a href="{{ route('contact.index') }}" class="nav-link link-dark">
                <i class="fa-solid fa-circle-question"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us
            </a>
        </li>
    @endif
</ul>


<div class="dropdown login-icon">
    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock"></i>
    </button>
    <ul class="dropdown-menu">

        @guest
            @if (Route::has('login'))
                <li>
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li>
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
        <li>
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
