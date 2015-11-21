@extends('Templates.Backend.main')

@section('content')

<!-- Dropzone -->
<div class="alert alert-success info_thumbnails" style="display:none;">
    Photos were uploaded succesfully
</div>

<div class="alert alert-success photo_deleted" style="display:none;">
    Photo was deleted successfully
</div>

{{ Form::open(array('url' => 'admin/photo/category/create', 'POST', 'class' => 'form-horizontal','files' => true)) }}

    
 @if(!Session::has('category_id'))   
    <div class="form-group">
        <label class="col-lg-2 control-label">Select Photo Category</label>
        <div class="col-lg-10">
            <select class="form-control" name="category" data-placeholder="Select category">


                @foreach($photos_categories as $c)

                  <option value="{{ $c->id }}">{{ $c->name }}</option>


                @endforeach

            </select>
        </div>
    </div>

@endif

@if(Session::has('category_id'))
    
    <div class="form-group">
        <label class="col-lg-2 control-label" style="margin-left:107px;margin-top:15px;">Images</label>
        <div class="dropzone" id="my-awesome-dropzone" style="width:84%;left:10%;margin-top:74px;">
        
            {{ Form::file('images[]', ['multiple' => true,'style' => 'display:none']) }}

        </div>
    </div>

@endif

@if(!Session::has('category_id'))

<div class="form-group">
           <label class="col-lg-2 control-label"></label>
            <div class="col-lg-10">
                <button type="submit" id="submit" class="btn btn-primary">Add Category Photos</button>
        </div>
    </div>

@endif

<!--Div so button stays down-->
<div style="height:70px;"></div>
    
</form>

@stop

@section('footer_javascript')

@parent

{{ HTML::script('assets/admin_theme_js/drop-zone.js') }}

<script type="text/javascript">

       //Get category id
        var cat_id = @if(!Session::get('category_id')){{ 0 }}@elseif(Session::get('category_id')){{ Session::get('category_id')}} @endif;

        //Dropzone
         Dropzone.options.myAwesomeDropzone = {
            paramName: "images",
            url: webrising.base_url+"/admin/photos/"+cat_id+"/create",
            addRemoveLinks: true,
            maxFiles: 1000,
            maxFilesize:1,
            uploadMultiple: true,
            parallelUploads: 1000,
            autoProcessQueue:true,
            success: function() {
                    $('.info_thumbnails').slideDown();
            },//success
            removedfile: function(file) {
                var name = file.name;
                $.ajax({
                    type: 'POST',
                    url: webrising.base_url+'/admin/photos/delete/'+cat_id,
                    data: "id="+name,
                    dataType: 'html'
                });
                $('.info_thumbnails').hide();
                $('.photo_deleted').slideDown();
            var _ref;

            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            
            }//remove file
	};
</script>

@stop