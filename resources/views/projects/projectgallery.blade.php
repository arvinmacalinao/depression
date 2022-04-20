@extends('./layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">
            <h2><b>Project Gallery</b></h2>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-sm-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Album name..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>   
            
            <!-- Start of Images -->
            @foreach($proj_details as $proj_detail)
            <div class="collage-images">
                <button type="button" onclick="delChat(this)" value="{{$proj_detail->album_id}}" class="btn btn-primary btn-sm btn-block mt-3 text-left collapsible" id="img_show">
                    <span class="pull-left">
                    <b><h5>{{$proj_detail->album_name}}</h5></b> 
                    {{$proj_detail->prj_title}}
                    </span>
                    <i class="fa fa-angle-down fa-lg pull-right mt-1 ikon_class" style="font-size:50px; vertical-align: middle; aria-hidden=true"></i>
                </button>

                <div class="content mt-2" id="img_{{$proj_detail->album_id}}">
                    <input type="hidden" id="custId" name="custId" value="{{$proj_detail->album_id}}">
                    <div class="collage-image lazy" data-milk="" id="img_dummy_{{$proj_detail->album_id}}"></div>
                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                </div>
            </div>
                
            @endforeach

            <div class="card-footer d-flex justify-content-center">
                {{$proj_details->links()}}
            </div>
        <!-- End of Images -->
        </div>
    </div>
</div>

<script>
    opened = "false";
    open_id = ""
    var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        $(this).find('i').toggleClass('fa fa-angle-down fa fa-angle-up');
        opened = "false";
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        $(this).find('i').toggleClass('fa fa-angle-up fa fa-angle-down');
        opened = "true";
        } 
    });
    }


function delChat(el) {
    img_album_id = el.getAttribute('value')
    if (opened == "false") {
        // console.log(img_album_id);

        $.ajax({
        url: "get-by-imgid",
        type: "GET",
        data:{ 
            img_album_id: img_album_id
        },
        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
            $('#loader').removeClass('hidden')
        },
        success:function(response){
            var data = response
            jQuery.each(data,function(index, value){
                img_link = "../images/project_album/";
                a = $('<a />');
                a.attr('href',img_link + value.photo_file);
                a.attr('target',"_blank");
                a.attr('title',value.photo_filename);
                a.attr('id',"img_succumb_" + img_album_id);
                a.attr('class',"collage-image");
                a.attr('style',"background-image: url(" + img_link + value.photo_file + ")");
                $('#img_' + img_album_id).append(a);
                opened = "false";
            });
        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('#loader').addClass('hidden');
                $('#img_dummy_' + img_album_id).addClass('tago');
        },
    });      
    }
}

</script>
@endsection