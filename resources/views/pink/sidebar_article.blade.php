
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
    
    <div id="last-tweets-2" class="widget last-tweets">
        <h3>Last Tweets</h3>
        <div class="list-tweets"></div>
        <script type="text/javascript">
            jQuery(function($){
                $('#last-tweets-2 .list-tweets').tweetable({
                    listClass: 'tweets-widget',
                    username: 'YIW', 
                    time: true, 
                    limit: 3, 
                    replies: true
                });
            });
        </script>
    </div>
    
    <div class="widget-last widget recent-comments">
        <h3>Recent Comments</h3>
        <div class="recent-post recent-comments group">
        
            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/unknow55.png" class="avatar" />   
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">eduard</a></strong> in</span> 
                <a class="title" href="article.html">Nice &amp; Clean. The best for your blog!</a>
                <p class="comment">
                    hi <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>
            
            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/nicola55.jpeg" class="avatar" />   
                </div>
                <span class="author"><strong><a href="mailto:nicola@yopmail.com">nicola</a></strong> in</span> 
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    While i’m the author of the post. My comment template is different,... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>
            
            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/unknow55.png" class="avatar" />   
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">Anonymous</a></strong> in</span> 
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    Hi all, i’m a guest and this is the guest’s awesome comments... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>
        </div>
    </div>
    
</div>