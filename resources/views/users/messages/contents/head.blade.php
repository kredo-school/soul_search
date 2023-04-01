
<div class="bg-white mb-3 py-1 border border-top-0">
    <div class="row">
        <div class="col-auto">
            <a href="#" class="ps-1 text-decoration-none fw-bold text-dark tag-header">
                @if ($user->avatar)
                    <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-sm rounded-circle" alt="">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
            </a>
        </div>
        <div class="col">
            <div>
                {{ $user->username }}
            </div>
            <div>
                @if ($user->is_active)
                    online
                @else
                    offline
                @endif
            </div>

        </div>
        <div class="col-auto">
            <button class="btn float-end shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a href="" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportUserModal">
                        <i class="fa-solid fa-exclamation"></i> Report
                    </a>
                </li>
            </ul>
            @include('users.messages.modal.report')

        </div>
    </div>
</div>
