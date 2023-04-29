{{-- modal in profile edit page --}}
<div class="modal fade" id="removeMainModal" tabindex="-1" aria-labelledby="removeMainModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">

            <form action="{{ route('tags.destroy', 1) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <h2 class="h5" id="removeMainModal">Select Main Tags to Remove</h2>

                    <div class="row mt-3">
                        <div class="col">
                            @foreach ($main_tags as $main_tag)
                                <span class="btn btn-sm btn-outline-secondary float-start me-1 mb-1" id="remMain{{$main_tag->id}}" onclick="removeMain{{$main_tag->id}}()">
                                    #{{$main_tag->tag->name}}
                                </span>
                                <span id="remMainInput{{$main_tag->id}}"></span>
                            @endforeach
                        </div>
                    </div>

                    {{-- remove btn --}}
                    <span id="remMainBtn"></span>
                </div>

                {{-- confirm btn --}}
                <span id="remMainCon"></span>

            </form>

        </div>
    </div>
</div>

<script>
    // when tag is clicked
    let remMainSelected = 0;
    @foreach ($main_tags as $main_tag)
        let clicked{{$main_tag->id}} = false;
        let tag{{$main_tag->id}} = document.getElementById('remMain{{$main_tag->id}}');
        function removeMain{{$main_tag->id}}(){
            if(clicked{{$main_tag->id}}){
                // remove hidden values
                remMainInput{{$main_tag->id}}.innerHTML = '';
                // change color
                tag{{$main_tag->id}}.classList.remove('btn-danger');
                tag{{$main_tag->id}}.classList.add('btn-outline-secondary');
                clicked{{$main_tag->id}} = false;
                remMainSelected--;
            }else{
                // add hidden values
                remMainInput{{$main_tag->id}}.innerHTML = '<input type="hidden" name="usertag_ids[]" class="form-control" value="{{$main_tag->id}}">';
                // change color
                tag{{$main_tag->id}}.classList.remove('btn-outline-secondary');
                tag{{$main_tag->id}}.classList.add('btn-danger');
                clicked{{$main_tag->id}} = true;
                remMainSelected++;
            }
            if(remMainSelected == 0){
                remMainBtn.innerHTML = '';
                remMainCon.innerHTML = '';
            }else if(remMainSelected == 3){
                remMainBtn.innerHTML = '<div class="text-danger text-end">You cannot remove all the main tags</div>';
                remMainCon.innerHTML = '';
            }else{
                remMainBtn.innerHTML = '<div class="text-end"><span class="btn btn-outline-danger btn-sm px-4 mt-3" onclick="removeMainCon()">Remove</span></div>';
            }
        }
    @endforeach

    // show confirm button when 'remove' is clicked
    function removeMainCon(){
        remMainCon.innerHTML = '<div class="modal-footer">Are you sure?<button type="submit" class="ms-2 btn btn-outline-danger btn-sm px-4">Confirm</button></div>';
    }

</script>
