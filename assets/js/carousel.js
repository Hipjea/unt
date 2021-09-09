jQuery(function () {
    var options = {
        loop: false,
        margin: 10,
        items: 4,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            350: {
                items: 1
            },
            700: {
                items: 2
            },
            900: {
                items: 3,
            },
            1200: {
                items: 4
            }
        }
    };
    var carousel = $('.owl-carousel-a-la-une');
    if (typeof owlCarousel === 'function') {
        carousel.on({
            'initialized.owl.carousel': function () {
                carousel.find('.item').show();
                $('.loading-placeholder').hide();
            }
        }).owlCarousel(options);
    }

    var zoomSurOptions = {
        loop:false,
        items: 3,
        responsive: {
            0: {
                margin: 0,
                stagePadding: 10,
                items: 1
            },
            350: {
                margin: 0,
                stagePadding: 40,
                items: 1
            },
            700: {
                margin: 10,
                stagePadding: 50,
                items: 2
            },
            1000: {
                margin: 10,
                stagePadding: 80,
                items: 3,
            },
            1300: {
                margin: 10,
                stagePadding: 80,
                items: 4
            }
        }
    }
    var zoomSurCarousel = $('.owl-carousel-a-la-une');
    if (typeof owlCarousel === 'function') {
        zoomSurCarousel.on({
            'initialized.owl.carousel': function () {
                zoomSurCarousel.find('.item').show();
                $('#loading-placeholder-zoom-sur').hide();
            }
        }).owlCarousel(zoomSurOptions);
    }

    $('#a-la-une-right-arrow').on('click', function() {
        $('.owl-carousel-a-la-une').trigger('next.owl.carousel');
    });
    $('#a-la-une-left-arrow').on('click', function() {
        $('.owl-carousel-a-la-une').trigger('prev.owl.carousel');
    });

    if (typeof owlCarousel === 'function') { 
        $('.owl-carousel-notice-lien').owlCarousel({
            loop: false,
            margin: 10,
            items: 3,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                350: {
                    items: 1
                },
                700: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });
    }
    $('#notice-lien-right-arrow').on('click', function() {
        $('.owl-carousel-notice-lien').trigger('next.owl.carousel');
    });
    $('#notice-lien-left-arrow').on('click', function() {
        $('.owl-carousel-notice-lien').trigger('prev.owl.carousel');
    });
});