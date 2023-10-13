
<div id="sidebar-blog-sidebar" class="sidebar group">
    
    <div class="widget-first widget recent-posts">
        <h3>Recent Posts</h3>
        @if($recentPosts->isNotEmpty())
        <div class="recent-post group">
            @foreach($recentPosts as $post)
            <div class="hentry-post group">
                <div class="thumb-img"><img src="{{ asset(env('THEME')) }}/images/articles/{{ $post->getMiniImage() }}" alt="{{ $post->title }}" title="{{ $post->title }}" /></div>
                <div class="text">
                    <a href="{{ route('articles.show', $post->slug) }}" title="{{ $post->title }}" class="title">{{ $post->title }}</a>
                    <p>{{ $post->getLimitText() }} </p>
                    <a class="read-more" href="{{ route('articles.show', $post->slug) }}">&rarr; Read More</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    
</div>