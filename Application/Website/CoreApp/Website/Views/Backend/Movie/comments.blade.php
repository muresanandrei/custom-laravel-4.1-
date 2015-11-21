@extends('Templates.Backend.main')

@section('content')


<!-- Movie Comment Approved Message -->
<div class="alert alert-success modal-alert-success movie_comment_approved" style="display:none;">
    
</div>
<!-- End Movie Comment Approved Message -->

<div class="alert alert-success movie_comment_disabled" style="display:none;">
 
</div>


<!-- Movie Comment Approve Error  -->
<div class="alert alert-danger modal-alert-fail movie_comment_fail" style="display:none;">
      An error ocurred please try again
</div>
<!-- End Movie Comment Approve, Disabled Error -->

 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Movies comments</div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Movie id</th>
                          <th>Name</th>
                          <th>Comment</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>

				@foreach($movies_comments as $mc)

                        <tr>
                          <td>{{ $mc->id }}</td>
                          <td>{{ $mc->movie_id }}</td>
                          <td>{{ $mc->name }}</td>
                          <td>{{ $mc->comment }}</td>
                          <td>{{ $mc->date }}</td>
                          <td>@if($mc->status == 1) Approved @elseif($mc->status == 0) Disabled @endif</td>
                          <td>

                              <a <?php if($mc->status == 1) echo 'style="display:none;"';?> class="approve" id="a{{ $mc->id }}" onclick="approve( {{$mc->id}} ); return false;" href="#"><button class="btn btn-xs btn-default"><i class="fa fa-comment"></i>Approve</button></a>
                              <a <?php if($mc->status == 0) echo 'style="display:none;"'; ?> class="disable" id="d{{ $mc->id }}" onclick="disable( {{ $mc->id }} ); return false;" href="#"><button class="btn btn-xs btn-default"><i class="fa fa-comment-o"></i>Disable</button></a>
                              <button class="btn btn-xs btn-default" onclick="modal_confirmation('Delete movie comment','Are you sure you want to delete this movie comment?','comment/{{ $mc->id }}/delete')";><i class="fa fa-times"></i>Delete</button>
                              
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

    
        //Comment approve
        function approve(id) {
            
            $.ajax({
                url: webrising.base_url+"/admin/movie/comment/"+id+"/approve",
                method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: false,
                beforeSend: function() { 

                    $('.movie_comment_approved').hide().empty(); 

                    $('.movie_comment_fail').hide().empty();
                },
                success:function(data){
                      
                      if(!data.success)
                      {                
                              $('.movie_comment_fail').slideDown();
                              setTimeout(function(){$(".movie_comment_fail").slideUp();},5000);

                          }//if error
                          else
                          {

                              $('#a'+id).hide();
                              $('#d'+id).show();
                              
                              $('.movie_comment_approved').append("<p>Movie comment has been approved</p>").slideDown();
                              setTimeout(function(){$(".movie_comment_approved").slideUp();},5000); 

                }//else success
                    
                }

              });
                return false;
            
             }//approve
      

    //Comment disable
     function disable(id) {
            
    
            $.ajax({
                url: webrising.base_url+"/admin/movie/comment/"+id+"/disable",
                method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: false,
                beforeSend: function() { 

                    $('.movie_comment_disabled').hide().empty(); 

                    $('.movie_comment_fail').hide().empty();
                },
                success:function(data){
                      
                      if(!data.success)
                      {                

                              $('.movie_comment_fail').slideDown();
                              setTimeout(function(){$(".movie_comment_fail").slideUp();},5000);

                          }//if error
                          else
                          {
                              $('#d'+id).hide();
                              $('#a'+id).show();
                              
                              $('.movie_comment_disabled').append("<p>The movie comment has been disabled.</p>").slideDown();
                              setTimeout(function(){$(".movie_comment_disabled").slideUp();},5000); 

                }//else success
                    
                }

              });
                return false;
            
             }//disable

</script>

@stop