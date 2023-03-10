<div class="container">
    <div class="row align-items-center">
        <!-- Username -->
        <div class="col ps-0">
            <a href="#" class="text-decoration-none text-dark fw-bold">Username</a>
        </div>
        <!-- Date -->
        <div class="col">
            <p class="text-muted fw-light">8/3/2023</p>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-auto text-end">
            <i class="fa-regular fa-heart"></i>
            <span>5</span>
        </div>
        <!-- A Ellipsis button for Report Chat -->
        <div class="col-auto text-end">
            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            {{-- <div class="dropdown-menu">
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#report-chat-{{ $chat-id }}">
                    Report Chat
                </button>
            </div> --}}
            {{-- @include(for Report) --}}
        </div>
    </div>

    <div class="row align-items-center">
        <p class="d-inline fw-light">Show chats</p>
            {{-- <img src="#" alt=""> --}}
    </div>
</div>
