@if($portfolios->isNotEmpty())
    <div id="content-page" class="content group">
        <div class="hentry group">
            <script>
                jQuery(document).ready(function($){
                    $('.sidebar').remove();
                    
                    if( !$('#primary').hasClass('sidebar-no') ) {
                        $('#primary').removeClass().addClass('sidebar-no');
                    }
                });
            </script>
            <ul id="portfolio" class="three-columns">
                @foreach($portfolios as $key=> $portfolio)
                    <li class="slide-{{ $key+1 }} @if(($key%3 == 0)) first @endif @if(($key%3 == 2)) last group @endif one-third">
                        <div class="overlay_a">
                            <div class="overlay_wrapper">
                                <img src="{{ asset(env('THEME')) }}/images/portfolios/{{ $portfolio->getMiniImage() }}" alt="0082" title="0082" />										
                                <div class="overlay">
                                    <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/portfolios/{{ $portfolio->getMiniImage() }}" rel="lightbox" title=""></a>
                                    <a class="overlay_project" href="{{ route('portfolio.show', $portfolio->slug) }}"></a>
                                    <span class="overlay_title">{{ $portfolio->title }} </span>
                                </div>
                            </div>
                        </div>
                        <h4><a href="{{ route('portfolio.show', $portfolio->slug) }}"> {{ $portfolio->title }}</a></h4>
                        <a class="read-more" href="{{ route('portfolio.show', $portfolio->slug) }}">View Project</a>                        
                    </li>
                @endforeach
            </ul>
            <div class="general-pagination group">
                {!! $portfolios->links() !!}          
                {{-- <a href="#" class="selected">1</a><a href="#">2</a><a href="#">&rsaquo;</a></div> --}}
        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
@endif