@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('styles')
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="ss-container">
    <div class="row">
        {{-- side bar --}}
        <div class="ss-sidebar">
            <div class="sidebar-fix m-0 p-0">
                @include('admin.admin_side')
            </div>
        </div>

        <div class="col p-0">
            <div class="ss-main">
                <div class="mx-4 admin-container">
                    <h2 class="mb-3 p-0 mt-4">Posts</h2>

                    <table class="table table-hover bg-white border">
                        <thead class="small bg-orange">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Tag / Text</th>
                                <th>Username</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_posts as $post)
                            <tr>
                                <td>
                                    {{ $post->id }}
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        <img src="/uploads/posts/{{ $post->image }}" alt="{{ $post->image }}" class="d-block mx-auto avatar-md">
                                    </a>
                                </td>
                                <td>
                                    <span class="hash-link">{{ $post->text }}</span>
                                </td>
                                <td>
                                    {{ $post->user->username }}
                                </td>
                                <td>
                                    {{ $post->created_at }}
                                </td>
                                <td>
                                    @if ($post->trashed())
                                    <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp; Hidden
                                    @else
                                    <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        @if ($post->trashed())
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                                                <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                                            </button>
                                        </div>
                                        @else
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                                <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @include('admin.posts.modal.status')

                            {{--  No Posts  --}}
                            @empty
                            <tr>
                            <td colspan="7" class="lead text-muted text-center">No posts found.</td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-0">
                        {{ $all_posts->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const setHashtagLink= (selector)=>{
        const elements = document.querySelectorAll(selector);
        elements.forEach(element =>{
            element.innerHTML = element.innerHTML.replace(/#(\w+)/g, '<a href="#$1" class="text-decoration-none">#$1</a>');
        });
    }
    setHashtagLink('.hash-link');
</script>

@endsection
