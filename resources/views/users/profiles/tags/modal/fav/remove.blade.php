{{-- modal in profile edit page --}}
<div class="modal fade" id="removeFavModal" tabindex="-1" aria-labelledby="removeFavModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">

            <form action="{{ route('tags.destroy', 1) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <h2 class="h5" id="removeFavModal">Select Favorite Tags to Remove</h2>

                    <div class="row mt-3">
                        <div class="col">
                            @foreach ($fav_tags as $fav_tag)
                                <span class="btn btn-sm btn-outline-secondary float-start me-1 mb-1" id="remFav{{$fav_tag->id}}" onclick="removeFav{{$fav_tag->id}}()">
                                    #{{$fav_tag->tag->name}}
                                </span>
                                <span id="remFavInput{{$fav_tag->id}}"></span>
                            @endforeach
                        </div>
                    </div>

                    {{-- remove btn --}}
                    <span id="remFavBtn"></span>
                </div>

                {{-- confirm btn --}}
                <span id="remFavCon"></span>

            </form>

        </div>
    </div>
</div>

<script>
    // when tag is clicked
    let remFavSelected = 0;
    @foreach ($fav_tags as $fav_tag)
        let clicked{{$fav_tag->id}} = false;
        let tag{{$fav_tag->id}} = document.getElementById('remFav{{$fav_tag->id}}');
        function removeFav{{$fav_tag->id}}(){
            if(clicked{{$fav_tag->id}}){
                // remove hidden values
                remFavInput{{$fav_tag->id}}.innerHTML = '';
                // change color
                tag{{$fav_tag->id}}.classList.remove('btn-danger');
                tag{{$fav_tag->id}}.classList.add('btn-outline-secondary');
                clicked{{$fav_tag->id}} = false;
                remFavSelected--;
            }else{
                // add hidden values
                remFavInput{{$fav_tag->id}}.innerHTML = '<input type="hidden" name="usertag_ids[]" class="form-control" value="{{$fav_tag->id}}">';
                // change color
                tag{{$fav_tag->id}}.classList.remove('btn-outline-secondary');
                tag{{$fav_tag->id}}.classList.add('btn-danger');
                clicked{{$fav_tag->id}} = true;
                remFavSelected++;
            }
            if(remFavSelected > 0){
                remFavBtn.innerHTML = '<div class="text-end"><span class="btn btn-outline-danger btn-sm px-4 mt-3" onclick="removeFavCon()">Remove</span></div>';
            }else{
                remFavBtn.innerHTML = '';
                remFavCon.innerHTML = '';
            }
        }
    @endforeach

    // show confirm button when 'remove' is clicked
    function removeFavCon(){
        remFavCon.innerHTML = '<div class="modal-footer">Are you sure?<button type="submit" class="ms-2 btn btn-outline-danger btn-sm px-4">Confirm</button></div>';
    }

</script>
