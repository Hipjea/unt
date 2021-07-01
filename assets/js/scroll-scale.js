$(window).on('resize scroll', function() {
    if ($('.scale-card').length > 0) {
        $.fn.isInViewport = function() {
            var elementTop = $('#partners-anchor').offset().top;
            var wrapperHeight = $('#partners-wrapper').height();
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            var elBtmCalc = (elementBottom + (wrapperHeight / 3));
            var elTpCalc = (elementTop - (wrapperHeight / 3));
            return elBtmCalc > viewportTop && elTpCalc < viewportBottom;
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
    }
});
