@extends('layouts.app')

@section('title', 'Edit Image')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')


<div class="container">
    <div class="row mt-3">
        <div class="col">
            {{-- avatar --}}
            @if ($user->avatar)
                <div class="dropdown">
                    <button class="btn shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-ex-lg rounded-circle" alt="">
                    </button>
                    <ul class="dropdown-menu">
                        <li class="ps-3">
                            <a href="{{ route('avatars.crop', Auth::id()) }}" class="text-decoration-none text-orange">
                                <i class="fa-solid fa-scissors"></i> Crop Image
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-ex-lg"></i>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <form action="{{ route('avatars.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <input type="file" class="form-control" id="avatar" name="avatar" aria-describedby="image-info" accept="image/*" required>
                    <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
                    <div class="text-muted text-sm">Max file size is 1048kb</div>
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-orange px-3">Update Image</button>
                <a type="button" href="{{ route('profiles.edit', $user->id) }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

            </form>

        </div>

    </div>

</div>

{{-- javascript to crop avatar image --}}
<script>
    const cvs = document.getElementById( 'cvs' )
    const cw = cvs.width
    const ch = cvs.height
    const out = document.getElementById( 'out' )
    const oh = out.height
    const ow = out.width

    let ix = 0    // 中心座標
    let iy = 0
    let v = 1.0   // 拡大縮小率
    const img  = new Image()
    img.crossOrigin = 'Anonymous'
    img.onload = function( _ev ){   // 画像が読み込まれた
        ix = img.width  / 2
        iy = img.height / 2
        let scl = parseInt( cw / img.width * 100 ) //
        document.getElementById( 'scal' ).value = scl
        scaling( scl )
    }
    img.src = "{{ asset('/storage/avatars/'. $user->avatar) }}"
    function scaling( _v ) {        // スライダーが変った
        v = parseInt( _v ) * 0.01
        draw_canvas( ix, iy )       // 画像更新
    }

    function draw_canvas( _x, _y ){     // 画像更新
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (cw/2)-_x*v, (ch/2)-_y*v, img.width*v, img.height*v,
        )
        ctx.strokeStyle = 'rgba(200, 0, 0, 0.8)'
        ctx.strokeRect( (cw-ow)/2, (ch-oh)/2, ow, oh ) // 赤い枠
    }
    function crop_img(){                // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,
        )
    }

    let mouse_down = false      // canvas ドラッグ中フラグ
    let sx = 0                  // canvas ドラッグ開始位置
    let sy = 0
    cvs.ontouchstart =
    cvs.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
        mouse_down = true
        sx = _ev.pageX
        sy = _ev.pageY
        return false // イベントを伝搬しない
    }
    cvs.ontouchend =
    cvs.onmouseout =
    cvs.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
        if ( mouse_down == false ) return
        mouse_down = false
        draw_canvas( ix += (sx-_ev.pageX)/v, iy += (sy-_ev.pageY)/v )
        return false // イベントを伝搬しない
    }
    cvs.ontouchmove =
    cvs.onmousemove = function ( _ev ){     // canvas ドラッグ中
        if ( mouse_down == false ) return
        draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
        return false // イベントを伝搬しない
    }
    cvs.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
        let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
        if ( scl < 10  ) scl = 10
        if ( scl > 400 ) scl = 400
        document.getElementById( 'scal' ).value = scl
        scaling( scl )
        return false // イベントを伝搬しない
    }
</script>

@endsection
