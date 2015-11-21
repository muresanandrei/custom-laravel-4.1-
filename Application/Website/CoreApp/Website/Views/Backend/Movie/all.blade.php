@extends('Templates.Backend.main')

@section('content')


<!-- Movie Delete Success Message -->
<div class="alert alert-success modal-alert-success" style="display:none;">
    The movie has been deleted successfully
</div>
<!-- End Movie Delete Success Message-->

<!-- Movie Delete Error Message -->
<div class="alert alert-danger modal-alert-fail" style="display:none;">
      An error ocurred please try again
</div>
<!-- End Movie Delete Error Message -->

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Movies</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Date</th>
                          <th>Featured</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>

				@foreach($movies as $m)

                        <tr>
                          <td>{{ $m->movie_id }}</td>
                          <td>{{ $m->title }}</td>
                          <td>{{ $m->description }}</td>
                          <td>{{ $m->date }}</td>
                          <td>@if($m->featured == 1) No @elseif($m->featured == 2) Yes @endif</td>
                          <td>

                              <a href="{{ Request::root() }}/admin/movie/{{ $m->movie_id }}/update"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>Edit </button></a>
                              <button class="btn btn-xs btn-default" onclick="modal_confirmation('Delete movie','Are you sure you want to delete this movie?','{{ $m->movie_id }}/delete')";><i class="fa fa-times"></i>Delete</button>
                              
                          </td>
                        </tr>

				 @endforeach

                      </tbody>

                    
                    </table>

                    <div class="widget-foot">

                      <div class="clearfix"></div> 

                    </div>

                  </div>

                </div>


              </div>

            </div>


@stop

@include('Templates.Modals.modal')

@section('footer_javascript')

@parent

<script src="{{ Request::root() }}/assets/admin_theme_js/jquery.dataTables.js"></script>

<script src="{{ Request::root() }}/assets/admin_theme_js/custom.js"></script>

<script type="text/javascript">

    //Datatables
		$('#datatable').dataTable({"sPaginationType": "full_numbers","iDisplayLength": 10});

    
</script>

@stop