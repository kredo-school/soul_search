<div class="w-100 d-flex justify-content-center">
    <img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" class="post-image align-middle">
    <a href="{{ route('profiles.show', $post->user->id) }}" class="post-exit display-6 ms-2"><i class="fa-solid fa-xmark"></i></a>
</div>
