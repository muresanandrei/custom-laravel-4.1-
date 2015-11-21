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

            Meta has been updated successfully.
    </div>

@endif


{{ Form::open(array('admin/meta_page/'.$meta->id.'/update', 'POST', 'class' => 'form-horizontal')) }}


{{ Form::token() }}


	<div class="form-group">
      <label class="col-lg-2 control-label">Meta Description</label>
	  	<div class="col-lg-10">
	    	<textarea class="form-control" name="meta_description" rows="3">{{ $meta->meta_description }}</textarea>
	  	</div>
	</div>

	<div class="form-group">
      <label class="col-lg-2 control-label">Meta Keywords</label>
	  	<div class="col-lg-10">
	    	<textarea class="form-control" name="meta_keywords" rows="3">{{ $meta->meta_keywords }}</textarea>
	  	</div>
	</div>
	

<button type="submit" class="btn btn-primary">Update meta</button>

{{ Form::close() }}


@stop