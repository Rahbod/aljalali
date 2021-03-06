$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        items: 1
    });

    var dotsCount = $(".owl-carousel .owl-dot").length;
    $(".owl-carousel .owl-dots").css("margin-left", -((dotsCount * 16 + 20) / 2));

    $('.mobile-menu-trigger').on('click', function (e) {
        e.preventDefault();
        $('.overlay').fadeIn('fast', function(){
            $('.menu-container .menu').addClass('open');
        });
    });

    $('.overlay').on('click', function (e) {
        e.preventDefault();
        $('.menu-container .menu').removeClass('open');
        $(this).hide();
    });

    $(window).on('scroll', function(){
        if($(this).scrollTop() > 200)
            $('.menu-container').removeClass('on-top');
        else
            $('.menu-container').addClass('on-top');
    });
});