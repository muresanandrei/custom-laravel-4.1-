@extends('Templates.Backend.main')

@section('content')


<!-- Movie Delete Success Message -->
<div class="alert alert-success modal-alert-success" style="display:none;">
    The photo category has been deleted successfully
</div>
<!-- End Movie Delete Success Message-->

<!-- Movie Delete Error Message -->
<div class="alert alert-danger modal-alert-fail" style="display:none;">
      An error ocurred please try again
</div>
<!-- End Movie Delete Error Message -->

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Photos categories</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>

				@foreach($photo_categories as $pc)

                        <tr>
                          <td>{{ $pc->id }}</td>
                          <td>{{ $pc->name }}</td>
                          <td>

                              <a href="{{ Request::root() }}/admin/photo/category/{{ $pc->id }}/update"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>Edit </button></a>
                              <button class="btn btn-xs btn-default" onclick="modal_confirmation('Delete photo category','Are you sure you want to delete this photo category?','{{ Request::root() }}/admin/photo/category/{{ $pc->id }}/delete')";><i class="fa fa-times"></i>Delete</button>
                              
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