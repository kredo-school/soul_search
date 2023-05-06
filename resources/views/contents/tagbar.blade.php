@auth
<!-- Tags' bar -->
<div class="col-2 bg-white tag-bar border-start border-end">
    <div class="mt-3">
        <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Recent</p>
        <ul class="nav nav-pills flex-column px-0">
            @foreach ($recent_tags as $recent_tag)
                @if($recent_tag->tag->id == $tag->id)
                    <li class="nav-item tag-item tag-selected">
                @else
                    <li class="nav-item tag-item">
                @endif
                    <a href="{{ route('chats.show', $recent_tag->tag->id) }}" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag hashtag-icon d-none d-lg-inline">&nbsp;</i><span class="d-inline d-lg-none">#</span><span class="text-dark tag-name">{{ $recent_tag->tag->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-2">
        <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Main</p>
        <ul class="nav nav-pills flex-column px-0">
            @foreach ($main_tags as $main_tag)
            @if($main_tag->tag->id == $tag->id)
                <li class="nav-item tag-item tag-selected">
            @else
                <li class="nav-item tag-item">
            @endif
                    <a href="{{ route('chats.show', $main_tag->tag->id) }}" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag hashtag-icon d-none d-lg-inline">&nbsp;</i><span class="d-inline d-lg-none">#</span><span class="text-dark tag-name">{{ $main_tag->tag->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-2">
        <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Favorite</p>
        <ul class="nav nav-pills flex-column px-0">
            @foreach ($fav_tags as $fav_tag)
            @if($fav_tag->tag->id == $tag->id)
                <li class="nav-item tag-item tag-selected">
            @else
                <li class="nav-item tag-item">
            @endif
                    <a href="{{ route('chats.show', $fav_tag->tag->id) }}" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag hashtag-icon d-none d-lg-inline">&nbsp;</i><span class="d-inline d-lg-none">#</span><span class="text-dark tag-name">{{ $fav_tag->tag->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endauth
