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

    $('#first_name,#last_name').keydown(function (e) {
        if (e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
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