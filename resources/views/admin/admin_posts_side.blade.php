<a href="{{ route('index') }}" class="text-decoration-none ms-2">
    <img src="{{ asset('images/logo.svg')}}" class="m-3 ms-2 hide-700">
</a>

<ul class="nav nav-pills flex-column ms-0 mb-auto mt-4">
    <li class="my-1">
        <a href="#" class="flex-fill nav-link link-dark" aria-current="page">
            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users
        </a>
    </li>
    <li class="nav-item py-2 sidebar-selected fw-bold">
        <a href="#" class="nav-link link-dark">
            <i class="fa-regular fa-file text-orange"></i>
                <span class="text-dark hide-800">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posts
        </a>
    </li>
</ul>

<div class="dropdown login-icon">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-unlock hide-700"></i>
    </button>
    <ul class="dropdown-menu">
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
    </ul>
</div>
