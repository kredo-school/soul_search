<div class="w-100 d-flex align-items-center justify-content-center post-image-container">
    <div class="post-image">
        <img src="/images/posts/{{ $post->image }}" alt="Post Image" class="align-middle">
        <span class="post-exit-outline display-6 ms-2 fw-bold"><i class="fa-solid fa-xmark"></i></span>
        <a href="{{ route('profiles.show', $post->user->id) }}" class="post-exit display-6 ms-2"><i class="fa-solid fa-xmark"></i></a>
    </div>
</div>

