@foreach($movie_comments as $mc)
                        <div id="comments" class="comments">
                            <div class="media">

                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $mc->name }}</a></h4>
                                    <time datetime="2014-05-12T17:02">{{ $date_format->format_date_day_only($mc->date) }}, {{ $date_format->format_date_year_only($mc->date) }} - {{ $date_format->format_date_time_only($mc->date) }}</time>
                                    <p>
                                        {{{ nl2br($mc->comment) }}}
                                    </p>
                                </div>
                            </div>
                            
                        </div>
@endforeach