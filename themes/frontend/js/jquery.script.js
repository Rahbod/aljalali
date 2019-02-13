$(document).ready(function() {
    if ($(".owl-carousel").length) {
        $(".owl-carousel").owlCarousel({
            items: 1,
            autoplay: true,
            rtl: true
        });

        var dotsCount = $(".owl-carousel .owl-dot").length;
        $(".owl-carousel .owl-dots").css("margin-left", -((dotsCount * 16 + 20) / 2));
    }

    $('.mobile-menu-trigger').on('click', function (e) {
        e.preventDefault();
        $('.overlay').fadeIn('fast', function () {
            $('.menu-container .menu').addClass('open');
        });
    });

    $('.overlay').on('click', function (e) {
        e.preventDefault();
        $('.menu-container .menu').removeClass('open');
        $(this).hide();
    });

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            $('.menu-container').removeClass('on-top');
            $(".header .menu li.dropdown").removeClass("open");
        }
        else {
            $('.menu-container').addClass('on-top');
            $(".menu-container .menu li.dropdown").removeClass("open");
        }
    });

    if ($(window).width() > 768) {
        var timeout;
        $("body").on("mouseover", "li.dropdown", function () {
            clearTimeout(timeout);
            $("li.dropdown").not($(this)).removeClass("open");
            $(this).addClass("open");
        }).on("mouseleave", "li.dropdown", function () {
            var el = $(this);
            timeout = setTimeout(function () {
                el.removeClass("open");
            }, 300);
        });
    }

    $("body").on("click" ,".page-text a[href^='#']",function(e) {
        e.preventDefault();
        if ($(window).width() < 768)
            $('.menu-container .menu').removeClass('open');
        $("li.dropdown").removeClass("open");

        var href = $(this).attr('href');
        if (href.substr(1, href.length))
            $('html, body').animate({
                scrollTop: ($(href).offset().top - 90)
            }, 1000);
    });
});