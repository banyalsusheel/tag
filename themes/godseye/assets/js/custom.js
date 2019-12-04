
(function ($) {
    // 'use strict';

    // Main Navigation
    $('.hamburger-menu').on('click', function () {
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
    var wpcf7Elm = document.querySelector('.wpcf7');


    if (wpcf7Elm) {
        wpcf7Elm.addEventListener('wpcf7mailsent', function (event) {
            window.location = "/thank-you?m=true"
        }, false);
    }

    var checkout_form = $('form.checkout');
    $("#billing_first_name").change(function(){
        alert()
    })
    checkout_form.on('checkout_place_order', function () {
        
        // $("#place_order").validate({
        //     rules: {
        //         billing_phone: { required: true },
        //         billing_email: {
        //             required: true,
        //             email: true
        //         }
        //     },
        //     messages: {
        //         billing_phone: "Please enter valid phone number",
        //         billing_email: {
        //             required: "We need your email address to contact you",
        //             email: "Your email address must be in the format of name@domain.com"
        //         }
        //     },
        //     submitHandler: function (form) {
        //         alert('---')
        //         return false;
        //         // $(form).ajaxSubmit();
        //     }
        // });
    });


    
    $(document.body).on('checkout_error', function () {
        var wooError = $('.woocommerce-error');
        wooError.delay(5000).fadeOut(160);
    })
})(jQuery);
