@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmextradoc" action="{{URL::to('/')}}/evisa-form/basic-details/{{$getpostdata['residing_code']}}" enctype='multipart/form-data'>
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="passport_type" id="passport_type" value="{{$getpostdata['passport_type']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="order_code" value="{{!empty($getpostdata['order_code'])?$getpostdata['order_code']:NULL}}">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{URL::to('/')}}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{URL::to('/')}}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                    <div class="__progress_wrapper">
                                    <ul class="__progress">
                                        <li class="active _100">Basic Info + Document Upload</li>
                                        <li class="active _30">Form Filling</li>
                                        <li class="">Verification</li>
                                        <li class="">Payment</li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div id="save_form_msg" style="display: \;"></div>
                                <div class="upform">
                                    <div class="upform-main">
                                    <div class="row">
                                    <div class="input-block active">
                                        <div class="labels">
                                            <div class="qs_list"></div>
                                            <div class="qs_body">
                                                 Are you ready with your documents?
                                                 <span class="strike">*</span>
                                            </div>
                                        </div>
                                        <div class="input-control">
                                          <div class="__document_upload_box">
                                            @if(isset($serviceid[2]))
                                            <!-- passport front -->
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                @if(isset($getdocarray[18][0]['doc_url']) && !empty($getdocarray[18][0]['doc_url']))
                                                    <div class="fileupload-preview fileupload-exists thumbnail">
                                                        <a href="{{URL::to('/')}}{{$getdocarray[18][0]['doc_url']}}" target="_blank"><img src="{{URL::to('/')}}/svg/pdf.svg"></a>
                                                    </div>
                                                @else
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                        <div class="doc-head">Business Card</div>
                                                    </div>
                                                @endif
                                                
                                                <div>
                                                   <span class="btn-file"><span class="fileinput-new">Upload</span><span class="fileinput-exists">Change</span>
                                                   <input type="file" name="business_card" {{(isset($getdocarray[18][0]['doc_url']) && !empty($getdocarray[18][0]['doc_url']))?NULL:"required"}} class="required" accept="application/pdf">
                                                   </span>
                                                   <a href="#" class="btn btn-default fileinput-exists" id="front_remove" data-dismiss="fileinput" onclick="removeforntthumb()">Remove</a> 
                                                </div>
                                                <input type="hidden" name="business_file" value="{{(isset($getdocarray[18][0]['doc_url']) && !empty($getdocarray[18][0]['doc_url']))?$getdocarray[18][0]['doc_url']:NULL}}">
                                             </div>
                                            @endif
                                            <!-- end -->
                                            @if(isset($serviceid[3]))
                                            <!-- passport photo -->
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                @if(isset($getdocarray[19][0]['doc_url']) && !empty($getdocarray[19][0]['doc_url']))
                                                    <div class="fileupload-preview fileupload-exists thumbnail">
                                                        <a href="{{URL::to('/')}}{{$getdocarray[19][0]['doc_url']}}" target="_blank"><img src="{{URL::to('/')}}/svg/pdf.svg"></a>
                                                    </div>
                                                @else
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                        <div class="doc-head">Hospital Letter</div>
                                                    </div>
                                                @endif
                                                <div>
                                                   <span class="btn-file"><span class="fileinput-new">Upload</span><span class="fileinput-exists">Change</span>
                                                   <input type="file" name="hospital_letter" {{(isset($getdocarray[19][0]['doc_url']) && !empty($getdocarray[19][0]['doc_url']))?NULL:"required"}} class="required" accept="application/pdf">
                                                   </span>
                                                   <a href="#" class="btn btn-default fileinput-exists" id="photo_remove" data-dismiss="fileinput" onclick="removephotothumb()">Remove</a>
                                                </div>
                                                <input type="hidden" name="hospital_file" value="{{(isset($getdocarray[19][0]['doc_url']) && !empty($getdocarray[19][0]['doc_url']))?$getdocarray[19][0]['doc_url']:NULL}}">
                                             </div>
                                            @endif
                                            <!-- end -->
                                          </div>
                                          <div class="col-md-12">
                                             <p><strong>Document Specifications: </strong></p>
                                             <ul class="__ct_decimal">
                                                <li>Format – PDF</li>
                                                <li>Size – Minimum 10 KB , Maximum 1 MB</li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="__btn __btn_next" name="btn_evisa_doc">Next Step</button>
                                    </div>
                                </div><!-- row end -->
                                    </div>
                                </div>
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </form>
                    <!-- <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}" page-name="evisa-extradoc" userleaving="false"></script> -->
                    <script src="{{URL::to('/')}}/js/dist/indiaevisa_autosaveform.js" form-id="frmextradoc" ajax-url="ajaxautosaveextradoc"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop