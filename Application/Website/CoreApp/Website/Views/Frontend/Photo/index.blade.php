@extends('Templates.Frontend.main')

@section('header')

<div class="contents">
    	<div class="custom-container">
            <div class="row">
                <!-- Bread Crumb Start -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ Request::root() }}">Home</a></li>
                        <li class="active">Photo Gallery - {{ $meta_title }}</li>
                    </ol>
                </div>
                <!-- Bread Crumb End -->
                <!-- Content Column Start -->
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 equalcol conentsection">
                    <!-- Contents Section Started -->
                    <div class="sections">
                        <h2 class="heading">{{ $meta_title }}</h2>
                        <div class="clearfix"></div>
                        <div class="row">
                        @foreach($photos as $p)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <figure class="gallery">
                                    <a href="{{ $p['path'] }}" class="lightbox-gallery">
                                        <img src="{{ $p['path'] }}" alt="{{ $p['name'] }}" class="img-responsive hovereffect">
                                    </a>
                                </figure>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <!-- Contents Section End -->
                    <div class="clearfix"></div>
                    
                </div>
                <!-- Content Column End -->
            </div>
        </div>
    </div>

@include('Templates.Frontend.footer')

@stop