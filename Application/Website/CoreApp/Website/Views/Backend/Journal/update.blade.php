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

@if(Session::has('success'))

    <div class="alert alert-success">

            Journal post has been updated successfully.
    </div>

@endif

{{ Form::open(array('admin/journal/'.$journal_id.'/update', 'POST', 'class' => 'form-horizontal','files' => true)) }}


{{ Form::token() }}


    <!--Meta  -->
<div class="form-group">
  <label class="col-lg-2 control-label"></label>
    <div class="col-lg-10">

 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          <h4>Meta & Journal url</h4>
        </a>
      </h4>
    </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
                <div class="form-group">
          <label class="col-lg-2 control-label">Meta Description</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $journal_post->meta_description }}</textarea>
            </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Meta Keywords</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3">{{ $journal_post->meta_keywords }}</textarea>
            </div>
        </div>

        <div class="form-group">
         <label class="col-lg-2 control-label">Journal url</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="post_url" value="{{ $journal_post->post_url }}" maxlength="500" placeholder="Journal url" />
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
    <label class="col-lg-2 control-label">Select Journal Category</label>
    <div class="col-lg-10">
        <select class="form-control" name="category">

            <option value="0">Select a Journal category</option>

            @foreach($categories as $c)

                <option value="{{ $c->id }}" <?php if($journal_category_id == $c->id) echo 'selected="selected"'; ?> >{{ $c->name }}</option>

            @endforeach

        </select>
    </div>
</div>

<div class="form-group">
        <label class="col-lg-2 control-label">Select Journal Tags</label>
        <div class="col-lg-10">
            <select multiple class="form-control select-tag" name="tags[]" data-placeholder='Select tag'>

                @foreach($tags as $t)

                    <option value="{{ $t->id }}" <?php if(in_array($t->id, $journal_post_tags_id , true)) echo 'selected="selected"' ?> >{{ $t->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

<div class="form-group">
    <label class="col-lg-2 control-label">Title</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" name="title" value="{{ $journal_post->title }}" maxlength="255" placeholder="Title">
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Post</label>
    <div class="col-lg-10">
        <div class="has_redactor"><textarea id="body" name="post">{{ $journal_post->post }}</textarea></div>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Main journal image</label>
    <div class="col-lg-10">
        {{Form::file('main_journal_image')}}

        <br />
        <img src="{{ Request::root() }}/cms/journal/{{$journal_id}}/journal_photo_small.{{$journal_post->journal_image_extension}}" alt="journal_main_image" />
    </div>
</div>


<div class="form-group">

      <label class="col-lg-2 control-label">Featured</label>
      <div class="col-lg-10">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" name="featured" value="2" <?php if(2 == $journal_post->featured ) echo 'checked="checked"' ?> /> 
          Yes

        </label>

    </div>

<!--Div so button stays down-->
<div style="height:70px;"></div>

<button type="submit" class="btn btn-primary">Update journal post</button>

</form>

<!--Div so footer stays down-->
<div style="height:5px;"></div>

@stop

@section('footer_javascript')

@parent

{{ HTML::script('assets/redactor/redactor.min.js') }}

{{ HTML::style('assets/redactor/redactor.css') }}

{{ HTMl::script('assets/chosen/chosen.jquery.min.js') }}

<script type="text/javascript">


    //Chosen
    $(".select-tag").chosen();

    //Redactor
    $('#body').redactor({
        imageUpload: webrising.base_url + '/admin/redactor/image_upload'

    });

    $('.redactor_box, .redactor_, .redactor_editor').css('width','100%')
        .css('min-height','250px')
        .css('border','1px solid silver');


</script>


@stop