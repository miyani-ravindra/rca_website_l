@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
<div class="__bg">
   <div class="container container-sm">
      <div class="row">
         <div class="col-md-12">
            <div class="paddingtb_50">
               <form method="post" action="" id="frmreviewind" name="frmreviewind" enctype='multipart/form-data'>
                  <ul class="tabs_z">
                     <li class="__current">
                        <span class="__title">eVisa</span>
                        <img src="{{URL::to('/')}}/svg/E-visa.svg" alt="" width="100" />
                     </li>
                     <li>
                        <a href="{{URL::to('/')}}">
                        <span class="__title">AIRPORT MEET &amp; GREET</span>
                        <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" width="100" />
                        </a>
                     </li>
                     <li>
                        <a href="{{URL::to('/')}}">
                        <span class="__title">AIRPORT LOUNGE</span>
                        <img src="{{URL::to('/')}}/svg/LOUNGE.svg" alt="" width="100" />
                        </a>
                     </li>
                  </ul>
                  <div id="tab-1" class="tabs_z_content __current">
                     <div class="row">
                        <div class="col-md-12">
                           <h1 class="__main_heading">Indian eVisa</h1>
                           <div class="__hgk_rev_header">
                                <button type="button" class="__btn" id="btn_edit">EDIT</button>
                                <button type="submit" class="__btn __active" id="btn_confirm">CONFIRM</button>
                            </div>
                        </div>
                     </div>
                     <div class="__form_wrapper">
                        <div class="row">
                           <div class="col-md-12">
                              <h4 class="__stylish_head">Confirm Your Details</h4>
                           </div>
                           <div class="col-md-12">
                              <pre>{{$qry['order_code']}}</pre>
                           </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-12">
                                    <h3 class="__form_notes">Travel Details</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Service Type</label>
                                        <input type="text" name="name" value="{{$qry['product_name']}}" class="no_edit" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Nationality</label>
                                        <input type="text" name="citizen_to" value="{{$qry['citizen_to']}}"  class="no_edit"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Travelling to</label>
                                        <input type="text" name="name" value="{{$qry['travel_to']}}"  class="no_edit"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Email Address</label>
                                        <input type="text" name="email_id" value="{{$qry['email_id']}}"  class="no_edit"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Mobile No.</label>
                                        <input type="text" name="phone_number" value="{{$qry['mobile_number']}}"  class="no_edit"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Expected Arrival Date</label>
                                        <input type="text" name="name" value="{{$qry['arrival_date']}}" class="datepicker no_edit" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Port of  Arrival</label>
                                        <select id="airport_code" class="__select no_edit" name="airport_code" required="">
                                             @foreach($airport_arr as $key=>$val)
                                             <option value="{{$val['airport_id']}}" {{$qry['airport_id'] == $val['airport_id'] ? "selected" : ''}}>{{$val['airport_name']}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                	</div>
                                </div>
                                <div class="col-md-4">
                                	<div class="__select_box">
                                        <label>Port of Exit</label>
                                        <select id="airport_code" class="__select no_edit" name="pres_country" required="">
                                             @foreach($airport_arr as $key=>$val)
                                             <option value="{{$val['airport_id']}}" {{$qry['pres_country'] == $val['airport_id'] ? "selected" : ''}}>{{$val['airport_name']}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Visa Service</label>
                                        <input type="text" name="name" value="{{$qry['visa_service']}}" class="no_edit"/>
                                    </div>
                                </div>
                            </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-12">
                                    <p class="__form_notes">Applicant Details</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Given Name</label>
                                        <input type="text" name="given_name" value="{{$qry['username']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Surname</label>
                                        <input type="text" name="surname" value="{{$qry['surname']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>I have changed my name previously</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="name_changed">
	                                            <input type="radio" name="name_changed" id="name_changed_y" value="Y"  {{($qry['previous_surname'])!= ""? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="name_changed"> 
                                            	<input type="radio" name="name_changed" id="name_changed_n" value="N" {{($qry['previous_surname'])== ""? "checked" : "" }} >
                                                <span>NO</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4" id="previous_surname">
                                    <div class="__app_input">
                                        <label>Previous Surname</label>
                                        <input type="text" name="previous_surname" value="{{$qry['previous_surname']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4" id="previous_name">
                                    <div class="__app_input">
                                        <label>Previous Name</label>
                                        <input type="text" name="previous_name" value="{{$qry['previous_name']}}" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                	<div class="__select_box">
                                        <label>Gender</label>
                                        <select id="gender" class="__select" name="gender" required="" readonly> 
                                            <option value="M">MALE</option>
                                            <option value="F">FEMALE</option>
                                            <option value="T">TRANSGENDER</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Date of Birth</label>
                                        <input type="text" name="dob" id="dob" value="{{$qry['dob']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Country of Birth</label>
                                        <select id="airport_code" class="__select" name="cob" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['country_of_birth'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Place of Birth</label>
                                        <input type="text" name="city_birth" value="{{$qry['place_of_birth']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>National ID</label>
                                        <input type="text" name="nation_id" value="{{$qry['citizenship_no']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Religion</label>
                                        <select id="" class="__select" name="religion" required="" readonly>
                                             @foreach($getreligion as $row)
                                             <option value="{{$row->religion_id}}" {{$qry['religion'] == $row->religion_id ? "selected" : ''}}>{{$row->religion_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Visible Identification Mark</label>
                                        <input type="text" name="visible_marks" value="{{$qry['visible_marks']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Educational Qualification</label>
                                        <select id="" class="__select" name="qualification" required="" readonly>
                                             @foreach($getqualification as $row)
                                             <option value="{{$row->id}}" {{$qry['qualification'] == $row->id ? "selected" : ''}}>{{$row->qualification}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Nationality</label>
                                        <select id="" class="__select" name="nationality" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                	<div class="__select_box">
                                        <label>Aquired By</label>
                                        <select id="aquired_nation" class="__select" name="aquired_nation" id="aquired_nation_r" required="" readonly> 
                                            <option>Select...</option>
                                            <option value="By Birth" {{$qry['aquired_nation'] == 'By Birth'? "selected" : ''}}>By Birth</option>
                                            <option value="Naturalization" {{$qry['aquired_nation'] == 'Naturalization'? "selected" : ''}}>Naturalization</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4" id="prev_nationality">
                                    <div class="__select_box">
                                        <label>Previous Nationality</label>
                                        <select id="" class="__select" name="prev_nationality" required="" readonly>
                                             <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['prev_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                        <div class="__review_radio">
                                            <p>Have you lived for at least two years in the country where you are applying visa?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="refer_flag">
	                                            <input type="radio" name="refer_flag" id="r1" value="Y"  {{($qry['refer_flag'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="refer_flag">
                                            	<input type="radio" name="refer_flag" id="r2" value="N" {{($qry['refer_flag'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="clearfix"></div>
                                <div class="__fm_box __app_form">
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Passport No</label>
                                        <input type="text" name="Passport_number" value="{{$qry['pp_no']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Passport Issue Place</label>
                                        <input type="text" name="issue_place" value="{{$qry['pp_place_of_issue']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Passport Issue Date</label>
                                        <input type="text" name="doi" value="{{$qry['pp_issue_date']}}" id="doi" class="datepicker" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Passport Expiry Date</label>
                                        <input type="text" name="doe" value="{{$qry['pp_expiry_date']}}" id="doe" class="datepicker" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Other Passport</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="oth_ppt">
	                                            <input type="radio" name="oth_ppt" id="" value="Y"  {{($qry['oth_ppt'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="oth_ppt">
                                            	<input type="radio" name="oth_ppt" id="" value="N" {{($qry['oth_ppt'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label></div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="prev_passport_country_issue">
                                    <div class="__select_box">
                                        <label>Country of Issue</label>
                                        <select id="" class="__select" name="prev_passport_country_issue" required="" readonly>
                                             <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['prev_passport_country_issue'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4" id="other_ppt_no">
                                    <div class="__app_input">
                                        <label>Passport/IC No.</label>
                                        <input type="text" name="other_ppt_no" value="{{$qry['other_ppt_no']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4" id="other_ppt_issue_place">
                                    <div class="__app_input">
                                        <label>Place of Issue</label>
                                        <input type="text" name="other_ppt_issue_place" value="{{$qry['other_ppt_issue_place']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4" id="other_ppt_date_issue">
                                    <div class="__app_input">
                                        <label>Date of Issue</label>
                                        <input type="text" name="other_ppt_issue_date" value="{{$qry['other_ppt_issue_date']}}" id="other_ppt_issue_date" class="datepicker" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4" id="other_ppt_nationality">
                                    <div class="__select_box">
                                        <label>Nationality mentioned therein</label>
                                        <select id="" class="__select" name="other_ppt_nationality" required="" readonly>
                                             <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['other_ppt_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-12">
                                    <p class="__form_notes">Address Details</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>House No./Street</label>
                                        <input type="text" name="pres_add1" value="{{$qry['pres_add1']}}" class="datepicker" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Village/Town/City</label>
                                        <input type="text" name="pres_add2" value="{{$qry['pres_add2']}}" class="datepicker" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Country</label>
                                        <select id="" class="__select" name="addr_country" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['addr_country'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>State/Province/District</label>
                                        <input type="text" name="state_name" value="{{$qry['state_name']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Postal/Zip Code</label>
                                        <input type="text" name="pincode" value="{{$qry['pincode']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone No</label>
                                        <input type="text" name="pres_phone" value="{{$qry['pres_phone']}}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="__form_notes">Permanent Address</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__review_radio">
                                        <p>Permanent Address is same as Present Address</p>
                                        <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="oth_ppt">
                                                <input type="radio" name="sameAddress_id" id="" value="Y"  {{$qry['pres_add1']==$qry['perm_address1'] && $qry['pres_add2']==$qry['perm_address2'] && $qry['state']==$qry['perm_address3']? "checked" : "" }}>
                                                <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="oth_ppt">
                                                <input type="radio" name="sameAddress_id" id="" value="N" {{$qry['pres_add1']!=$qry['perm_address1'] && $qry['pres_add2']!=$qry['perm_address2'] && $qry['state']!=$qry['perm_address3']? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>House No./Street</label>
                                        <input type="text" name="perm_address1" value="{{$qry['perm_address1']}}" class="datepicker" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Village/Town/City</label>
                                        <input type="text" name="perm_address2" value="{{$qry['perm_address2']}}" class="datepicker" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>State/Province/District</label>
                                        <input type="text" name="perm_address3" value="{{$qry['perm_address3']}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-12">
                                    <p class="__form_notes">Father's Details</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Father's Name</label>
                                        <input type="text" name="fthrname" value="{{$qry['father_name']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Nationality</label>
                                        <select id="" class="__select" name="father_nationality" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['father_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Previous Nationality</label>
                                        <select id="" class="__select" name="father_previous_nationality" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['father_previous_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Father's Place of Birth</label>
                                        <input type="text" name="father_place_of_birth" value="{{$qry['father_place_of_birth']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Country of Birth</label>
                                        <select id="" class="__select" name="father_country_of_birth" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['father_country_of_birth'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="__form_notes">Mother's Details</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Mother's Name</label>
                                        <input type="text" name="mother_name" value="{{$qry['mother_name']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Nationality</label>
                                        <select id="" class="__select" name="mother_nationality" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['mother_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Previous Nationality</label>
                                        <select id="" class="__select" name="mother_previous_nationality" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['mother_previous_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Mother's Place of Birth</label>
                                        <input type="text" name="mother_place_of_birth" value="{{$qry['mother_place_of_birth']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Country of Birth</label>
                                        <select id="" class="__select" name="mother_country_of_birth" required="" readonly>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['mother_country_of_birth'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Marital Status</label>
                                        <select id="" class="__select" name="mstatus" required="" readonly>
                                             @foreach($getmarital as $val)
                                             <option value="{{$val->marital_status_id}}" {{$qry['marital_status_id'] == $val->marital_status_id ? "selected" : ''}}>{{$val->marital_status_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="__form_notes">Spouse's Details</p>
                                </div>
                                <div class="col-md-4 spouse_div">
                                    <div class="__app_input">
                                        <label>Spouse's Name</label>
                                        <input type="text" name="spouse_name" value="{{$qry['spouse_name']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 spouse_div">
                                    <div class="__select_box">
                                        <label>Nationality</label>
                                        <select id="" class="__select" name="spouse_nationality" required="" readonly>
                                            <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['spouse_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 spouse_div">
                                    <div class="__select_box">
                                        <label>Previous Nationality</label>
                                        <select id="" class="__select" name="spouse_previous_nationality" required="" readonly>
                                            <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['spouse_previous_nationality'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 spouse_div">
                                    <div class="__app_input">
                                        <label>Spouse's Place of Birth</label>
                                        <input type="text" name="spouse_place_of_birth" value="{{$qry['spouse_place_of_birth']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 spouse_div">
                                    <div class="__select_box">
                                        <label>Country of Birth</label>
                                        <select id="" class="__select" name="spouse_country_of_birth" required="" readonly>
                                            <option></option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}" {{$qry['spouse_country_of_birth'] == $val->country_id ? "selected" : ''}}>{{$val->country_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Grandparents - Pakistan Nationals/ belong to pakistan held area?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="grandparent_flag1">
	                                            <input type="radio" name="grandparent_flag1" value="Y"  {{($qry['grandparent_flag1'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="grandparent_flag1">
                                            	<input type="radio" name="grandparent_flag1" value="N" {{($qry['grandparent_flag1'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div></div>
                                </div>
                                <div class="col-md-4" id="grandparent_details">
                                    <div class="__app_input">
                                        <label>Grandparents' Details</label>
                                        <input type="text" name="grandparent_details" value="{{$qry['grandparent_flag1']}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-12">
                                    <p class="__form_notes">Occupation Details</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Present Occupation</label>
                                        <select id="" class="__select" name="pre_occupation" required="" readonly>
                                             @foreach($getpropfession as $val)
                                             <option value="{{$val->id}}" {{$qry['pre_occupation'] == $val->id ? "selected" : ''}}>{{$val->occupation_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4" id="if_other">
                                    <div class="__app_input">
                                        <label>Occupation (If other)</label>
                                        <input type="text" name="if_prof_other" value="{{$qry['if_occ_other']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4" id="student_guardian">
                                    <div class="__select_box">
                                        <label>Specify below occupation details of</label>
                                        <select class="__select" name="occ_flag">
                                             <option value="">Select...</option>
                                             <option value="F">Father</option>
                                             <option value="S">Spouse</option>
                                          </select>
                                          <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Employer Name</label>
                                        <input type="text" name="empname" value="{{$qry['empname']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Designation</label>
                                        <input type="text" name="empdesignation" value="{{$qry['empdesignation']}}" />
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Employer Address</label>
                                        <input type="text" name="empaddress" value="{{$qry['empaddress']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone no.</label>
                                        <input type="text" name="empphone" value="{{$qry['empphone']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__select_box">
                                        <label>Passport Occupation(If Any)</label>
                                        <select id="" class="__select" name="occ_flag" required="" readonly>
                                             @foreach($getpropfession as $val)
                                             <option value="{{$val->id}}" {{$qry['previous_occupation'] == $val->id ? "selected" : ''}}>{{$val->occupation_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Are/were you in a Military/Semi-Military/Police/Security Organization?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="prev_org">
	                                            <input type="radio" name="prev_org" id="" value="Y"  {{($qry['prev_org'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="prev_org">
                                            	<input type="radio" name="prev_org" id="" value="N" {{($qry['prev_org'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 prev_org_div">
                                    <div class="__app_input">
                                        <label>Organisation</label>
                                        <input type="text" name="previous_organization" value="{{$qry['previous_organization']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 prev_org_div">
                                    <div class="__app_input">
                                        <label>Designation </label>
                                        <input type="text" name="previous_designation" value="{{$qry['previous_designation']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 prev_org_div">
                                    <div class="__app_input">
                                        <label>Rank </label>
                                        <input type="text" name="previous_rank" value="{{$qry['previous_rank']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 prev_org_div">
                                    <div class="__app_input">
                                        <label>Place of Posting </label>
                                        <input type="text" name="previous_posting" value="{{$qry['previous_posting']}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="__fm_box __app_form">
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Place to be Visited 1 </label>
                                        <input type="text" name="service_req_form_values" value="{{$qry['service_req_form_values']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Place to be Visited 2 </label>
                                        <input type="text" name="service_req_form_values2" value="{{$qry['service_req_form_values2']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Have you ever visited India before?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="old_visa_flag">
	                                            <input type="radio" name="old_visa_flag" id="" value="Y"  {{($qry['old_visa_flag'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="old_visa_flag"> 
                                            	<input type="radio" name="old_visa_flag" id="" value="N" {{($qry['old_visa_flag'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__app_input">
                                        <label>Address </label>
                                        <input type="text" name="prv_visit_add1" value="{{$qry['prv_visit_add1']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__app_input">
                                        <label>Cities previously visited in India </label>
                                        <input type="text" name="visited_city" value="{{$qry['visited_city']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__app_input">
                                        <label>Last Indian Visa No/Currently valid Indian Visa No.</label>
                                        <input type="text" name="old_visa_no" value="{{$qry['old_visa_no']}}" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__select_box">
                                        <label>Type of Visa</label>
                                        <select id="" class="__select" name="old_visa_type_id" required="" readonly>
                                             @foreach($getvisatypes as $val)
                                             <option value="{{$val->id}}" {{$qry['old_visa_type_id'] == $val->id ? "selected" : ''}}>{{$val->type_name}}</option>
                                             @endforeach
                                          </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__app_input">
                                        <label>Place of Issue</label>
                                        <input type="text" name="oldvisaissueplace" value="{{$qry['oldvisaissueplace']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 pre_visit_div">
                                    <div class="__app_input">
                                        <label>Date of Issue</label>
                                        <input type="text" name="oldvisaissuedate" value="{{$qry['oldvisaissuedate']}}" id="oldvisaissuedate" class="datepicker" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Has permission to visit or to extend stay in India previously been refused?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="refuse_flag">
	                                            <input type="radio" name="refuse_flag" id="" value="Y"  {{($qry['refuse_flag'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="refuse_flag">
                                            	<input type="radio" name="refuse_flag" id="" value="N" {{($qry['refuse_flag'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label></div>
                                        </div>
                                </div>
                                <div class="col-md-4" id="refuse_flag_div">
                                    <div class="__app_input">
                                        <label>If so, when and by whom (Mention Control No. and date also)</label>
                                        <input type="text" name="refuse_details" value="{{$qry['refuse_details']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Countries Visited in last 10 Years</label>
                                        <input type="text" name="country_visited" value="{{$qry['country_visited']}}" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>India Reference Name</label>
                                        <input type="text" name="nameofsponsor_ind" value="{{$qry['nameofsponsor_ind']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>India Reference Address</label>
                                        <input type="text" name="add1ofsponsor_ind" value="{{$qry['add1ofsponsor_ind']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>India Reference Phone No</label>
                                        <input type="text" name="phoneofsponsor_ind" value="{{$qry['phoneofsponsor_ind']}}" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>{{$qry['residing_in']}} Reference Phone No</label>
                                        <input type="text" name="nameofsponsor_msn" value="{{$qry['nameofsponsor_msn']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>{{$qry['residing_in']}} Reference Phone No</label>
                                        <input type="text" name="add1ofsponsor_msn" value="{{$qry['add1ofsponsor_msn']}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>{{$qry['residing_in']}} Reference Phone No</label>
                                        <input type="text" name="phoneofsponsor_msn" value="{{$qry['phoneofsponsor_msn']}}" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                        <div class="__review_radio">
                                            <p>Have you visited SAARC countries (except your own country) during last 3 years?</p>
                                            <div class="__prtyradio_box">
                                            <label class="__review_radioinput" for="saarc_flag">
	                                            <input type="radio" name="saarc_flag" id="" value="Y"  {{($qry['saarc_flag'])=="Y"? "checked" : "" }}>
	                                            <span>Yes</span>
                                            </label>
                                            <label class="__review_radioinput" for="saarc_flag">
                                            	<input type="radio" name="saarc_flag" id="" value="N" {{($qry['saarc_flag'])== "N"? "checked" : "" }} >
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="saarc_form_div">
                                    <div class="col-md-12">
                                        <p class="__form_notes">Saarc Details</p>
                                    </div>
                                    @if(isset($saarc_details))
                                	@foreach($saarc_details as $val)
                                		<div class="col-md-4">
		                                    <div class="__select_box">
		                                        <label>Country</label>
			                                    <select id="" class="__select" name="saarcCountry[]" >
			                                    	<option></option>
			                                        @foreach($getsaarccountry as $v)
			                                        <option value="{{$v->country_id}}" {{$val[0] == $v->country_id ? "selected" : ''}}>{{$v->country_name}}</option>
			                                        @endforeach
			                                    </select>
			                                    <i class="fa fa-angle-down"></i>
			                                </div>
	                                	</div>
                                		<div class="col-md-4">
                                			<div class="__app_input">
		                                        <label>Year</label>
		                                        <input type="text" name="saarcYear[]" value="{{$val[1]}}" />
		                                    </div>
                                		</div>
                                		<div class="col-md-4">
                                			<div class="__app_input">
		                                        <label>No of Visits</label>
		                                        <input type="text" name="saarcVisitNo[]" value="{{$val[2]}}" />
		                                    </div>
                                		</div>
                                		<div class="clearfix"></div>
                                	@endforeach
                                    @endif
                                </div></div>
                                <div class="__fm_box __app_form">
                                    
                            <div class="col-md-12">
                                @if(isset($service_purpose))
                                <div class="col-md-12">
                                    <p class="__form_notes">Purpose of Visit and Details</p>
                                </div>
                                     @if(isset($service_purpose->service_req_short_medical->hospital_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Short term Medical treatment of self</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Hospital Name</label>
                                        <input type="text" name="service_req_short_medical[hospital_name]" value="{{$service_purpose->service_req_short_medical->hospital_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Hospital Address</label>
                                        <input type="text" name="service_req_short_medical[hospital_address]" value="{{$service_purpose->service_req_short_medical->hospital_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Hospital state</label>
                                        <input type="text" name="service_req_short_medical[hospital_state]" value="{{$service_purpose->service_req_short_medical->hospital_state}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Hospital District</label>
                                        <input type="text" name="service_req_short_medical[hospital_district]" value="{{$service_purpose->service_req_short_medical->hospital_district}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Hospital Phone No</label>
                                        <input type="text" name="service_req_short_medical[hospital_phone_no]" value="{{$service_purpose->service_req_short_medical->hospital_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Type of Medical Treatment</label>
                                        <input type="text" name="service_req_short_medical[type_of_medical]" value="{{$service_purpose->service_req_short_medical->type_of_medical}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_short_yoga->yoga_institute_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Short-term Yoga Programme</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name of the Institute in India</label>
                                        <input type="text" name="service_req_short_yoga[yoga_institute_name]" value="{{$service_purpose->service_req_short_yoga->yoga_institute_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Yoga Institute Address</label>
                                        <input type="text" name="service_req_short_yoga[yoga_institute_address]" value="{{$service_purpose->service_req_short_yoga->yoga_institute_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>state</label>
                                        <input type="text" name="service_req_short_yoga[yoga_institute_state]" value="{{$service_purpose->service_req_short_yoga->yoga_institute_state}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>District</label>
                                        <input type="text" name="service_req_short_yoga[yoga_institute_district]" value="{{$service_purpose->service_req_short_yoga->yoga_institute_district}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_short_yoga[yoga_institute_phone_no]" value="{{$service_purpose->service_req_short_yoga->yoga_institute_phone_no}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_meeting_frend->frnd_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Meeting friends/relatives</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Details of the Friend/Relative</label>
                                        <input type="text" name="service_req_meeting_frend[frnd_name]" value="{{$service_purpose->service_req_meeting_frend->frnd_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_meeting_frend[frnd_address]" value="{{$service_purpose->service_req_meeting_frend->frnd_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>state</label>
                                        <input type="text" name="service_req_meeting_frend[frnd_state]" value="{{$service_purpose->service_req_meeting_frend->frnd_state}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>District</label>
                                        <input type="text" name="service_req_meeting_frend[frnd_district]" value="{{$service_purpose->service_req_meeting_frend->frnd_district}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_meeting_frend[frnd_phone]" value="{{$service_purpose->service_req_meeting_frend->frnd_phone}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_recruit_manpower->recruit_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">To recruit manpower</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_name]" value="{{$service_purpose->service_req_recruit_manpower->recruit_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_address]" value="{{$service_purpose->service_req_recruit_manpower->recruit_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone no</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_phone_no]" value="{{$service_purpose->service_req_recruit_manpower->recruit_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_website]" value="{{$service_purpose->service_req_recruit_manpower->recruit_website}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name and contact number of the company representative in India</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_name_contact]" value="{{$val[2]}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Nature of Job for which recruiting</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_nature_job]" value="{{$val[2]}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Places where recruitment is to be conducted</label>
                                        <input type="text" name="service_req_recruit_manpower[recruit_place]" value="{{$val[2]}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_form_purchase->purchase_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Sale / purchase / trade</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_form_purchase[purchase_name]" value="{{$service_purpose->service_req_form_purchase->purchase_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_form_purchase[purchase_address]" value="{{$service_purpose->service_req_form_purchase->purchase_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>state</label>
                                        <input type="text" name="service_req_form_purchase[purchase_phone_no]" value="{{$service_purpose->service_req_form_purchase->purchase_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>District</label>
                                        <input type="text" name="service_req_form_purchase[purchase_website]" value="{{$service_purpose->service_req_form_purchase->purchase_website}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_form_purchase[purchase_nature_business]" value="{{$service_purpose->service_req_form_purchase->purchase_nature_business}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_part_exhi->exhi_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Participation in exhibitions, business / trade fairs</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_part_exhi[exhi_name]" value="{{$service_purpose->service_req_part_exhi->exhi_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_part_exhi[exhi_address]" value="{{$service_purpose->service_req_part_exhi->exhi_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_part_exhi[exhi_phone_no]" value="{{$service_purpose->service_req_part_exhi->exhi_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_part_exhi[exhi_website]" value="{{$service_purpose->service_req_part_exhi->exhi_website}}" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="__app_input">
                                        <label>Name and address of the Exhibition/trade fair</label>
                                        <input type="text" name="service_req_part_exhi[exhi_name_address]" value="{{$service_purpose->service_req_part_exhi->exhi_name_address}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_exp_spe->expart_co_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Expert/specialist in connection with an on-going project</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_exp_spe[expart_co_name]" value="{{$service_purpose->service_req_exp_spe->expart_co_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_exp_spe[expert_co_address]" value="{{$service_purpose->service_req_exp_spe->expert_co_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_exp_spe[expert_co_phone]" value="{{$service_purpose->service_req_exp_spe->expert_co_phone}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_exp_spe[expert_co_website]" value="{{$service_purpose->service_req_exp_spe->expert_co_website}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Firm Name</label>
                                        <input type="text" name="service_req_exp_spe[firm_name]" value="{{$service_purpose->service_req_exp_spe->firm_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_exp_spe[firm_address]" value="{{$service_purpose->service_req_exp_spe->firm_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_exp_spe[firm_phone]" value="{{$service_purpose->service_req_exp_spe->firm_phone}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_exp_spe[firm_website]" value="{{$service_purpose->service_req_exp_spe->firm_website}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_con_tours->travel_name_address))
                                <div class="col-md-12">
                                    <p class="__form_notes">Conducting tours</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name and address of the Travel Agency in native country</label>
                                        <input type="text" name="service_req_con_tours[travel_name_address]" value="{{$service_purpose->service_req_con_tours->travel_name_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Cities to be visited during the tour</label>
                                        <input type="text" name="service_req_con_tours[travel_city_name]" value="{{$service_purpose->service_req_con_tours->travel_city_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_con_tours[travel_name]" value="{{$service_purpose->service_req_con_tours->travel_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_con_tours[travel_address]" value="{{$service_purpose->service_req_con_tours->travel_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_con_tours[travel_phone_no]" value="{{$service_purpose->service_req_con_tours->travel_phone_no}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_business_venture->venture_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">To setup industrial / business venture</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_business_venture[venture_name]" value="{{$service_purpose->service_req_business_venture->venture_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_business_venture[venture_address]" value="{{$service_purpose->service_req_business_venture->venture_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone no</label>
                                        <input type="text" name="service_req_business_venture[venture_phone_no]" value="{{$service_purpose->service_req_business_venture->venture_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_business_venture[venture_website]" value="{{$service_purpose->service_req_business_venture->venture_website}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Nature of Business/Product</label>
                                        <input type="text" name="service_req_business_venture[venture_nature_business]" value="{{$service_purpose->service_req_business_venture->venture_nature_business}}" />
                                    </div>
                                </div>
                                @endif
                                @if(isset($service_purpose->service_req_business_meeting->meet_co_name))
                                <div class="col-md-12">
                                    <p class="__form_notes">Attend technical / Business meetings</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_business_meeting[meet_co_name]" value="{{$service_purpose->service_req_business_meeting->meet_co_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_business_meeting[meet_co_address]" value="{{$service_purpose->service_req_business_meeting->meet_co_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone no</label>
                                        <input type="text" name="service_req_business_meeting[meet_co_phone_no]" value="{{$service_purpose->service_req_business_meeting->meet_co_phone_no}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_business_meeting[meet_co_webiste]" value="{{$service_purpose->service_req_business_meeting->meet_co_webiste}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Name</label>
                                        <input type="text" name="service_req_business_meeting[meet_firm_name]" value="{{$service_purpose->service_req_business_meeting->meet_firm_name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Address</label>
                                        <input type="text" name="service_req_business_meeting[meet_firm_address]" value="{{$service_purpose->service_req_business_meeting->meet_firm_address}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Phone</label>
                                        <input type="text" name="service_req_business_meeting[meet_firm_phone]" value="{{$service_purpose->service_req_business_meeting->meet_firm_phone}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__app_input">
                                        <label>Website</label>
                                        <input type="text" name="service_req_business_meeting[meet_firm_wbsite]" value="{{$service_purpose->service_req_business_meeting->meet_firm_wbsite}}" />
                                    </div>
                                </div>
                                @endif
                                @endif


                            </div>
                        </div>
                        <div class="__fm_box __app_form">
                            <div class="col-md-12">
                                <p class="__form_notes">Documents</p>
                            </div>
                            <div class="__document_upload_box">
                                @foreach($getapplicantdata as $v)
                                <div class="fileinput fileinput-exists link_hide" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                        <img src="{{URL::to('/').$v->doc_url}}">
                                        <div class="doc-head">{{str_replace('_', ' ', $v->doc_type)}}</div>
                                    </div>
                                </div>
                                             <div class="fileinput fileinput-exists input_hide" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                    <img src="{{URL::to('/').$v->doc_url}}">
                                                   <div class="doc-head">{{str_replace('_', ' ', $v->doc_type)}}</div>
                                                </div>
                                                <div>
                                                   <span class="btn-file"><span class="fileinput-new">Upload New Image</span><span class="fileinput-exists">Change</span>
                                                   <input type="file" name="{{strtolower($v->doc_type)}}" class="required" accept="image/jpeg">
                                                   </span>
                                                   <a href="#" class="btn btn-default fileinput-exists" id="front_remove" data-dismiss="fileinput" onclick="">Remove</a> 
                                                </div>
                                             </div>
                                             @endforeach
                                          </div>

                                
                                @if(isset($getdocdata))
                                <div class="col-md-4">
                                    <div class="__app_input">
                                      @foreach($getdocdata as $document)
                                      <label>{{str_replace('_', ' ', $document->doc_type)}}</label>
                                        <input type="file" name="{{strtolower($document->doc_type)}}" class="input_hide">
                                        <span><a href="{{URL::to('/').$document->doc_url}}" class="link_hide">{{str_replace('_', ' ', $document->doc_type)}}</a></span>
                                      @endforeach 
                                    </div> 
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- row end -->
                     </div>
                     <!-- Form wrapper -->
                  </div>
                  <!-- Tab Content End -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@include('layouts.middle_footer')     
@stop