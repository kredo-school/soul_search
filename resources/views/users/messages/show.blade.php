@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/message.css') }}" rel="stylesheet">
@endsection

@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-center p-0">
    <!-- Users -->
    <div class="message-list bg-white border-start border-end">
        <ul class="nav nav-pills flex-column px-0">
            @foreach($all_users as $a_user)
                @php
                    $message_to = $a_user->messageTo(Auth::id());
                    $message_from = $a_user->messageFrom(Auth::id());
                @endphp
                @if($message_to || $message_from || $a_user->followedBy(Auth::id()))
                    @if($a_user->id == $user->id)
                        <li class="nav-item p-2 message-selected">
                    @else
                        <li class="nav-item p-2">
                    @endif
                        <div class="row">
                            <div class="col-auto me-2">
                                @if ($a_user->avatar)
                                    <img src="{{ asset('/storage/avatars/'. $a_user->avatar) }}" class="avatar-sm rounded-circle" alt="">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </div>
                            <div class="col hide-992">
                                <a href="{{ route('messages.show', ['user' => $a_user->id]) }}" class="text-decoration-none">
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
                                </a>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <!-- Messages -->
    <div class="col">
        <div class="message-box" id="message-box">
            @if($user->id !== Auth::id())
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
        console.log(client_w);
    })
</script>

@endsection
