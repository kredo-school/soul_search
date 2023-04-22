@extends('layouts.app')

@section('title', 'Edit Image')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="profile-container mx-auto">
    <div class="row mt-3">
        <div class="col">

            <div>
                <canvas id='cvs' width='288' height='288' class="avatar-ex-lg rounded-circle"></canvas>
            </div>

            <div>
                <input id='scal' type='range' value='' min='10' max='288' oninput="scaling(value)" style='width: 288px;' class="form-range">
            </div>

            <div>
                <button onclick='crop_img()' class="btn btn-sm btn-orange">Crop Image</button>
            </div>

            <div>
                <canvas id='out' width='288' height='288' class="avatar-ex-lg rounded-circle"></canvas>
            </div>
            <div>
                <button onclick='save_img()' class="btn btn-sm btn-orange" id='svbtn'>Save Image</button>
            </div>

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

    let ix = 0    // center coordinate
    let iy = 0
    let v = 1.0   // zoom rate
    const img  = new Image()
    document.getElementById('svbtn').style.display = 'none' // hide the save button
    img.crossOrigin = 'Anonymous'
    img.onload = function( _ev ){
        ix = img.width  / 2
        iy = img.height / 2
        let scl = parseInt( cw / img.width * 100 )
        document.getElementById( 'scal' ).value = scl
        scaling( scl )
    }
    img.src = '{{ asset('/storage/avatars/'. $user->avatar) }}'
    function scaling( _v ) {
        v = parseInt( _v ) * 0.01
        draw_canvas( ix, iy )       // update canvas image
    }

    function draw_canvas( _x, _y ){     // update canvas image
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(222, 222, 222)'
        ctx.fillRect( 0, 0, cw, ch )    // fill the background
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (cw/2)-_x*v, (ch/2)-_y*v, img.width*v, img.height*v,
        )
    }
    function crop_img(){
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(222, 222, 222)'
        ctx.fillRect( 0, 0, ow, oh )    // fill the background
        ctx.drawImage( img,
            0, 0, img.width, img.height,
            (ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,
        )
        document.getElementById('svbtn').style.display = '' // show the save button
    }

    function save_img(){
        const canvasData = out.toDataURL("image/png");
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "{{ route('crops.edit') }}", false);
        ajax.setRequestHeader('Content-Type', 'application/upload');
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 200) {
                console.log(ajax.responseText); // print response from controller
            }
        };
        ajax.send(canvasData);
    }


    let mouse_down = false      // canvas, during drug
    let sx = 0                  // canvas, start point of drug
    let sy = 0
    cvs.ontouchstart =
    cvs.onmousedown = function ( _ev ){     // canvas, start point of drug
        mouse_down = true
        sx = _ev.pageX
        sy = _ev.pageY
        return false // stop event propagation
    }
    cvs.ontouchend =
    cvs.onmouseout =
    cvs.onmouseup = function ( _ev ){       // canvas, end point of drug
        if ( mouse_down == false ) return
        mouse_down = false
        draw_canvas( ix += (sx-_ev.pageX)/v, iy += (sy-_ev.pageY)/v )
        return false // stop event propagation
    }
    cvs.ontouchmove =
    cvs.onmousemove = function ( _ev ){     // canvas, during drug
        if ( mouse_down == false ) return
        draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
        return false // stop event propagation
    }
    cvs.onmousewheel = function ( _ev ){    // canvas, zoom by mouse wheel
        let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
        if ( scl < 10  ) scl = 10
        if ( scl > 400 ) scl = 400
        document.getElementById( 'scal' ).value = scl
        scaling( scl )
        return false // stop event propagation
    }
</script>

@endsection
