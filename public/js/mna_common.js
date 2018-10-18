$(function () {
  console.log("ready!");
  $('.flight2_div').hide();
  $('.flight2_div_lng').hide();
  $(".mna_child_age").hide();
  $(".cityDivHideShow").hide(); //RCAS-2
  $(".countryDivHideShow").hide(); //RCAS-2
  $(".countryDivHideShowLounge").hide(); //RCAS-2
  $(".cityDivHideShowLounge").hide(); //RCAS-2
  $(".countryDivHideShowLoungeTwo").hide(); //RCAS-2
  $(".cityDivHideShowLoungeTwo").hide(); //RCAS-2
  $(".countryDivHideShowTwo").hide(); //RCAS-2
  $(".cityDivHideShowTwo").hide(); //RCAS-2


  //RCAS-2 START

  // Get all city from pricing master.
  $.ajax({
    type: "GET",
    url: "get_all_country",
    success: function (response) {

      $('#dropdownCountry').find('option').remove();
      $('#dropdownCountryTwo').find('option').remove();


      for (i = 0; i < response.length; i++) {
        $('#dropdownCountry').append($("<option></option>").attr("value", response[i].country_code).text(response[i].country));
        $('#dropdownCountryTwo').append($("<option></option>").attr("value", response[i].country_code).text(response[i].country));
      }

      $("#dropdownCountry").trigger("change");
      $("#dropdownCountryTwo").trigger("change");
    }
  });


  $.ajax({
    type: "GET",
    url: "get_all_country_for_lounge",
    success: function (response) {


      $('#dropdownCountryLounge').find('option').remove();
      $('#dropdownCountryLoungeTwo').find('option').remove();

      for (i = 0; i < response.length; i++) {
        $('#dropdownCountryLounge').append($("<option></option>").attr("value", response[i].country_code).text(response[i].country));
        $('#dropdownCountryLoungeTwo').append($("<option></option>").attr("value", response[i].country_code).text(response[i].country));
      }

      $("#dropdownCountryLounge").trigger("change");
      $("#dropdownCountryLoungeTwo").trigger("change");
    }
  });



  $('#dropdownCountry').change(function () {

    countryCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_cities_by_country_code/" + countryCode,
      success: function (response) {

        $('#dropdownCity').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownCity').append($("<option></option>").attr("value", response[i].city).text(response[i].city));
        }
        $("#dropdownCity").trigger("change");
      }
    });

  });

  $('#dropdownCity').change(function () {

    cityCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_airports_by_city/" + cityCode,
      success: function (response) {

        $('#dropdownAirport').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownAirport').append($("<option></option>").attr("value", response[i].airport).text(response[i].airport_code + "-" + response[i].airport));
        }
      }
    });

  });





  $('#dropdownCountryTwo').change(function () {

    countryCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_cities_by_country_code/" + countryCode,
      success: function (response) {

        $('#dropdownCityTwo').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownCityTwo').append($("<option></option>").attr("value", response[i].city).text(response[i].city));
        }
      }
    });

  });

  $('#dropdownCountryLounge').change(function () {

    countryCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_cities_by_country_code/" + countryCode,
      success: function (response) {

        $('#dropdownCityLounge').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownCityLounge').append($("<option></option>").attr("value", response[i].city).text(response[i].city));
        }
        $("#dropdownCityLounge").trigger("change");
      }
    });

  });


  $('#dropdownCityLounge').change(function () {

    cityCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_airports_by_city/" + cityCode,
      success: function (response) {

        $('#dropdownAirportLounge').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownAirportLounge').append($("<option></option>").attr("value", response[i].airport).text(response[i].airport_code + "-" + response[i].airport));
        }
      }
    });

  });






  $('#dropdownCountryLoungeTwo').change(function () {

    countryCode = $(this).val();

    $.ajax({
      type: "GET",
      url: "get_all_cities_by_country_code/" + countryCode,
      success: function (response) {

        $('#dropdownCityLoungeTwo').find('option').remove();
        for (i = 0; i < response.length; i++) {
          $('#dropdownCityLoungeTwo').append($("<option></option>").attr("value", response[i].city).text(response[i].city));
        }
      }
    });

  });


  //RCAS-2 END

  //alert("hello");

  $('#Transit').change(function () {
    var ischedked = $(this).is(":checked");
    if (ischedked) {
      //alert("hello "+$('#Transit').val());
      $('.flight2_div').show();
    } else {
      $('.flight2_div').hide();
    }
  });

  $('#transit_lounge').change(function () {
    var ischedked = $(this).is(":checked");
    if (ischedked) {
      //alert("hello "+$('#Transit').val());
      $('.flight2_div_lng').show();
    } else {
      $('.flight2_div_lng').hide();
    }
  });

  $('.mna_service_btn').on('click', function () { //alert('btn clicked');
    var service_id = parseInt($(this).attr('id'));
    $.ajax({
      type: "GET",
      url: "ajaxAddService/" + service_id,
      success: function (response) {
        $("#mna_selected_service").append(response);

        console.log(response);
      }
    });
  });

  $('.lounge_service_btn').on('click', function () { //alert('btn clicked');
    var service_id = parseInt($(this).attr('id'));
    $.ajax({
      type: "GET",
      url: "ajaxAddService/" + service_id,
      success: function (response) {
        $("#lounge_selected_service").html(response);
        console.log(response);
      }
    });
  });

  $(".datepicker_mna,.datepicker_mna2,.datepicker_lounge,.datepicker_lounge2").flatpickr({
    altInput: true,
    allowInput: true,
    altFormat: "j F, Y",
    dateFormat: "Y-m-d",
    disableMobile: "true",
    minDate: new Date().fp_incr(1),
    maxDate: new Date().fp_incr(120),
    enableTime: false
  });

  $('#mna_child_passengers').change(function () {
    $(".mna_child_age").empty();
    $(".lounge_child_age").empty();
    if ($('#mna_child_passengers').val() > 0) {
      $(".mna_child_age").show();
      var kids = $('#mna_child_passengers').val();
      //alert(kids);
      for (i = 1; i <= kids; i++) {
        var ageDiv = '<div class="__super_select __full">' +
          '<label class="label">Age of Child ' + i + ':</label>' +
          '<div class="__select_input"><select type="text" id="mna_child_age_id_' + i + '" name="children_age[]" required>' +
          '<option value="">Select child age</option><option value="0">0 Yr</option><option value="1">1 Yr</option><option value="2">2 Yrs</option><option value="3">3 Yrs</option><option value="4">4 Yrs</option><option value="5">5 Yrs</option><option value="6">6 Yrs</option><option value="7">7 Yr</option><option value="8">8 Yr</option><option value="9">9 Yrs</option><option value="10">10 Yrs</option><option value="11">11 Yrs</option><option value="12">12 Yrs</option><option value="13">13 Yrs</option><option value="14">14 Yrs</option><option value="15">15 Yrs</option><option value="16">16 Yr</option><option value="17">17 Yr</option><option value="18">18 Yrs</option></select></div>' +
          '&#9662;' +
          '<br />';
        $('.mna_child_age').append(ageDiv);
      }
    } else {
      $(".mna_child_age").empty();
      $(".mna_child_age").hide();
    }
  });

  $('#lounge_child_passengers').change(function () {
    $(".lounge_child_age").empty();
    $(".mna_child_age").empty();
    if ($('#lounge_child_passengers').val() > 0) {
      $(".lounge_child_age").show();
      var kids = $('#lounge_child_passengers').val();
      //alert(kids);
      for (i = 1; i <= kids; i++) {
        var ageDiv = '<div class="__super_select __full">' +
          '<label class="label">Age of Child ' + i + ':</label>' +
          '<div class="__select_input"><select type="text" id="lounge_child_age_id_' + i + '" name="children_age[]" required>' +
          '<option value="">Select child age</option><option value="0">0 Yr</option><option value="1">1 Yr</option><option value="2">2 Yrs</option><option value="3">3 Yrs</option><option value="4">4 Yrs</option><option value="5">5 Yrs</option><option value="6">6 Yrs</option><option value="7">7 Yr</option><option value="8">8 Yr</option><option value="9">9 Yrs</option><option value="10">10 Yrs</option><option value="11">11 Yrs</option><option value="12">12 Yrs</option><option value="13">13 Yrs</option><option value="14">14 Yrs</option><option value="15">15 Yrs</option><option value="16">16 Yr</option><option value="17">17 Yr</option><option value="18">18 Yrs</option></select></div>' +
          '&#9662;' +
          '<br />';
        $('.lounge_child_age').append(ageDiv);
      }
    } else {
      $(".lounge_child_age").empty();
      $(".lounge_child_age").hide();
    }
  });



  /*$("").flatpickr({
      altInput: true,
      allowInput:true,
      altFormat: "j F, Y",
      dateFormat: "Y-m-d",
      minDate: new Date().fp_incr(1),
      maxDate: new Date().fp_incr(120),
      enableTime: false
  });

  $("").flatpickr({
      altInput: true,
      allowInput:true,
      altFormat: "j F, Y",
      dateFormat: "Y-m-d",
      minDate: new Date().fp_incr(1),
      maxDate: new Date().fp_incr(120),
      enableTime: false
  });
  $("").flatpickr({
      altInput: true,
      allowInput:true,
      altFormat: "j F, Y",
      dateFormat: "Y-m-d",
      minDate: new Date().fp_incr(1),
      maxDate: new Date().fp_incr(120),
      enableTime: false
  });*/

  //Parag Code
  $('#Transit').on('click', function () {
    if ($(this).prop("checked") == true) {
      $('#departure').attr('disabled', '');
      $('#Arrival').attr('disabled', '');
    } else {
      $('#departure').removeAttr('disabled');
      $('#Arrival').removeAttr('disabled');
    }
  });

  $('#departure').on('click', function () {
    if ($(this).prop("checked") == true) {
      $('#Transit').attr('disabled', '');
      $('#Arrival').attr('disabled', '');
    } else {
      $('#Transit').removeAttr('disabled');
      $('#Arrival').removeAttr('disabled');
    }
  });

  $('#Arrival').on('click', function () {
    if ($(this).prop("checked") == true) {
      $('#Transit').attr('disabled', '');
      $('#departure').attr('disabled', '');
    } else {
      $('#Transit').removeAttr('disabled');
      $('#departure').removeAttr('disabled');
    }
  });

  $('#transit_lounge').on('click', function () {
    if ($(this).prop("checked") == true) {
      $('#departure_lounge').attr('disabled', '');
    } else {
      $('#departure_lounge').removeAttr('disabled');
    }
  });

  $('#departure_lounge').on('click', function () {
    if ($(this).prop("checked") == true) {
      $('#transit_lounge').attr('disabled', '');
    } else {
      $('#transit_lounge').removeAttr('disabled');
    }
  });

  $("#meetAndAssistForm").validate({
    errorPlacement: function (error, element) {
      if (element.attr("name") == "mna_departure")
        error.insertAfter($('#departure').parent().closest('div'));
      else if (element.attr("name") == "al_code")
        error.insertAfter("#al_code");
      else if (element.attr("name") == "mna_travel_date")
        error.insertAfter(".datepicker_mna");
      else
        error.insertAfter(element);
    },
    rules: {
      mna_departure: {
        required: true,
      },
      al_code: {
        required: true,
      },
      mna_travel_date: {
        required: true,
      },
      dropdownCity: {
        required: true,
      },
      dropdownCountry: {
        required: true,
      },
      "children_age[]": "required"
    },
    messages: {
      mna_departure: "Select Service Type",
      al_code: "Enter Flight Code",
      mna_travel_date: "Select Travel Date",
      "children_age[]": "Select child age",
    },
  });

  $("#loungeForm").validate({
    errorPlacement: function (error, element) {
      if (element.attr("name") == "lounge_departure")
        error.insertAfter($('#departure_lounge').parent().closest('div'));
      else if (element.attr("name") == "al_code_lng")
        error.insertAfter("#al_code_lng");
      else if (element.attr("name") == "lounge_travel_date")
        error.insertAfter(".datepicker_lounge");
      else
        error.insertAfter(element);
    },
    rules: {
      lounge_departure: {
        required: true,
      },
      al_code_lng: {
        required: true,
      },
      lounge_travel_date: {
        required: true,
      },
      dropdownCityLounge: {
        required: true,
      },
      dropdownCountryLounge: {
        required: true,
      },
      "children_age[]": "required"
    },
    messages: {
      lounge_departure: "Select Service Type",
      al_code_lng: "Enter Flight Code",
      lounge_travel_date: "Select Travel Date",
      "children_age[]": "Select child age",
    },
  });


  /*$('.proceed_payment_btn').prop('disabled', true);
      var ischedked = $(this).is(":checked");
      if (ischedked) {
          //alert("hello "+$('#Transit').val());
          $('.proceed_payment_btn').removeAttr('disabled');
      } else {
          $('.proceed_payment_btn').attr('disabled','disabled');
      }
  });*/


  // $('input[type=checkbox]').click(function () {
  //   var chks = document.getElementById('meetAndAssistForm').getElementsByTagName(
  //     'INPUT');
  //   for (i = 0; i < chks.length; i++) {
  //     chks[i].checked = false;
  //   }
  //   if (chks.length > 1)
  //     $(this)[0].checked = true;
  // });

  // $('input[type=checkbox]').click(function () {
  //   var chks = document.getElementById('loungeForm').getElementsByTagName(
  //     'INPUT');
  //   for (i = 0; i < chks.length; i++) {
  //     chks[i].checked = false;
  //   }
  //   if (chks.length > 1)
  //     $(this)[0].checked = true;
  // });



  $("#loungeForm").submit(function (e) {
    if ($('input[name=lounge_travel_date]').val() == "") {
      $(this).after("<label id='lounge_travel_date-error' class='error' for='lounge_travel_date'>Select Travel Date</label>");
      e.preventDefault();
    }
  });

  $('#btn_send_otp1').on('click', function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/rca_website_l/public/evisa/ajaxsendotp",
      type: "POST",
      dataType: "json",
      data: {
        email_id: $('input[name="email_id"').val(),
        username: $('input[name="user_name"]').val()
      },
      success: function (response) {
        if (response.status == "success") {
          $('#message-box').css('color', 'green');
          $('#message-box').html(response.msg);
          $('#btn_send_otp').attr('disabled', '');
          $('#btn_confirm').removeAttr('disabled');
          $('#terms').attr('onchange', "activateButton(this)");
        }
      }
    });
  });

  $('.al_code').on('keypress change', function () {
    $(this).val(function (index, value) {
      return value.replace(/\W/gi, '').replace(/(.{2})/, '$1 ');
    });
  });


  //RCAS-2 START
  $("#dropdownFlightOrCity").change(function () {

    if (this.value == "flight") {

      $('.flight_number_hide_show').show();
      $(".cityDivHideShow").hide();
      $(".countryDivHideShow").hide();
      $("#dropdownCountry").attr("required", false); //Solution for An invalid form control with name='dropdownCountry' is not focusable.
      $("#dropdownCity").attr("required", false); //Solution for An invalid form control with name='dropdownCity' is not focusable.
      $("#al_code").attr("required", true); //Solution for An invalid form control with name='al_code' is not focusable.
      $("#dropdownAirport").attr("required", false); //Solution for An invalid form control with name='dropdownAirport' is not focusable.  



    } else if (this.value == "city") {

      $('.flight_number_hide_show').hide();
      $(".cityDivHideShow").show();
      $(".countryDivHideShow").show();
      $("#dropdownCountry").attr("required", true); //Solution for An invalid form control with name='dropdownCountry' is not focusable.
      $("#dropdownCity").attr("required", true); //Solution for An invalid form control with name='dropdownCity' is not focusable.
      $("#al_code").attr("required", false); //Solution for An invalid form control with name='al_code' is not focusable.
      $("#dropdownAirport").attr("required", true); //Solution for An invalid form control with name='dropdownAirport' is not focusable.
    }


  });


  $("#dropdownFlightOrCityLounge").change(function () {

    if (this.value == "flight") {

      $('.flight_number_hide_show_lounge').show();
      $(".cityDivHideShowLounge").hide();
      $(".countryDivHideShowLounge").hide();
      $("#dropdownCountryLounge").attr("required", false); //Solution for An invalid form control with name='dropdownCountryLounge' is not focusable.
      $("#dropdownCityLounge").attr("required", false); //Solution for An invalid form control with name='dropdownCityLounge' is not focusable.
      $("#al_code_lng").attr("required", true); //Solution for An invalid form control with name='al_code_lng' is not focusable.
      $("#dropdownAirportLounge").attr("required", false); //Solution for An invalid form control with name='dropdownAirportLounge' is not focusable.        



    } else if (this.value == "city") {

      $('.flight_number_hide_show_lounge').hide();
      $(".cityDivHideShowLounge").show();
      $(".countryDivHideShowLounge").show();
      $("#dropdownCountryLounge").attr("required", true); //Solution for An invalid form control with name='dropdownCountryLounge' is not focusable.
      $("#dropdownCityLounge").attr("required", true); //Solution for An invalid form control with name='dropdownCityLounge' is not focusable.
      $("#al_code_lng").attr("required", false); //Solution for An invalid form control with name='al_code_lng' is not focusable.
      $("#dropdownAirportLounge").attr("required", true); //Solution for An invalid form control with name='dropdownAirportLounge' is not focusable.        
    }

  });

  //RCAS-2 END

});


