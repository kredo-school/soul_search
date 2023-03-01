<a href="#" class="text-decoration-none ms-3">
    <img src="{{ asset('img/logo.png')}}" class="my-3">
</a>
<ul class="ms-0 mb-auto mt-4">
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
    <li class="my-3">
        <a href="#" class="nav-link link-dark">
            <i class="fa-solid fa-circle-question"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us
        </a>
    </li>
</ul>
@guest
@if (Route::has('login'))
    <li class="dropdown-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
@endguest
<div class="dropdown login-icon">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock"></i>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">

    </ul>
</div>
