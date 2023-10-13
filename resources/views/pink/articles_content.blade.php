<div id="content-blog" class="content group">
      @foreach($articles as $article)  
        <div class="sticky hentry hentry-post blog-big group">
            <!-- post featured & title -->
            <div class="thumbnail">
                <!-- post title -->
                <h2 class="post-title"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h2>
                <!-- post featured -->
                <div class="image-wrap">
                    <img src="{{ asset(env('THEME')) }}/images/articles/{{ $article->getMaxImage() }}" alt="{{ $article->title }}" title="{{ $article->title }}" />
                </div>
                <p class="date">
                    <span class="month">{{ $article->getMonth() }}</span>
                    <span class="day">{{ $article->getDay() }}</span>
                </p>
            </div>
            <!-- post meta -->
            <div class="meta group">
                <p class="author"><span>by <a href="#" title="Posts by {{ $article->user->name }}" rel="author">{{ $article->user->name }}</a></span></p>
                <p class="categories"><span>In: <a href="{{ route('articleCategory.show', $article->category->slug) }}" title="View all posts in {{ $article->category->title }}" rel="category tag">{{ $article->category->title }}</a></span></p>
                <p class="comments"><span><a href="#comments" title="Comment on This is the title of the first article. Enjoy it.">2 comments</a></span></p>
            </div>
            <!-- post content -->
            <div class="the-content group">
                {!! $article->text !!}
                <p><a href="{{ route('articles.show', $article->slug) }}" class="btn   btn-beetle-bus-goes-jamba-juice-4 btn-more-link">→ Read more</a></p>
            </div>
            <div class="clear"></div>
        </div>
    @endforeach
        
    {{ $articles->links() }}    
    <div class="general-pagination group"><a href="#" class="selected">1</a><a href="#">2</a><a href="#">&rsaquo;</a></div>
        
    </div>