@extends('Templates.Frontend.main')

@section('header')


<!-- Video Player Section Start -->
    <div class="videoplayersec">
        <div class="vidcontainer">
            <div class="row"> 
                <!-- Video Player Start -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 playershadow">
                    <div class="playeriframe">
                       {{$movie->embed }}
                    </div>
                </div>
                <!-- Video Player End --> 
                <!-- Video Stats and Sharing Start -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 videoinfo">
                    <div class="row"> 
                        <!-- Uploader Start -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 uploader">
                            <figure> <a href="video-list.html"><img src="images/avatar2.jpg" alt="" /></a> </figure>
                            <div class="aboutuploader">
                                <h5><a href="video-list.html">Starfuck</a></h5>
                                <time datetime="25-12-2014">Uploaded : {{ $movie->date }}</time>
                                <br />
                                <a class="btn btn-primary btn-xs backcolor" href="{{ Request::root() }}">Watch All Videos</a> </div>
                        </div>
                        <!-- Uploader End --> 
                        <!-- Video Stats Start -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats">
                            <hr class="visible-xs" />
                            <ul>
                                <li class="likes">
                                    <h5>Spanks</h5>
                                    <h2>{{ $movie->plus }}</h2>
                                </li>
                                <li class="views">
                                    <h5>Views</h5>
                                    <h2>{{ number_format($movie->views) }}</h2>
                                </li>
                            </ul>
                        </div>
                        <!-- Video Stats End --> 
                        <!-- Video Share Start -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 videoshare">
                            <ul>
                                <li class="facebook">
                                    <i class="fa fa-facebook"></i>
                                    <div class="shaingstats">
                                        <h5>36K</h5>
                                        <p>Shares</p>
                                    </div>
                                    <a href="http://www.facebook.com/" class="link" target="_blank"></a>
                                </li>
                                <li class="twitter">
                                    <i class="fa fa-twitter"></i>
                                    <div class="shaingstats">
                                        <h5>15K</h5>
                                        <p>Tweets</p>
                                    </div>
                                    <a href="http://www.twitter.com/" class="link" target="_blank"></a>
                                </li>
                                <li class="gplus">
                                    <i class="fa fa-google-plus"></i>
                                    <div class="shaingstats">
                                        <h5>7K</h5>
                                        <p>Shares</p>
                                    </div>
                                    <a href="https://plus.google.com/" class="link" target="_blank"></a>
                                </li>
                            </ul>
                        </div>
                        <!-- Video Share End --> 
                    </div>
                </div>
                <!-- Video Stats and Sharing End --> 
                <!-- Like This Video Start -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 likeit">
                 	<div class="info_spank spank_success_message"></div>
                    <hr />
                   
                    <a class="btn btn-primary backcolor push" id="spank" href="#">Spank This Video</a>
                </div>
                <!-- Like This Video Enb --> 
            </div>
        </div>
    </div>
    <!-- Video Player Section End -->
    <!-- Contents Start -->
    <div class="contents">
        <div class="custom-container">
            <div class="row"> 

                <!-- Content Column Start -->
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 equalcol conentsection"> 
                    <!-- Video Detail Started -->
                    <div class="blogdetail videodetail sections">
                    	
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="blogtext">
                                    <h2 class="heading">{{ $movie->title }}</h2>
                                    <div class="clearfix"></div>
                                    <div class="blogmetas">
                                        <ul>
                                            <li> <i class="fa fa-align-justify"></i>@foreach($movie_cat as $c) <a href="{{ Request::root() }}/movie/category/{{ $c->cat_id }}/{{ $c->cat_url }}">{{ $c->name }}, </a>@endforeach  </li>
                                            <li> <i class="fa fa-tags"></i>@foreach($movie_tags as $t) <a href="{{ Request::root() }}/movie/tag/{{ $t->tag_id }}/{{ $t->tag_url }}">{{ $t->name }}, </a>@endforeach</a> </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    	{{ $movie->title }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Video Detail End -->
                    <div class="clearfix"></div>
                    <!-- Contents Section Started -->
                    <div class="sections">
                        <h2 class="heading">Related Videos</h2>
                        <div class="clearfix"></div>
                        <div class="row">
                        @foreach($related_movies as $rm)

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                                <!-- Video Box Start -->
                                <div class="videobox2">
                                    <figure> 
                                        <!-- Video Thumbnail Start --> 
                                        <a href="{{ Request::root() }}/watch/{{ $rm->movie_id }}/{{ $rm->movie_url }}">
                                            <img alt="{{ $rm->title }}" class="img-responsive hovereffect" id="img_{{ $rm->movie_id }}"
                                            	 src="{{ Request::root() }}/movies_images/{{ $rm->movie_id }}/1.jpg"
                                            	 onmouseover="hover_movie_item(<?php echo $rm->movie_id; ?>,2)"
                                                 onmouseout="unhover_movie_item(<?php echo $rm->movie_id; ?>)" />
                                        </a> 
                                        <!-- Video Thumbnail End --> 
                                        <!-- Video Info Start -->
                                        <div class="vidopts">
                                            <ul>
                                                <li><i class="fa fa-heart"></i>{{ $rm->plus }}</li>
                                                <li><i class="fa fa-clock-o"></i>{{ $rm->time }}</li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- Video Info End --> 
                                    </figure>
                                    <!-- Video Title Start -->
                                    <h4><a href="video-detail-double-sidebar.html">{{ $rm->title }}</a></h4>
                                    <!-- Video Title End --> 
                                </div>
                                <!-- Video Box End --> 
                            </div>
                           @endforeach

                        </div>
                    </div>
                    <!-- Contents Section End -->
                    <div class="clearfix"></div>
                    <!-- Contents Section Started -->
                    <div class="sections">
                        <h2 class="heading">Comments ({{ $movie_comments_count }})</h2>
                        <div class="clearfix"></div>
                        @if(empty($movie_comments))

                            <h5>There aren't any comments.Be the first one to comment!</h5>

                        @endif

                    <!-- Comments -->
                    @include('CoreApp.Website.Views.Frontend.Movie.movie_comments_ajax')

                      <div class="clearfix"></div>

                        <!-- Comments loading more -->
                        <div id="ajax-loading" class="alert alert-warning" style="background-color:#D903FF;color:#1C0324;text-align:center;font-size:15px;display:none;">
                            <p style="text-align:center;">Spanking...</p>
                        </div>
                    @if($movie_comments_count > 10)
                        <!-- Comments pagination -->
                        <div class="pagination_comments">
                            <a class="btn btn-primary backcolor push" href="#">Load more comments</a>
                        </div>
                    @endif 

                    </div>
                    <!-- Contents Section End -->
                    <div class="clearfix"></div>
                    <!-- Contents Section Started -->
                    <div class="sections">
                        <h2 class="heading">Leave Reply</h2>
                        <div class="clearfix"></div>
                        <div id="leavereply">

                        		<!-- Comment error and success message -->
                        		<div class="info">
                        			
                        		</div>
                        		<!-- Success message -->
                        		<div class="success_message"></div>
                        		<!-- Db error -->
                        		<div class="db_error"></div>
                        		<br />

                            {{ Form::open(array('movie/'.$movie->movie_id.'/comment', 'POST','id' => 'commentForm')) }}
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">
                                            <label>Your Name</label>
                                            <input type="text" class="form-control" name="name" value="{{  Input::old('name') }}" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Your Comments</label>
                                            <textarea class="form-control" rows="3" name="comment" placeholder="Your Comments">{{  Input::old('comment') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-primary backcolor submit_comment">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Contents Section End -->
                    <div class="clearfix"></div>
                </div>
                <!-- Content Column End --> 
                <!-- Gray Sidebar Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 equalcol graysidebar"> 
                    
                <!-- Advertisement start -->

                     <!-- Advertisement 1 start -->
                      <div class="widget"> <img src="{{  Request::root() }}/assets/images/adv2.gif" class="img-responsive" alt=""> </div>
                      <div class="clearfix"></div>
                    <!-- Advertisement 1 End --> 
                        	<br />
                    <!-- Advertisement 2 start -->
                      <div class="widget"> <img src="{{  Request::root() }}/assets/images/adv2.gif" class="img-responsive" alt=""> </div>
                      <div class="clearfix"></div>
                    <!-- Advertisement 2 End -->
                            <br />
                    <!-- Advertisement 3 start -->
                      <div class="widget"> <img src="{{  Request::root() }}/assets/images/adv2.gif" class="img-responsive" alt=""> </div>
                      <div class="clearfix"></div>
                    <!-- Advertisement 3 End -->  
                    		<br />
                    <!-- Advertisement 4 start -->
                      <div class="widget"> <img src="{{  Request::root() }}/assets/images/adv2.gif" class="img-responsive" alt=""> </div>
                      <div class="clearfix"></div>
                    <!-- Advertisement 4 End -->
                    		<br />
                    <!-- Advertisement 5 start -->
                      <div class="widget"> <img src="{{  Request::root() }}/assets/images/adv2.gif" class="img-responsive" alt=""> </div>
                      <div class="clearfix"></div>
                    <!-- Advertisement 5 End -->    

                <!-- Advertisement End --> 
                   
                    <div class="clearfix"></div>
                    <!-- Recent Post Widget end -->
                </div>
                <!-- Gray Sidebar End --> 
            </div>
        </div>
    </div>
    <!-- Contents End -->
  
@include('Templates.Frontend.footer')

@stop

@section('footer_js')

@parent

<script type="text/javascript">

		//Spanks
        $('#spank').click(function(e) {

            e.preventDefault();

            $.ajax({
                url: starfuck.base_url+"/movie/{{ $movie->movie_id }}/spank",
                method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: false,
                beforeSend: function() { 

                    $('.info_spank').hide().empty(); 

                    $('.spank_success_message').hide().empty();
                },
                success:function(data){
			      				  
		      				    if(!data.success)
		      				    {                
                					
                					$('.info_spank').append(data.error);
                       				$('.info_spank').slideDown();
                        			setTimeout(function(){$(".info_spank").slideUp();},5000);

                    			}//if error
                    			else
                    			{

                    				$('.spank_success_message').append('<h4>Movie Spanked!</h4>');
                        			$('.spank_success_message').slideDown();
                         			setTimeout(function(){$(".spank_success_message").slideUp();},5000); 

								}//else success
                		
                }

            });
             return false;
        });

	function hover_movie_item(id, thumb_no){

	    /**
	     * CHANGE THUMB
	     */
	    var image_folder     = starfuck.base_url+'/movies_images/'+id+'/';
	    
	    $('#img_'+id).attr('src', image_folder+thumb_no+'.jpg');


	    /**
	     * Prepare next thumb
	     */
	    if( thumb_no != 10 ){
	        
	                var next_thumb_no = thumb_no + 1;
	        
	    }//if thumb is not 10
	    else{
	        
	                var next_thumb_no = 1;

	    }//else thumb no is 10, we reset to 1
	    
	  
	    this.timeout_id = window.setTimeout( function(){ 

	                                                 hover_movie_item(id, next_thumb_no);

	                                 }, 1000 );
	    
	    return false;
	    
	}//hover_movie_item

	function unhover_movie_item(id){
	    
	                window.clearTimeout(this.timeout_id);
	    
	                var image_folder     = starfuck.base_url+'/movies_images/'+id+'/';

	                $('#img_'+id).attr('src', image_folder+'1.jpg');
	    
	}//unhover_movie_item


		//Comments
        $('#commentForm').submit(function(e) {

            e.preventDefault();

            $.ajax({
                url: starfuck.base_url+"/movie/{{ $movie->movie_id }}/comment",
                method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: new FormData(this),
                beforeSend: function() { 

                    $('.info').hide().empty(); 

                    $('.success_message').hide().empty();

                    $('.db_error').hide().empty();
                },
                success:function(data){

                    if(!data.success) {
                            
                        $.each(data.error,function(index, val) {
                               
                                $('.info').append('<p>'+val+'</p> <br />');

                        });

                        $('.info').slideDown();

                    }else {
                    	$('#commentForm').hide();
                    	$('.success_message').append('<li>Thank you for submitting your comment! All comments are moderated and may take up to 24 hours to be posted.</li>');
                        $('.success_message').slideDown();
                        
                    }
                    
                },
                error:function(){
                                    //db error
                                    $('.db_error').append('<li>Something went wrong, please try again!</li>');
                                    $('.db_error').slideDown();
                                //Hide error message after 5 seconds
                                setTimeout(function(){$(".db_error").hide();},5000);
  
                }
            });
             return false;
        });
        
        //More Comments
        var a = 0;

        //Load more comments
        $(".pagination_comments a").click(function(e)
        {
            e.preventDefault();

                a += 10;

            $.ajax(
            {

                url:  starfuck.base_url+"/watch/{{ $movie->movie_id }}/{{ $movie->movie_url }}",
                type: "get",
                datatype: "html",
                data: { add_comments : a },
                beforeSend: function()
                {
                    $('#ajax-loading').show();
                }
            })
            .done(function(data)
            {
                $('#ajax-loading').hide();
                
                $( ".comments" ).each(function(index) {
                    $(this).hide().empty();

                });

                $("#comments").show().html(data.html);
                   
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('No response from server');
            });
            return false;
    });

</script>


@stop