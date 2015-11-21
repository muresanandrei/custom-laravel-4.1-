@extends('Templates.Backend.main')

@section('content')

<!-- Validation errors -->
<div class="alert alert-danger info" style="display:none;">
    <ul></ul>

</div>


<!-- On success -->
<div class="alert alert-success success_message" style="display:none;">
       Movie has been updated succesfully!
</div>


<!-- Db errors -->
<div class="alert alert-danger db_error" style="display:none">
   <ul></ul>
</div>

<!-- Dropzone -->
<div class="alert alert-success info_thumbnails" style="display:none;">
    Photos were uploaded succesfully
</div>

<div class="alert alert-success photo_deleted" style="display:none;">
    Photo was deleted successfully
</div>

{{ Form::open(array('admin/movie/'.$movie_id.'/update', 'POST', 'class' => 'form-horizontal','id' => 'ajaxform' ,'files' => true)) }}
 
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
                <textarea class="form-control"  name="meta_description" rows="3">{{ $movie->meta_description }}</textarea>
            </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Meta Keywords</label>
            <div class="col-lg-10">
                <textarea class="form-control" name="meta_keywords" rows="3">{{ $movie->meta_keywords }}</textarea>
            </div>
        </div>

        <div class="form-group">
         <label class="col-lg-2 control-label">Movie url</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="movie_url" value="{{ $movie->movie_url }}" maxlength="500" placeholder="Movie url" />
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

                  <option value="{{ $c->cat_id }}" <?php if(in_array($c->cat_id, $movie_categories_id , true)) echo 'selected="selected"' ?> >{{ $c->name }}</option>


                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Select Movie Tags</label>
        <div class="col-lg-10">
            <select multiple class="form-control select-tag" name="tags[]" data-placeholder='Select tag'>

                @foreach($tags as $t)

                    <option value="{{ $t->tag_id }}" <?php if(in_array($t->tag_id, $movie_tags_id, true)) echo 'selected="selected"' ?> >{{ $t->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Title</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="title" maxlength="150" value="{{ $movie->title }}" maxlength="255" placeholder="Title" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Time</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="time" maxlength="5" value="{{ $movie->time }}" maxlength="5" placeholder="Time" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Views</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="views" value="{{ $movie->views }}" placeholder="Views" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Movie Description</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="description" maxlength="250">{{ $movie->description }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Embed Code</label>
        <div class="col-lg-10">
            <textarea class="form-control" maxlenght="500" name="embed_code">{{ $movie->embed }}</textarea>
        </div>
    </div>

    
    <div class="form-group">

      <label class="col-lg-2 control-label">Featured</label>
      <div class="col-lg-10">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" name="featured" value="2" <?php if ($movie->featured == 2) echo 'checked="checked"' ?> /> 
          Yes

        </label>

    </div>


    <div class="form-group">
        <label class="col-lg-2 control-label" style="margin-left:107px;margin-top:15px;">Movie thumbnail images</label>
        <div class="dropzone" id="my-awesome-dropzone" style="width:84%;left:10%;margin-top:74px;">
        
            {{ Form::file('thumbnails_images[]', ['multiple' => true,'style' => 'display:none']) }}

        </div>
    </div>



<!--Div so button stays down-->
<div style="height:70px;"></div>

<button type="submit" id="submit" class="btn btn-primary">Update movie</button>

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

        var movie_id = {{ $movie_id }};

        //Form
        $('form').submit(function(e) {

            e.preventDefault();

            $.ajax({
                url: webrising.base_url+"/admin/movie/{{ $movie_id }}/update",
                method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: new FormData(this),
                beforeSend: function() { 

                    $('.info').hide().find('ul').empty(); 

                    $('.success_message').hide().find('ul').empty();

                    $('.db_error').hide().find('ul').empty();
                },
                success:function(data){

                    if(!data.success) {
                            
                        $.each(data.error,function(index, val) {
                                
                                $('.info').find('ul').append('<li>'+val+'</li>');

                        });

                        scrollTo(0,0);
                        $('.info').slideDown();

                    }else {
                        scrollTo(0,0);
                        $('.success_message').slideDown();
                        
                    }
                    
                },
                error:function(){
                                    //db error
                                    $('.db_error').append('<li>Something went wrong, please try again!</li>');
                                    scrollTo(0,0);
                                    $('.db_error').slideDown();
                                //Hide error message after 5 seconds
                                setTimeout(function(){$(".db_error").hide();},5000);
  
                }
            });
             return false;
        });

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
                    $('.photo_deleted').hide();
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
            
            },//remove file
            init: function() {

            var thisDropzone = this;

            $.getJSON(webrising.base_url+'/admin/movie/'+movie_id+'/photos', function(data) { // get the json response

            $.each(data, function(key,value){ //loop through it

                var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response 

                thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, webrising.base_url+"/movies_images/"+movie_id+'/'+value.name);//uploadsfolder is the folder where you have all those uploaded files

            });

        });

    }//get images

};
    
</script>

@stop