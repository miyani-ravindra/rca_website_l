$(document).ready(function () {
    if ($(window).width() < 700) {
        if ($("ul").hasClass("tabs_z")) {
            $('body').addClass('bottoMargin');
        }
        $('body').addClass('mobile');
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide"
            });
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup, .tabs_z li').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    } else {
        $('body').removeClass('mobile');
    }
    $(window).on('resize', function () {
        var win = $(this);
        if (win.width() < 700) {
            $('body').addClass('mobile');
        } else {
            $('body').removeClass('mobile');
        }
    });


    $(".Hamburger").click(function () {
        $(".__sd_header").toggleClass("openMobileNav");
        $(this).toggleClass("toggleHam");
    });
    $(".CloseNav").click(function () {
        $(".__sd_header").toggleClass("openMobileNav");
        $(".Hamburger").toggleClass("toggleHam");
    });
});