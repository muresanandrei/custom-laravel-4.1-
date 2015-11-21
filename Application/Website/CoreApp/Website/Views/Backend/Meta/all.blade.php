@extends('Templates.Backend.main')

@section('content')

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Pages meta</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Page Name</th>
                          <th>Meta Description</th>
                          <th>Meta keywords</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>

				@foreach($meta_pages as $m)

                        <tr>
                          <td>{{ $m->id }}</td>
                          <td>{{ $m->page_name }}</td>
                          <td>{{ $m->meta_description }}</td>
                          <td>{{ $m->meta_keywords }}</td>
                          <td>

                              <a href="{{ Request::root() }}/admin/meta_page/{{ $m->id }}/update"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>Edit </button></a>
                              <button class="btn btn-xs btn-default"><i class="fa fa-times"></i> </button>

                          </td>
                        </tr>

				 @endforeach

                      </tbody>

                    
                    </table>

                    <div class="widget-foot">
                     
                      <br><br>
                      <div class="clearfix"></div> 

                    </div>

                  </div>

                </div>


              </div>

            </div>


@stop

@section('footer_javascript')

@parent

<script src="{{ Request::root() }}/assets/admin_theme_js/jquery.dataTables.js"></script>

<script>
   
			 $('#datatable').dataTable({"sPaginationType": "full_numbers"});
		
</script>

@stop