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

{{ Form::open(array('admin/journal/create', 'POST', 'class' => 'form-horizontal','files' => true)) }}


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
         <label class="col-lg-2 control-label">Journal url</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="post_url" value="{{ Input::old('post_url') }}" maxlength="500" placeholder="Journal url" />
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

                <option value="0">Select a journal category</option>

                @foreach($categories as $c)

                  <option value="{{ $c->id }}" <?php if($c->id == Input::old('category')) echo 'selected="selected"';?> >{{ $c->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Select Journal Tags</label>
        <div class="col-lg-10">
            <select multiple class="form-control select-tag" name="tags[]" data-placeholder='Select tag'>

                @foreach($tags as $t)

                    <option value="{{ $t->id }}" <?php if(in_array($t->id, Input::old('tags',array()), true)) echo 'selected="selected"' ?> >{{ $t->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Title</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="title" value="{{ Input::old('title') }}" maxlength="255" placeholder="Title" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Post</label>
        <div class="col-lg-10">
            <div class="has_redactor"><textarea id="body" name="post">{{ Input::old('post') }}</textarea></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Main journal image</label>
        <div class="col-lg-10">
            {{ Form::file('main_journal_image') }}
        </div>
    </div>


    <div class="form-group">

      <label class="col-lg-2 control-label">Featured</label>
      <div class="col-lg-10">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" name="featured" value="2" <?php if(Input::old('featured') == 2) echo 'checked="checked"' ?> /> 
          Yes

        </label>

    </div>

<!--Div so button stays down-->
<div style="height:70px;"></div>

<button type="submit" class="btn btn-primary">Add journal post</button>

</form>


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