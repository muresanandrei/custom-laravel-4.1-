@extends('Templates.Frontend.main')

@section('header')

    <div class="contents">
        <div class="custom-container">
            <div class="row"> 
                <!-- Bread Crumb Start -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ Request::root() }}">Home</a></li>
                        <li class="active">Tag {{ $meta_title }}</li>
                    </ol>
                </div>
                <!-- Bread Crumb End -->
                <!-- Content Column Start -->
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 equalcol conentsection"> 
                    <!-- Contents Section Started -->
                    <div class="sections">
                        <h2 class="heading">{{ $meta_title }} videos</h2>
                        <div class="clearfix"></div>
                        <div class="row">
                                
                           @foreach($tag_movies as $m)

                             <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                                <!-- Video Box Start -->
                                <div class="videobox2">
                                    <figure> 
                                        <!-- Video Thumbnail Start --> 
                                        <a href="{{ Request::root() }}/watch/{{ $m->movie_id }}/{{ $m->movie_url }}">
                                            <img src="{{ Request::root() }}/movies_images/{{ $m->movie_id }}/1.jpg" 
                                                 class="img-responsive hovereffect" id="img_{{ $m->movie_id }}"
                                                 alt="{{ $m->title }}"
                                                 onmouseover="hover_movie_item(<?php echo $m->movie_id; ?>,2)"
                                                 onmouseout="unhover_movie_item(<?php echo $m->movie_id; ?>)" />
                                        </a> 
                                        <!-- Video Thumbnail End --> 
                                        <!-- Video Info Start -->
                                        <div class="vidopts">
                                            <ul>
                                                <li><i class="fa fa-heart"></i>{{ $m->plus }}</li>
                                                <li><i class="fa fa-clock-o"></i>{{ $m->time }}</li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- Video Info End --> 
                                    </figure>
                                    <!-- Video Title Start -->
                                    <h4><a href="{{ Request::root() }}/watch/{{ $m->movie_id }}/{{ $m->movie_url }}">{{ substr($m->title,0,7) }}</a></h4>
                                    <!-- Video Title End --> 
                                </div>
                                <!-- Video Box End --> 
                              </div>

                            @endforeach

                        </div>

                    </div>

                    <!-- Contents Section End -->
                    <div class="clearfix"></div>
                    
                    <!-- Pagination Start -->
                    <ul class="pagination">
                       <li>{{ $movies_paginate }}</li>
                    </ul>
                    <div class="clearfix"></div>
                    <!-- Pagination End -->
                </div>
                <!-- Content Column End --> 
                <!-- Gray Sidebar Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 equalcol graysidebar"> 
                    <!-- Interactive Tabs Widget start -->
                    <div class="widget">
                        <div class="interactivetabs"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="intertabs">
                                <li><a href="#" data-toggle="tab" style="width:298%;"><i class="fa fa-video-camera"></i>Featured Videos</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Video List Tab Start -->
                                <div class="tab-pane fade in active" id="abouttab">
                                    <div class="videolistsmall">
                                        <ul class="bloglist">
                                        @foreach($last_5_featured_movies as $lf)
                                            <li>
                                                <div class="media">
                                                    <a href="{{ Request::root() }}/watch/{{ $lf->movie_id }}/{{ $lf->movie_url }}" class="pull-left">
                                                        <img src="{{ Request::root() }}/movies_images/{{ $lf->movie_id }}/1.jpg" 
                                                                     class="media-object img-responsive hovereffect" id="img_{{ $lf->movie_id }}"
                                                                     alt="{{ $lf->title }}" />
                                                    </a>
                                                    <div class="media-body">
                                                        <h5><a href="{{ Request::root() }}/watch/{{ $lf->movie_id }}/{{ $lf->movie_url }}">{{ $lf->title }}</a></h5>
                                                        <ul>
                                                            <li><i class="fa fa-clock-o"></i>{{ $lf->time }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                           @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- Video List Tab End -->
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Interactive Tabs Widget End --> 
                   
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
                   
                </div>
                <!-- Gray Sidebar End --> 
            </div>
        </div>
    </div>


@include('Templates.Frontend.footer')

@stop

@section('footer_js')

@parent

<script type="text/javascript">

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

</script>

@stop