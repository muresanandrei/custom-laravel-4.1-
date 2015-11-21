@extends('Templates.Backend.main')

@section('content')

@if(Session::has('add_category'))

    <div class="alert alert-danger">
        There must be atleast 1 category before adding a journal post!
    </div>

@endif


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

{{ Form::open(array('admin/journal/category/create', 'POST', 'class' => 'form-horizontal')) }}

 {{ Form::token() }}


    <div class="form-group">
      <label class="col-lg-2 control-label">Meta Description</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="meta_description" rows="3">{{ Input::old('meta_description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Meta Keywords</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="meta_keywords" rows="3">{{ Input::old('meta_keywords') }}</textarea>
        </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Category url</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="category_url" value="{{ Input::old('category_url') }}" maxlength="500" placeholder="Category url" />
        </div>
    </div>

    
<div class="form-group">
        <label class="col-lg-2 control-label">Category Name</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="category_name" value="{{ Input::old('category_name') }}" maxlength="255" placeholder="Category name" />
        </div>
</div>


<!--Div so button stays down-->
<div style="height:70px;"></div>

<button type="submit" class="btn btn-primary">Add category</button>


</form>


@stop