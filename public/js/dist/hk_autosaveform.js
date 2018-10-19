// $.each($('input,textarea,select', "#CustomTypeForm").serializeArray(), function() {
//     eventName = $(this).is('button,:submit') ? 'click' : 'change';
//     $(this).bind(eventName, function (e) {
//                 eventName == 'click' ? e.preventDefault() : false;
//                 $.fn.autosave._makeRequest(e, nodes, options, this);
//     });
// });
setTimeout('autosave("#CustomTypeForm")', 30000); // set timer to run every 60 seconds

function autosave(formid) {
        // if (typeof t!="undefined") {clearTimeout(t);} // reset timer
        var data = new Object();
        var interests = new Object();
        var interestscount = 0;
        // $('input,textarea,select', formid).each(function(index) {
        //     if ($(this).is(':submit')){
        //         // ignore submit buttons
        //     } else {
        //         if($(this).val()!==""){                 
        //             if ($(this).is(':checkbox')){
        //                 if ($(this).attr('checked')){
        //                     data[$(this).attr('name')] = $(this).val();
        //                 } else {
        //                     data[$(this).attr('name')] = '0';
        //                 }
        //             } else {
        //                 if ($(this).attr('name') == 'interests[]'){ // if input is an array
        //                     interests[interestscount] = $(this).val();
        //                     interestscount = interestscount + 1;
        //                 } else { // if normal input
        //                     data[$(this).attr('name')] = $(this).val();
        //                 }
        //             }   
        //         }
        //     }
        //     data['interests'] = interests;
        // });

        $.each($('input,textarea,select', formid).serializeArray(), function() {
            if(this.value !== ""){
                data[this.name] = this.value;
            }
        });

        // console.log(data);return false;
        // $('#save_form_msg').delay(10000).fadeOut('slow'); 

        $.ajax(
        {
            type: "POST",
            url: "/rca_website_l/public/ajaxautosavedata",
            data: data,
            cache: false,
            // beforeSend: function() {
            //     setTimeout("autosave('"+formid+"')", 30000);
            //     $('#save_form_msg').html("Saving...").fadeIn('slow');
            //     $('#save_form_msg').delay(10000).fadeOut('slow');               
            // },
            success: function(response)
            {
                // console.log(response);
                // if (message == '1'){ // show success saved
                //     t = setTimeout("autosave()", 10000); // set timer for next autosave
                // } else if (message == '2'){ // show error
                //     var answer = confirm("Your session has timed out. Please login again to continue")
                //     // if (answer){
                //     //     window.location.href = "/signin";
                //     // }
                // } else { // an error has occured
                //     t = setTimeout("autosave()", 120000); // set the time for a larger amount
                // }
                //alert(message); // for testing purposes
                setTimeout("autosave('"+formid+"')", 30000);

                // setTimeout(function(){
                //     $('#save_form_msg').show();
                //     $('#save_form_msg').html("Saved...");
                // }, 10000);

                $('#save_form_msg').html("Saving...").fadeIn('slow');
                $('#save_form_msg').delay(10000).fadeOut('slow');

                // if(response.status=="success"){
                //     setTimeout("autosave('"+formid+"')", 30000);
                //     // $('#save_form_msg').show();
                //     // $('#save_form_msg').html(response.msg);
                // } else {
                //     setTimeout("autosave('"+formid+"')", 120000);
                // }
            },
            error: function(xhr) { // if error occured
                //alert("Error occured.please try again");
                // $('#save_form_msg').show();
                // $('#save_form_msg').html(xhr.statusText + xhr.responseText);
            },
            complete: function() {
                // $('#save_form_msg').show();
                // $('#save_form_msg').html("");
            },
        });
}