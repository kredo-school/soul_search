<div class="container p-0">
    <div class="row">
        <!-- Username and Date -->
        <div class="col pt-0 ps-2">
            <a href="#" class="text-decoration-none text-dark fw-bold">Username</a>
            &nbsp;&nbsp;<span class="text-muted fw-light small tag-name">3/8/2023 21:09</span>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-auto text-end">
            <i class="fa-regular fa-heart"></i>
            <span>5</span>
        </div>
        <!-- A Ellipsis button for Report Chat -->
        <div class="col-auto text-end me-5">
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
    <!-- Message -->
    <p class="text-dark fw-light ms-2 w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, placeat porro! Quas ipsa, nihil veniam nisi vero voluptatum itaque eos, assumenda sunt exercitationem ipsum! Consectetur quod at eos voluptatum quidem!</p>
        {{-- <img src="#" alt=""> --}}
</div>