//RCAV1-56 START
$('.same_ticket_mna').on('click', function () {

  var total_number_of_passengers = $('input[name^="ticket_"]').length;

  if ($(this).prop("checked") == true) {

    for (var i = 2; i <= total_number_of_passengers; i++) {
      $('input[name^="ticket_' + i + '"]').attr("required", false);
    }

  } else {

    for (var i = 2; i <= total_number_of_passengers; i++) {
      $('input[name^="ticket_' + i + '"]').attr("required", true);
    }
  }
});


$('.same_ticket_lounge').on('click', function () {

  var total_number_of_passengers = $('input[name^="ticket_"]').length;

  if ($(this).prop("checked") == true) {

    for (var i = 2; i <= total_number_of_passengers; i++) {
      $('input[name^="ticket_' + i + '"]').attr("required", false);
    }

  } else {

    for (var i = 2; i <= total_number_of_passengers; i++) {
      $('input[name^="ticket_' + i + '"]').attr("required", true);
    }
  }
});

//RCAV1-56 END

//RCAV1-51 - START
$('#e_visa_tab').on('click', function () {
  $("#evisaForm")[0].reset();
});

$('#mna_tab').on('click', function () {
  $("#meetAndAssistForm")[0].reset();
});

$('#lounge_tab').on('click', function () {
  $("#loungeForm")[0].reset();
});


$('#group_size_max_mna').on('click', function () {
  localStorage.setItem("active_tab", "group_size_max_mna");
});

$('#group_size_max_lounge').on('click', function () {
  localStorage.setItem("active_tab", "group_size_max_lounge");
});
//RCAV1-51 - END


//RCAV1-53 - START
$('#group_size_max_mna_error').on('click', function () {
  localStorage.setItem("active_tab", "group_size_max_mna");
});


$('#group_size_max_lounge_error').on('click', function () {
  localStorage.setItem("active_tab", "group_size_max_lounge");
});
//RCAV1-53 - END