
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
})(jQuery);
