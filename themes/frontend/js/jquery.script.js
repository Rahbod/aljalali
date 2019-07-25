$(document).ready(function() {
    $.ajaxSetup({
        data: {
            'YII_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($("#js-news").length) {
        $("#js-news").ticker({
            speed: 0.10,           // The speed of the reveal
            ajaxFeed: false,       // Populate jQuery News Ticker via a feed
            htmlFeed: true,        // Populate jQuery News Ticker via HTML
            debugMode: false,       // Show some helpful errors in the console or as alerts
      	                       // SHOULD BE SET TO FALSE FOR PRODUCTION SITES!
            controls: false,        // Whether or not to show the jQuery News Ticker controls
            titleText: '<i class="toranj-icon"></i>',   // To remove the title set this to an empty String
            displayType: 'fade', // Animation type - current options are 'reveal' or 'fade'
            direction: 'rtl',       // Ticker direction - current options are 'ltr' or 'rtl'
            pauseOnItems: 5000,    // The pause on a news item before being replaced
            fadeInSpeed: 600,      // Speed of fade in animation
            fadeOutSpeed: 300      // Speed of fade out animation
        });
    }

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

    if ($(window).width() > 1200) {
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
        if ($(window).width() < 1200)
            $('.menu-container .menu').removeClass('open');
        $("li.dropdown").removeClass("open");

        var href = $(this).attr('href');
        if (href.substr(1, href.length))
            $('html, body').animate({
                scrollTop: ($(href).offset().top - 90)
            }, 1000);
    });
});