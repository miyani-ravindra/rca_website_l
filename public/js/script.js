/*function getMsg(selector) {
    return $(selector).attr('data-msg');
}*/

$.fn.upform = function () {
    var $this = $(this);
    var container = $this.find(".upform-main");

    $(document).ready(function () {
        $(container).find(".input-block").first().click();
    });

    $(container)
        .find(".input-block")
        .not(".input-block input")
        .on("click", function () {
            rescroll(this);
        });

    $(container).find(".input-block input,.input-block textarea").keydown(function (e) {
        var keyCode = e.keyCode || e.which;
        // console.log($(this));
        if (e.which == 9 || e.which == 13) {
            if ($(this).prop('required') && $(this).val() == "") {

                return false;
            } else if ($(this).prop('error')) {
                return false;
            } else {
                moveNext(this);
            }
            // if (e.shiftKey && e.keyCode == 9) {
            //     //shift was down when tab was pressed
            //     if ($(this).hasClass("required") && $(this).val() == "") {}
            //     movePrev(this);
            // }
        }
    });

    $(container).find('.input-block input[type="radio"],.input-block input[type="checkbox"]').on('change', function (e) {
        moveNext_radio(this);
    });

    // $(container).find('.input-block select').on('change', function(e) {
    //         // moveNext_select(this);
    //         setActive();
    // });

    // $(".__select_drop").each(function(index) {
    //     $(this).off();
    //     $(this).on("change", function() {
    //         // $(this).parent().parent().removeClass('active').next().click();
    //         setActive();
    //         return false;
    //     });
    // });

    $(document).on('click', '.__select_drop', function () {
        var text = $(this).find("option:selected").text();
        if (text) {
            $(this).parent().parent().removeClass('active').next().click();
        }
    });

    // $(container).find('.input-block input[type="radio"]').keydown(function(evt) {
    //     if (evt.which) {
    //         var charStr = String.fromCharCode(evt.which);
    //         var transformedChar = transformTypedChar(charStr);
    //         var ename = evt.target.name;
    //         if (transformedChar == charStr) {
    //             // evt.target.checked = true; 
    //             $(this).prop('checked', true);
    //             moveNext_radio(evt);   
    //         }
    //     }
    // });

    $(window).on("scroll", function () {
        $(container).find(".input-block").each(function () {
            var etop = $(this).offset().top;
            var diff = etop - $(window).scrollTop();

            if (diff > 100 && diff < 300) {
                reinitState(this);
            }
        });
    });

    function reinitState(e) {
        $(container).find(".input-block.active").removeClass("active");
        /*$(container).find(".input-block input").each(function() {
            $(this).blur();
        });*/
        $(e).addClass("active");
        /*$(e).find('input,textarea').focus();*/
        $(e).find('input,textarea').focus();
    }

    function rescroll(e) {
        $(window).scrollTo($(e), 200, {
            offset: {
                left: 100,
                top: -200
            },
            queue: false
        });
    }

    function reinit(e) {
        reinitState(e);
        rescroll(e);
    }

    function moveNext_radio(e) {
        //$(e).parent().parent().parent().next().click();
        rescroll(e);
    }

    // function moveNext_select(e) {
    //     $(e).parent().parent().next().click();
    // }

    function movePrev(e) {
        $(e).parent().parent().prev().click();
    }
};

$(".upform").upform();

$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<span class=\"upImg\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">&times;</span>" +
                        "</span>").insertAfter("#fileShow");
                    $(".remove").click(function () {
                        $(this).parent(".upImg").remove();
                    });


                });
                fileReader.readAsDataURL(f);
            }
        });


    } else {
        alert("Your browser doesn't support to File API")
    }


    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
        }

    }

    $("#imgInp").change(function () {
        readURL(this);

    });


    // $("input").keyup(function () {

    //     var numValid = 0;
    //     $("input[required]").each(function () {
    //         if (this.validity.valid) {
    //             numValid++;
    //             var processBar = ($('.valid').length) * (100 / $('.Qcounter').length);

    //             $(".progressbar").css("width", processBar + "%");
    //             console.log("valid", ($('.valid').length));
    //         }
    //     });
    // });
    // $("input").click(function () {

    //     var numValid = 0;
    //     $("input[required]").each(function () {
    //         if (this.validity.valid) {
    //             numValid++;
    //             var processBar = ($('.valid').length) * (100 / $('.Qcounter').length);

    //             $(".progressbar").css("width", processBar + "%");
    //             console.log("valid", ($('.valid').length));
    //         }
    //     });
    // });


    //$('.ui.dropdown').dropdown();
    $('.only_number').keyup(function (e) {
        if (/\D/g.test(this.value)) {
            this.value = this.value.replace(/\D/g, '');
        }
    });

});


function numberOnly(txt, e) {
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
    var code;

    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
        return false;

}

