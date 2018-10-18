// $.each($('input,textarea,select', "#CustomTypeForm").serializeArray(), function() {
//     eventName = $(this).is('button,:submit') ? 'click' : 'change';
//     $(this).bind(eventName, function (e) {
//                 eventName == 'click' ? e.preventDefault() : false;
//                 $.fn.autosave._makeRequest(e, nodes, options, this);
//     });
// });
var form_id = document.currentScript.getAttribute('form-id');
var ajax_url = document.currentScript.getAttribute('ajax-url');

setTimeout("autosave('#"+form_id+"')", 30000); // set timer to run every 60 seconds

function autosave(formid) {
        // if (typeof t!="undefined") {clearTimeout(t);} // reset timer
        var data = new Object();
        var form = $(formid);
        var formData = new FormData();
        var formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
          $.each($(tag)[0].files, function(i, file) {
            formData.append(tag.name, file);
          });
        });

        $.each(formParams, function(i, val) {
          if(val.value !== ""){
            formData.append(val.name, val.value);   
          }
        });
        
        // setTimeout("autosave('"+formid+"')", 30000);

        $.ajax(
        {
            type: "POST",
            url: '/rca_website_l/public/'+ajax_url,
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType:"json",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            success: function(response)
            {
                //alert(message); // for testing purposes
                setTimeout("autosave('"+formid+"')", 30000);
                // console.log(response);return false;
                if(response.status=="success"){
                    //setTimeout("autosave('"+formid+"')", 30000);
                    $('#save_form_msg').html(response.msg).fadeIn('slow');
                    $('#save_form_msg').delay(10000).fadeOut('slow');
                } else if(response.status=="failed") {
                    //setTimeout("autosave('"+formid+"')", 30000);
                    $('#save_form_msg').html(response.msg).fadeIn('slow');
                    $('#save_form_msg').delay(10000).fadeOut('slow');
                }
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