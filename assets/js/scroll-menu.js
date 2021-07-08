// Create a clone of the menu, right next to original.
$('.menu-header-bar').addClass('original').clone().insertAfter('.menu-header-bar').addClass('cloned').addClass('home-header-scroll').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

// Set scroll logo
var cloneHeaderLogo = $('.cloned').find('#logo-header-menu');
const logoScroll = cloneHeaderLogo.data('logo-scroll');
cloneHeaderLogo.attr("src", logoScroll);
scrollIntervalID = setInterval(stickIt, 10);

function stickIt() {
    var orgElementTop = $('.original')[0].offsetTop;
    if ($(window).scrollTop() > (orgElementTop)) {
        // scrolled past the original position; now only show the cloned, sticky element.
        // Cloned element should always have same left position and width as original element.
        orgElement = $('.original');
        coordsOrgElement = orgElement.offset();
        leftOrgElement = coordsOrgElement.left;
        widthOrgElement = orgElement.css('width');
        $('.cloned').css('left', leftOrgElement+'px').css('top',0).css('width', widthOrgElement).show();
        $('.original').css('visibility','hidden');
    } else {
        // not scrolled past the menu; only show the original menu.
        $('.cloned').hide();
        $('.original').css('visibility','visible');
    }
}

$('.menu-btn').on("click", function() {
    $('#mobile-menu').animate({ "right": "0" });
});
$('#menu-close-btn').on("click", function() {
    $('.dd-menu').hide();
    $('#mobile-menu').animate({ "right": "-101%" });
});
$('#mobile-menu .menu-content .dd .dd-menu').hide();
$('#mobile-menu .menu-content .dd-button').on("click", function() {
    $('.dd-menu').hide();
    $(this).parent().parent().find('.dd-menu').toggle();
});
