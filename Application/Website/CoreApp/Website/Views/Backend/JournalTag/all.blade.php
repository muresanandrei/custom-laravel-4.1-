@extends('Templates.Backend.main')

@section('content')


<!-- Tag Delete Success Message -->
<div class="alert alert-success modal-alert-success" style="display:none;">
    The Tag has been deleted successfully
</div>
<!-- End Tag Delete Success Message -->

<!-- Blog Delete Error Message -->
<div class="alert alert-danger modal-alert-fail" style="display:none;">
      An error ocurred please try again
</div>
<!-- End Tag Delete Error Message -->

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Journal Tags</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Tag name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

				    @foreach($tags as $t)

                        <tr>
                          <td>{{ $t->tag }}</td>
                          <td>

                              <a href="{{ Request::root() }}/admin/journal/tag/{{ $t->tag_id }}/update"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>Edit </button></a>
                              <button class="btn btn-xs btn-default" onclick="modal_confirmation('Delete tag','Are you sure you want to delete this tag?','tag/{{ $t->tag_id }}/delete')";><i class="fa fa-times"></i>Delete</button>
                              
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