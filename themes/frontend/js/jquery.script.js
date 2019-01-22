$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        items: 1
    });

    var dotsCount = $(".owl-carousel .owl-dot").length;
    $(".owl-carousel .owl-dots").css("margin-left", -((dotsCount * 16 + 20) / 2));

    $(window).on('scroll', function(){
        
    });
});