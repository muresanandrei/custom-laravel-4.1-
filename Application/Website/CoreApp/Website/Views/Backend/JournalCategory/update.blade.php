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

            Category has been updated successfully.
    </div>

@endif

{{ Form::open(array('admin/journal/category/'.$category_id.'/update', 'POST', 'class' => 'form-horizontal')) }}


{{ Form::token() }}

  <div class="form-group">
      <label class="col-lg-2 control-label">Meta Description</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="meta_description" rows="3">{{ $category->meta_description }}</textarea>
        </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Meta Keywords</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="meta_keywords" rows="3">{{ $category->meta_keywords }}</textarea>
        </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Category url</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="category_url" value="{{ $category->category_url }}" maxlength="500" placeholder="Category url" />
        </div>
    </div>

<div class="form-group">
    <label class="col-lg-2 control-label">Category Name</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" name="category_name" value="{{ $category->name }}" maxlength="255" placeholder="Category Name">
    </div>
</div>



<!--Div so button stays down-->
<div style="height:70px;"></div>

<button type="submit" class="btn btn-primary">Update Category</button>

</form>

<!--Div so footer stays down-->
<div style="height:5px;"></div>

@stop