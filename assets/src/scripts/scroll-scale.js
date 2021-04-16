$(window).on('resize scroll', function() {
    $.fn.isInViewport = function() {
        var elementTop = $('#partners-anchor').offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    var cards = $('.scale-card');

    if ($('#partners-anchor').isInViewport() && cards.length > 0) {
        cards.each(function(index) {
            $(this).addClass('inview');
        });
    } else {
        cards.each(function(index) {
            $(this).removeClass('inview');
        });
    }
});
