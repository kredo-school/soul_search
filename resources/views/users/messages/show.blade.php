@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/message.css') }}" rel="stylesheet">
@endsection

@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-center p-0">
    <!-- Users -->
    <div class="message-list bg-white">
        <ul>
            <div class="message-list-fix border-start border-end">
                @php
                    $auth_id = Auth::id();
                @endphp
                @foreach($all_users_array as $user_array)
                    @php
                        $a_user       = $user_array['user'];
                        $message_to   = $a_user->messageTo($auth_id);
                        $message_from = $a_user->messageFrom($auth_id);
                    @endphp
                    @if($message_to || $message_from || $a_user->followedBy($auth_id))
                        <a href="{{ route('messages.show', ['user' => $a_user->id]) }}" class="text-decoration-none">
                            @if($a_user->id == $user->id)
                                <li class="nav-item p-2 message-selected">
                            @else
                                <li class="nav-item p-2">
                            @endif
                                <div class="row">
                                    <div class="col-auto me-2">
                                        @if ($a_user->avatar)
                                            <img src="{{ $a_user->avatar }}" class="avatar-sm rounded-circle" alt="">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </div>
                                    <div class="col d-none d-lg-inline">
                                        @if($a_user->id == $user->id)
                                            <div class="text-dark fw-bold">
                                        @else
                                            <div class="text-dark">
                                        @endif
                                            {{$a_user->username}}
                                        </div>
                                        <div class="text-dark latest-message">
                                            {{-- show the latest message --}}
                                            <span class="text-muted">
                                                @if($message_to && $message_from)
                                                    @if($message_to->pivot->created_at > $message_from->pivot->created_at)
                                                        @if($message_to->pivot->text)
                                                            {{ $message_to->pivot->text }}
                                                        @else
                                                            {{ $a_user->username }} sent an image.
                                                        @endif
                                                    @else
                                                        @if($message_from->pivot->text)
                                                            You: {{ $message_from->pivot->text }}
                                                        @else
                                                            You sent an image.
                                                        @endif
                                                    @endif
                                                @elseif($message_to)
                                                    @if($message_to->pivot->text)
                                                        {{ $message_to->pivot->text }}
                                                    @else
                                                        {{ $a_user->username }} sent an image.
                                                    @endif
                                                @elseif($message_from)
                                                    @if($message_from->pivot->text)
                                                        You: {{ $message_from->pivot->text }}
                                                    @else
                                                        You sent an image.
                                                    @endif
                                                @endif
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif
                @endforeach

            </div>
        </ul>
    </div>

    <!-- Messages -->
    <div class="col message-scroll">
        <div class="message-box" id="message-box">
            @if($user->id !== $auth_id)
                <!-- Head -->
                @include('users.messages.contents.head')

                <!-- Body -->
                @include('users.messages.contents.body')
            @else
                <div class="bg-white p-2 mb-0 message-footer" id="footer">
                </div>
            @endif
        </div>
    </div>
</div>

{{-- javascript to set 'send message bar' width --}}
<script>
    let client_w = document.getElementById('message-box').clientWidth + 'px';
    window.document.getElementById('footer').style.width=client_w;
    window.addEventListener('resize', function(){
        client_w = document.getElementById('message-box').clientWidth + 'px';
        window.document.getElementById('footer').style.width = client_w;
    })
</script>

@endsection
