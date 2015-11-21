@extends('Templates.Backend.main')

@section('content')


<!-- Blog Delete Success Message -->
<div class="alert alert-success modal-alert-success" style="display:none;">
    The journal post has been deleted successfully
</div>
<!-- End Blog Delete Success Message -->

<!-- Blog Delete Error Message -->
<div class="alert alert-danger modal-alert-fail" style="display:none;">
      An error ocurred please try again
</div>
<!-- End Blog Delete Error Message -->

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Journal posts</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Date</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>

				@foreach($posts as $p)

                        <tr>
                          <td>{{ $p->journal_id }}</td>
                          <td>{{ $p->title }}</td>
                          <td>{{ $p->date_posted }}</td>
                          <td>

                              <a href="{{ Request::root() }}/admin/journal/{{ $p->journal_id }}/update"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>Edit </button></a>
                              <button class="btn btn-xs btn-default" onclick="modal_confirmation('Delete journal','Are you sure you want to delete this journal post?','{{ $p->journal_id }}/delete')";><i class="fa fa-times"></i>Delete</button>
                              
                          </td>
                        </tr>

				 @endforeach

                      </tbody>

                    
                    </table>

                    <div class="widget-foot">
                     <!-- {{ $paginate_links }} -->
                      <br><br>
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