@if($items->isNotEmpty())
<div id="slider-thumbnails" class="slider thumbnails group inner">
    <div class="showcase group">
        @foreach($items as $item)
            <div class="showcase-slide">
                <div class="showcase-content">
                    <!-- If the slide contains multiple elements you should wrap them in a div with the class
                        .showcase-content-wrapper. We usually wrap even if there is only one element,
                        because it looks better. -->
                    <div class="showcase-content-wrapper">
                        <img src="{{ asset(env('THEME')) }}/images/sliders/{{ $item->getMaxImage() }}" alt="{{ $item->title }}" title="{{ $item->title }}" />
                    </div>
                </div>
                <!-- Put the caption content in a div with the class .showcase-caption -->
                <div class="showcase-thumbnail">
                    <img src="{{ env('THEME') }}/images/sliders/{{ $item->getMiniImage() }}" />
                </div>
                <!-- Put the tooltips in a div with the class .showcase-tooltips. -->
            </div>
        @endforeach


    </div>
</div>
<!-- END SLIDER --> 
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#slider-thumbnails.thumbnails img.attachment-full').css('width', '1178px').css('height', '378px');
        var resize_height_thumbnail = function(){
            $('.showcase-content-container, .showcase-content').height( $('.showcase-content-wrapper').height() );
        };
        $(window).resize(resize_height_thumbnail);
    
    $("#slider-thumbnails .showcase").awShowcase({
         content_width           : 1178 + 22,
         content_height          : 378 + 22,		
    show_caption            : 'onload', /* onload/onhover/show */    
    continuous              : true,
    buttons                 : false,
    auto                    : true,
    thumbnails              : true,           
    transition              : 'fade', /* hslide / vslide / fade */
    interval                : 7000,
    transition_speed        : 800,
    thumbnails_position     : 'outside-last', /* outside-last/outside-first/inside-last/inside-first */
    thumbnails_direction    : 'horizontal', /* vertical/horizontal */
    thumbnails_slidex       : 1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
    onload                  : function(){
                $( window ).load(function(){
                    resize_height_thumbnail();
                });
            }
     });
    });
</script>
@endif