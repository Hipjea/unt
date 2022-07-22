import LazyLoad from "vanilla-lazyload";

var lazyLoadInstance = new LazyLoad();

function stickIt() {
    var orgElementTop = $('.original')[0].offsetTop;
    if ($(window).scrollTop() > (orgElementTop + 4)) {
        // scrolled past the original position; now only show the cloned, sticky element.
        // Cloned element should always have same left position and width as original element.
        const orgElement = $('.original');
        const coordsOrgElement = orgElement.offset();
        const leftOrgElement = coordsOrgElement.left;
        const widthOrgElement = orgElement.css('width');
        $('.cloned').css('left', leftOrgElement+'px').css('top',0).css('width', widthOrgElement).show();
        $('.original').css('visibility','hidden');
    } else {
        // not scrolled past the menu; only show the original menu.
        $('.cloned').hide();
        $('.original').css('visibility','visible');
    }
}

up.on('up:fragment:inserted', function(event) {
    // Images lazyloading
    lazyLoadInstance.update();
   
    $(function() {
        // Carousel
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
                    items: 2,
                },
                1200: {
                    items: 3
                }
            }
        };
        var carousel = $('.owl-carousel-a-la-une');
        if (carousel) {
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
        if (zoomSurCarousel) {
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
    
        var noticeCarousel = $('.owl-carousel-notice-lien');
        if (noticeCarousel) { 
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

        // Menu
        // Create a clone of the menu, right next to original.
        $('.menu-header-bar').addClass('original').clone().insertAfter('.menu-header-bar').addClass('cloned').addClass('home-header-scroll').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

        // Set scroll logo
        var cloneHeaderLogo = $('.cloned').find('#logo-header-menu');
        const logoScroll = cloneHeaderLogo.data('logo-scroll');
        cloneHeaderLogo.attr("src", logoScroll);
        const scrollIntervalID = setInterval(stickIt, 100);
    });
});