(function ($) {
    $.fn.checkFileType = function (options) {
        var defaults = {
            allowedExtensions: [],
            success: function () {},
            error: function () {}
        };
        options = $.extend(defaults, options);

        return this.each(function () {

            $(this).on('change', function () {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

$(function () {
    $('.imgUploader').checkFileType({
        allowedExtensions: ['jpg', 'png', 'jpeg'],
        success: function () {
            // alert('Success');
        },
        error: function () {
            alert('Upload .png, .jpg and .jpeg files only');
        }
    });

});

function ValidateSize(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 1) {
        alert('File size exceeds 1 MB');
        // $(file).val(''); //for clearing with Jquery
    } else {
        $("#blah").addClass('showimg');
    }
}


function transformTypedChar(charStr) {
    return charStr == "y" ? "n" : charStr;
}

function getDivPositions() {
    var positions = [];

    $("div.active").each(function () {
        positions.push({
            el: $(this),
            top: $(this).offset().top,
            bottom: $(this).offset().top + $(this).height()
        });
    });
    return positions;
}

function setActive() {
    var currentPosition, divPositions;

    currentPosition = window.pageYOffset;
    divPositions = getDivPositions();

    divPositions.forEach(function (d) {
        if (d.el.hasClass("active")) {
            d.el.removeClass("active").next().click();
        } else {
            d.el.addClass("active");
        }
        // if ( currentPosition >= d.top && currentPosition <= d.bottom ) {

        // }
        // else {

        // }
    });
}

// $('.hiddenul').hide();

// $('.outerInFoc input').attr('readonly', '');

// var $li = $('.active .outerInFoc li'), 
// getIndex  = function ( context, selector ) {
//     for ( var i = 0, len = context.length; i < len; i++ ) {
//         if ( $(context[i]).filter(selector).length ) {
//             return i;
//         }
//     }
// };

$('.outerInFoc input').click(function (e) {
    // Prevent any action on the window location
    e.preventDefault();
    $(this).siblings('.hiddenul').toggle();
    // Cache useful selectors
    $li = $(this);
    $input = $li.parent("ul").prev("input");
    // Update input text with selected entry
    if (!$li.is(".no-matches")) {
        $input.val($li.text());
    }
});

/*the autocomplete function takes two arguments,
 the text field element and an array of possible autocompleted values:*/
var currentFocus = 1;

/*execute a function presses a key on the keyboard:*/
$('.outerInFoc input').on("keyup", function (e) {
    var $input = $(this);
    var $dropdown = $input.siblings('ul.hiddenul');
    var name = $(this).attr("name");
    var formName = $(this).closest('form').attr('name');
    var x = $input.siblings('ul.hiddenul');
    if (x) x = x[0].getElementsByTagName('li');
    //console.log(x);
    if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
    } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
    } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
        }
    }


    //console.log(formName);
    // Create the no matches entry if it does not exists yet
    if (!$dropdown.data("containsNoMatchesEntry")) {

        // $("input.inputF + ul.hiddenul").append('<li class="hidden_li .no-matches hidden">No matches</li>');
        // $("input.inputF").val('');
        //var validator = $('#CustomTypeForm').validate();
        // if($input.val() === "") {
        //     $dropdown.find("li.no-matches").empty();
        // }

        // $("input.inputF + ul.hiddenul").append('<li class="no-matches hidden"><a>No matches</a></li>');
        $dropdown.data("containsNoMatchesEntry", true);

        var validation = {
            rules: {},
            messages: {}
        } // fill in normal rules if there are any.
        validation.rules[name] = {
            required: true
        };
        validation.messages[name] = "No suggestions found";
        // console.log(formName);
        $('form').validate(validation);
        // $('.outerInFoc input').on("keyup", function () {
        // });
        // $('#hk_submit').attr('disabled','');
        // alert("hi");
        $input.siblings('ul.hiddenul').addClass('no-matches-li');
    }


    // Show only matching values
    $dropdown.find("li:not(.no-matches)").each(function (key, li) {
        var $li = $(li);


        // var $li = $("input.inputF");
        // console.log("li", $li);
        // $li[new RegExp($input.val(), "i").exec($li.text()) ? "removeClass" : "addClass"]("hidden");
        // console.log("hi", $li);
        // $li[new RegExp($input.val(), "i").exec($li.text()) ? "" : "remove"]();
        $li[new RegExp($input.val(), "i").exec($li.text()) ? "removeClass" : "addClass"]("hidden");
        // if ($input.val() == $li.text()) {
        // $input.on("keyup", function (e) {
        //     // if (e.keyCode == 13 || e.keyCode == 9) {
        //     // $input.val('');
        //     // }
        // });
        // }
    });

    /* $drxopdown.find("li.active:first-child").each(function (key, li) {
        var $li = $(li);
        // $li[new RegExp($input.val(), "i").exec($li.text()) ? "removeClass" : ""]("current");
        $li[new RegExp($input.val(), "i").exec($li.text()) ? "addClass" : "removeClass"]("current");
    }); */

    // Show a specific entry if we have no matches
    //$dropdown.find("li.no-matches")[$dropdown.find("li:not(.no-matches):not(.hidden)").length > 0 ? "addClass" : "removeClass"]("hidden");
    // if (!$dropdown.data("containsNoMatchesEntry")) {
    //     // $("input.inputF + ul.hiddenul").append('<li class="hidden_li .no-matches hidden">No matches</li>');
    //     $("input.inputF").val('');
    //     $dropdown.data("containsNoMatchesEntry", true);
    //     // $input.val('');
    //     alert($input.val());

    // }

    // Show a specific entry if we have no matches
    // $dropdown.find("li.no-matches")[$dropdown.find("li:not(.no-matches):not(.hidden)").length > 0 ? "addClass" : "removeClass"]("hidden");

    // console.log("li length", ($input.val() == $li.text()).length);
});

$('.outerInFoc input').focus(function (event) {
    // Cache useful selectors
    var $input = $(this);
    var $dropdown = $input.siblings('ul.hiddenul');
    // Create the no matches entry if it does not exists yet
    /* if (!$dropdown.data("containsNoMatchesEntry")) {
        $("input.inputF + ul.hiddenul").append('<li class="hidden_li .no-matches hidden">No matches</li>');
        $dropdown.data("containsNoMatchesEntry", true);
    } */

    // Show only matching values
    $dropdown.find("li:not(.no-matches)").each(function (key, li) {
        var $li = $(li);
        $li[new RegExp($input.val(), "i").exec($li.text()) ? "removeClass" : "addClass"]("hidden");
    });

    // if (!$dropdown.data("containsNoMatchesEntry")) {
    //     // $("input.inputF + ul.hiddenul").append('<li class="hidden_li .no-matches hidden">No matches</li>');
    //     $("input.inputF").val('');
    //     $dropdown.data("containsNoMatchesEntry", true);

    //     // $input.val('');
    //     alert($input.val());

    // }
    // Show a specific entry if we have no matches
    //$dropdown.find("li.no-matches")[$dropdown.find("li:not(.no-matches):not(.hidden)").length > 0 ? "addClass" : "removeClass"]("hidden");
});




$('.outerInFoc li').click(function () {
    var dd = $(this).text();
    var dval = $(this).attr('data-val');
    // console.log(dval);
    $(this).parent('ul').hide();
    $(this).parent().siblings('.inputF').val(dd).focus();
    $(this).parent().siblings('.inputH').val(dval).focus();
    //$(this).parent().siblings('.inputF').parent().parent().next().click();
});

// $('.active .hiddenul li').bind('keydown', function(e){
//     var next, current;

//     if ( [40, 38].indexOf(e.which) > -1 && 
//           $li.filter('.selected').length ) {

//       current = getIndex( $li, '.selected');

//       if ( e.which === 38 ) {

//         next = ( ( (current - 1) < 0 ) && 
//                   $li.length - 1 ) || current -1;

//       }

//       if ( e.which === 40 ) {

//         next = ( ( current === $li.length ) && 
//                 current - $li.length ) || current +1;

//         if ( next === $li.length ) {
//           next = 0;
//         }
//       }

//       $( $li[next] ).trigger('click');
//     }
// });



$('.outerclick').click(function (e) {
    $('.hiddenul').hide();
    closeAllLists(e.target);
});

function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    // x[currentFocus].classList.add("autocomplete-active");
    x[currentFocus].classList[0] == "hidden" ? "" : x[currentFocus].classList.add("autocomplete-active");
    // x[currentFocus].classList
}

function removeActive(x) {
    //console.log(x);
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
    }
}

