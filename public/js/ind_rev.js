$(document).ready(function () {

	if ($("input[name='prev_org']:checked").val() == 'Y') {
		$('.prev_org_div').show()
	} else {
		$('.prev_org_div').hide()
	}

	if ($("input[name='oth_ppt']:checked").val() == 'Y') {
		$('#prev_passport_country_issue').show();
		$('#other_ppt_no').show();
		$('#other_ppt_issue_place').show();
		$('#other_ppt_date_issue').show();
		$('#other_ppt_nationality').show();
	} else {
		$('#prev_passport_country_issue').hide();
		$('#other_ppt_no').hide();
		$('#other_ppt_issue_place').hide();
		$('#other_ppt_date_issue').hide();
		$('#other_ppt_nationality').hide();
	}

	if ($("input[name='grandparent_flag1']:checked").val() == 'Y') {
		$('#grandparent_details').show();
	} else {
		$('#grandparent_details').hide();
	}

	if ($("input[name='old_visa_flag']:checked").val() == 'Y') {
		$('.pre_visit_div').show();
	} else {
		$('.pre_visit_div').hide();
	}

	if ($("input[name='refuse_flag']:checked").val() == 'Y') {
		$('#refuse_flag_div').show();
	} else {
		$('#refuse_flag_div').hide();
	}

	$('#frmreviewind #previous_surname').addClass('divhide');
	$('#frmreviewind #previous_name').addClass('divhide');

	// if ($("#frmreviewind input[name='name_changed']:checked").val() == 'Y') {
	// 	$('#frmreviewind #previous_surname').show();
	// 	$('#frmreviewind #previous_name').show();
	// } else {
	// 	$('#frmreviewind #previous_surname').hide();
	// 	$('#frmreviewind #previous_name').hide();
	// }

	if ($("input[name='saarc_flag']:checked").val() == 'Y') {
		$('#saarc_form_div').show()
	} else {
		$('#saarc_form_div').hide()
	}
});