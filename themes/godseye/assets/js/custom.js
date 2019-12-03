
(function($) {
    // 'use strict';

    // Main Navigation
    $( '.hamburger-menu' ).on( 'click', function() {
        $(this).toggleClass('open');
        $('.site-navigation').toggleClass('show');
    });

    // Hero Slider
    var mySwiper = new Swiper('.hero-slider', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        AutoPlay: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">0' + (index + 1) + '</span>';
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

      // contact form redirection for thankyou page
    var wpcf7Elm = document.querySelector( '.wpcf7' );
    

    if(wpcf7Elm){
        wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
        window.location = "/thank-you?m=true"
    }, false );
    }
})(jQuery);
