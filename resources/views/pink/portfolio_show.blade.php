<div id="content-page" class="content group">
    <div class="clear"></div>
    <div class="posts">
        <div class="group portfolio-post internal-post">
            <div id="portfolio" class="portfolio-full-description">
                
                <div class="fulldescription_title gallery-filters">
                    <h1>{{ $portfolio->title }}</h1>
                </div>
                
                <div class="portfolios hentry work group">
                    <div class="work-thumbnail">
                        <a class="thumb"><img src="{{ env('THEME') }}/images/portfolios/{{ $portfolio->getMaxImage() }}" alt="0081" title="0081" /></a>
                    </div>
                    <div class="work-description">
                        {{ $portfolio->content }}
                        <div class="clear"></div>
                        <div class="work-skillsdate">
                            <p class="skills"><span class="label">Skills:</span>
                                <a href="{{ route('portfolioCategory.show', $portfolio->category->slug) }}">
                                     {{ $portfolio->category->title }}</a></p>
                            <p class="workdate"><span class="label">Year:</span> {{ $portfolio->getYear() }}</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="clear"></div>
                
                <h3>Other Projects</h3>
                
                <div class="portfolio-full-description-related-projects">
                    @if($otherProjects->isNotEmpty())
                        @foreach($otherProjects as $project)
                            <div class="related_project">
                                <a class="related_proj related_img" 
                                    href="{{ route('portfolio.show', $project->slug) }}" 
                                    title="{{ $project->title }}">
                                    <img src="{{ env('THEME') }}/images/portfolios/{{ $project->getMiniImage() }}" alt="0061" title="0061" /></a>
                                <h4><a href="{{ route('portfolio.show', $project->slug) }}">
                                    {{ $project->title }}</a></h4>
                            </div>
                        @endforeach
                    @endif                   
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>