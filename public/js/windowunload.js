var data_ordid = document.currentScript.getAttribute('data-ordid');
var page_name = document.currentScript.getAttribute('page-name');
var userleaving = document.currentScript.getAttribute('userleaving');
var myEvent = window.attachEvent || window.addEventListener;
var chkevent = window.attachEvent ? 'onbeforeunload' : 'beforeunload'; /// make IE7, IE8 compitable

myEvent(chkevent, function(e) { // For >=IE7, Chrome, Firefox
   	// var returnval = (e || window.event).returnValue = confirmationMessage;
    // return confirmationMessage;
    // console.log(page_name);

 //    if(page_name === "evisa-type") {
	// 	return userleaving = false;
	// } else {
	// 	return userleaving = true;
	// }

	if(page_name === "verifymail") {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "/rca_website_l/public/sendabandonsmail",
			type: "POST",
			dataType:"json",
			async: true,
			data: {order_id:data_ordid,pagename:page_name},
			success: function (response) {
				// console.log(response);
							//alert("grate");				  
			}
		});
	}
    
});

function checkpagereload() {
	var check = false;
	if (performance.navigation.type == 1) {
    	return check = false;
  	} else {
    	return check = true;
  	}
}

// window.onunload = function() {
// 	console.log(userleaving);
// 	// do something
// 	if(userleaving==false){
// 		alert("hii");
// 	}
// }
// window.onload = function() {
// 	$.ajaxSetup({
// 			headers: {
// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 			}
// 	});
// 	$.ajax({
// 			url: "/rca_website_l/public/sendabandonsmail",
// 			type: "POST",
// 			dataType:"json",
// 			async: false,
// 			data: {order_id:data_ordid,pagename:page_name},
// 			success: function (response) {
// 					//alert("grate");				  
// 			}
// 	});	
// }

// addevent(document, "mouseout", function(e){
// 	e = e?e:window.event;
// 	var from = e.relatedTarget || e.toElement;
// 	if(!from || from.nodeName == "HTML"){
// 		$.ajaxSetup({
// 			headers: {
// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 			}
// 		});
// 		$.ajax({
// 			url: "/rca_website_l/public/sendabandonsmail",
// 			type: "POST",
// 			dataType:"json",
// 			async: false,
// 			data: {order_id:data_ordid},
// 			success: function (response) {
// 							//alert("grate");				  
// 			}
// 		});
// 	}
// });

function addevent(obj, evt, fn) {
	if(obj.addEventListener) {
		obj.addEventListener(evt,fn,false);
	}

	else if(obj.attachEvent) {
		obj.attachEvent("on"+evt,fn);
	}
}