<div id="content-home" class="content group">
    <div class="hentry group">
        <div class="section portfolio">
            
            <h3 class="title">Latest projects</h3>
            
            <div class="clear"></div>
            
            <div class="portfolio-projects">
                @foreach($items as $item)
                    <div class="related_project">
                        <div class="overlay_a related_img">
                            <div class="overlay_wrapper">
                                <img src="{{ asset(env('THEME')) }}/images/portfolios/{{ $item->getMiniImage() }}" alt="0061" title="0061" />						
                                <div class="overlay">
                                    <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/portfolios/{{ $item->getMaxImage() }}" rel="lightbox" title=""></a>
                                    <a class="overlay_project" href="{{ route('portfolio.show', ['slug' => $item->slug]) }}"></a>
                                    <span class="overlay_title">{{ $item->title }}</span>
                                </div>
                            </div>
                        </div>
                        <h4><a href="{{ route('portfolio.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a></h4>
                        <p>{{ $item->getLimitText() }}
                    </div>
                @endforeach    
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>