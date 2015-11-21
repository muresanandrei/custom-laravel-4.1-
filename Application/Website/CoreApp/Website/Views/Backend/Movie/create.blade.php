@extends('Templates.Backend.main')

@section('content')

@if( count($errors->all()) != 0)

    <div class="alert alert-danger">

        @foreach( $errors->all() as $e )

            {{ $e }}<br/>

        @endforeach

    </div>

@endif

@if(Session::has('db_errors'))

    <div class="alert alert-danger">
        Something went wrong, please try again!
    </div>

@endif

@if(Session::has('movie_success'))

    <div class="alert alert-success movie_success">
            
            Movie was added succesfully!<br />
            Now you can add movie thumbnails.

    </div>

@endif

<!-- Dropzone -->
<div class="alert alert-success info_thumbnails" style="display:none;">
    Photos were uploaded succesfully
</div>

<div class="alert alert-success photo_deleted" style="display:none;">
    Photo was deleted successfully
</div>

{{ Form::open(array('admin/movie/create', 'POST', 'class' => 'form-horizontal','files' => true)) }}

@if(!Session::has('movie_success') )
 
 <!--Meta  -->
<div class="form-group">
  <label class="col-lg-2 control-label"></label>
    <div class="col-lg-10">

 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          <h4>Meta & Movie url</h4>
        </a>
      </h4>
    </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
                <div class="form-group">
          <label class="col-lg-2 control-label">Meta Description</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ Input::old('meta_description') }}</textarea>
            </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Meta Keywords</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3">{{ Input::old('meta_keywords') }}</textarea>
            </div>
        </div>

        <div class="form-group">
         <label class="col-lg-2 control-label">Movie url</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="movie_url" name="movie_url" value="{{ Input::old('movie_url') }}" maxlength="500" placeholder="Movie url" />
            </div>
    </div>

      </div>
    </div>
  </div>
  
</div>

</div>
  
</div>
<!-- End meta section -->

    <br />

    
    <div class="form-group">
        <label class="col-lg-2 control-label">Select Movie Category</label>
        <div class="col-lg-10">
            <select multiple class="form-control select-category" name="categories[]" data-placeholder="Select category">


                @foreach($categories as $c)

                  <option value="{{ $c->cat_id }}" <?php if(in_array($c->cat_id, Input::old('categories',array()), true)) echo 'selected="selected"' ?> >{{ $c->name }}</option>


                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Select Movie Tags</label>
        <div class="col-lg-10">
            <select multiple class="form-control select-tag" name="tags[]" data-placeholder='Select tag'>

                @foreach($tags as $t)

                    <option value="{{ $t->tag_id }}" <?php if(in_array($t->tag_id, Input::old('tags',array()), true)) echo 'selected="selected"' ?> >{{ $t->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Title</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="title" maxlength="150" value="{{ Input::old('title') }}" maxlength="255" placeholder="Title" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Time</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="time" maxlength="5" value="{{ Input::old('time') }}" maxlength="5" placeholder="Time" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Views</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="views" value="{{ Input::old('views') }}" placeholder="Views" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Description</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="description" maxlength="250">{{ Input::old('description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Embed Code</label>
        <div class="col-lg-10">
            <textarea class="form-control" maxlenght="500" name="embed_code">{{ Input::old('embed_code') }}</textarea>
        </div>
    </div>

    
    <div class="form-group">

      <label class="col-lg-2 control-label">Featured</label>
      <div class="col-lg-10">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" name="featured" value="2" <?php if(Input::old('featured') == 2) echo 'checked="checked"' ?> /> 
          Yes

        </div>

    </div>



@elseif(Session::has('movie_success'))

    <div class="form-group">
        <label class="col-lg-2 control-label" style="margin-left:107px;margin-top:15px;">Thumbnail images</label>
        <div class="dropzone" id="my-awesome-dropzone" style="width:84%;left:10%;margin-top:74px;">
        
            {{ Form::file('thumbnails_images[]', ['multiple' => true,'style' => 'display:none']) }}

        </div>
    </div>

@endif

<!--Div so button stays down-->
<div style="height:70px;"></div>

@if(!Session::has('movie_success'))
    
    <div class="form-group">
           <label class="col-lg-2 control-label"></label>
            <div class="col-lg-10">
                <button type="submit" id="submit" class="btn btn-primary">Add movie</button>
        </div>
    </div>

@endif


@if(Session::has('movie_success'))

    <a class="btn btn-primary" href="{{ Request::root() }}/admin/movie/all">Go to all movies</a>

@endif

</form>



@stop

@section('footer_javascript')

@parent

{{ HTML::script('assets/chosen/chosen.jquery.min.js') }}

{{ HTML::script('assets/admin_theme_js/drop-zone.js') }}

<script type="text/javascript">


        //Chosen
        $(".select-category").chosen();

        $(".select-tag").chosen();

        //Hide  success messages after 5 seconds
        setTimeout(function(){$(".movie_success").hide();},5000);

        //Get movie id
        var movie_id = @if(!Session::get('movie_id')){{ 0 }}@elseif(Session::get('movie_id')){{ Session::get('movie_id')}} @endif;
        //Dropzone
         Dropzone.options.myAwesomeDropzone = {
            paramName: "thumbnails_images",
            url: webrising.base_url+"/movie_dropzone/"+movie_id,
            addRemoveLinks: true,
            maxFiles: 10,
            maxFilesize:50,
            uploadMultiple: true,
            parallelUploads: 10,
            autoProcessQueue:true,
            success: function() {
                    $('.movie_success').hide();
                    $('.info_thumbnails').slideDown();
            },//success
            removedfile: function(file) {
                var name = file.name;
                $.ajax({
                    type: 'POST',
                    url: webrising.base_url+'/movie_dropzone/delete/' +movie_id,
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