function closeAllLists(elmnt, inp) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var $input = $('.outerInFoc input');
    var x = $input.siblings('ul.hiddenul');
    if (x) x = x[0].getElementsByTagName('li');
    removeActive(x);
}



//Dynamic Code Parag
// $(document).on("focus keyup", "input.inputF", function() { 
//     // Cache useful selectors
//     var $input = $(this);
//     var $dropdown = $input.next("ul.hiddenul");

//     // Create the no matches entry if it does not exists yet
//     if (!$dropdown.data("containsNoMatchesEntry")) {
//         $("input.inputF + ul.hiddenul").append('<li class="no-matches hidden"><a>No matches</a></li>');
//         $dropdown.data("containsNoMatchesEntry", true);
//     }

//     // Show only matching values
//     $dropdown.find("li:not(.no-matches)").each(function(key, li) {
//         var $li = $(li);
//         $li[new RegExp($input.val(), "i").exec($li.text()) ? "removeClass" : "addClass"]("hidden");
//     });

//     // Show a specific entry if we have no matches
//     $dropdown.find("li.no-matches")[$dropdown.find("li:not(.no-matches):not(.hidden)").length > 0 ? "addClass" : "removeClass"]("hidden");
// });
// $(document).on("click", "input.inputF + ul.hiddenul li", function(e) {
//     // Prevent any action on the window location
//     e.preventDefault();

//     // Cache useful selectors
//     $li = $(this);
//     $input = $li.parent("ul").prev("input");

//     // Update input text with selected entry
//     if (!$li.is(".no-matches")) {
//         $input.val($li.text());
//     }
// });

function moveNext(e) {
    // $(e).parent().parent().next().click();
    $(e).parent().parent().nextAll('div:visible').first().click();
}

// window.onunload = window.onbeforeunload = function (){
//     window.alert('My Window is closing');
// };