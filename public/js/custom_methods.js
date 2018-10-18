$(function() {

    $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });

    $.validator.addMethod("emailadd", function(value, element) {
    return this.optional(element) || value == value.match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
    });

    $.validator.addMethod("numeric", function(value, element) {
    return this.optional(element) || value == value.match(/^[0-9]+$/);
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
    });
	
	$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
	}, 'File size must be less than {0}');

    // this one requires the value to be the same as the first parameter
    $.validator.addMethod('custrequired', function (value, element, param) {
        return value == param;
    });

    $.validator.addMethod("expiryValidator", function (value, element) {
              var val = Date.parse(value);
              console.log(val);
              var d = new Date(val);
              var f = new Date();              
              if (isNaN(val))
                  return false;
              f.setMonth(f.getMonth() + 6);
              if (d < f) {
                  return false;
              }
              return true;
    });
});