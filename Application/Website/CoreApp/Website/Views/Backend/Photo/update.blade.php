@extends('Templates.Backend.main')

@section('content')

<!-- Dropzone -->
<div class="alert alert-success info_thumbnails" style="display:none;">
    Photos were uploaded succesfully
</div>

<div class="alert alert-success photo_deleted" style="display:none;">
    Photo was deleted successfully
</div>

{{ Form::open(array('admin/photo/category/'.$id.'/update', 'POST', 'class' => 'form-horizontal','id' => 'ajaxform' ,'files' => true)) }}
 
 
    <div class="form-group">
        <label class="col-lg-2 control-label" style="margin-left:107px;margin-top:15px;">Movie thumbnail images</label>
        <div class="dropzone" id="my-awesome-dropzone" style="width:84%;left:10%;margin-top:74px;">
        
            {{ Form::file('images', ['multiple' => true,'style' => 'display:none']) }}

        </div>
    </div>


<!--Div so button stays down-->
<div style="height:70px;"></div>

</form>

@stop

@section('footer_javascript')

@parent

{{ HTML::script('assets/chosen/chosen.jquery.min.js') }}

{{ HTML::script('assets/admin_theme_js/drop-zone.js') }}

<script type="text/javascript">


        var id = {{ $id }};

       
        //Dropzone
         Dropzone.options.myAwesomeDropzone = {
            paramName: "images",
            url: webrising.base_url+"/admin/photos/"+id+"/create",
            addRemoveLinks: true,
            maxFiles: 1000,
            maxFilesize:1,
            uploadMultiple: true,
            parallelUploads: 1000,
            autoProcessQueue:true,
            success: function() {
                    $('.photo_deleted').hide();
                    $('.info_thumbnails').slideDown();
            },//success
            removedfile: function(file) {
                var name = file.name;
                $.ajax({
                    type: 'POST',
                    url: webrising.base_url+'/admin/photos/delete/'+id,
                    data: "id="+name,
                    dataType: 'html'
                });
                $('.info_thumbnails').hide();
                $('.photo_deleted').slideDown();
            var _ref;

            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            
            },//remove file
            init: function() {

            var thisDropzone = this;

            $.getJSON(webrising.base_url+'/admin/photo/category/'+id+'/photos', function(data) { // get the json response

            $.each(data, function(key,value){ //loop through it

                var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response 

                thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, webrising.base_url+"/photo_gallery/"+id+'/'+value.name);//uploadsfolder is the folder where you have all those uploaded files

            });

        });

    }//get images

};
    
</script>

@stop