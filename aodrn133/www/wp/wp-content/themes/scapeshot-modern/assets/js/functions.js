/**
 * Add navs to testimonial slider.
 */
( function( $ ) {
    $(window).on('pageshow.scapeshot', function(){
        var owl = $('.testimonial-slider');
        owl.data('owl.carousel').options.nav = true;
        owl.trigger('refresh.owl.carousel');
    });
} )( jQuery );
