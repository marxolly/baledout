// JavaScript Document
$(document).ready(function() {
    ////////////////////////////////////////////////////////////
    //extra methods
    $.validator.addMethod("wordCount",
   			function(value, element, params) {
      			var typedWords = jQuery.trim(value).split(' ').length;
      			if(typedWords <= params[0]) {
         			return true;
      			}
   			},
   			$.validator.format("Only {0} words allowed.")
    );

    $.validator.addMethod('notNone', function(value, element) {
            return (value != '0');
    }, 'Please make a selection');

    $.validator.addMethod('pageNames', function(value, element){
            return (!/[^a-z0-9-]/.test(value));
    });

    $.validator.addMethod('ozPostcodes', function(value, element){
            return (/^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$/.test(value));
    });

    $.validator.addMethod("currency", function (value, element) {
            return (this.optional(element) || /^(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/.test(value) );
    });

    $.validator.addMethod('positiveNumber', function (value, element) {
        	return (this.optional(element) || (Number(value) > 0) );
    }, 'Enter a positive number.');

    $.validator.addMethod('positiveNumber0', function (value, element) {
        	return (this.optional(element) || (Number(value) >= 0) );
    }, 'Enter a positive number or zero.');

    $.validator.addMethod('positiveWholeNumber', function (value, element) {
        	return (this.optional(element) || (Number(value) > 0 && value % 1 == 0) );
    }, 'Enter a positive whole number.');

    $.validator.addMethod('positiveWholeNumber0', function (value, element) {
        	return (this.optional(element) || (Number(value) >= 0 && value % 1 == 0) );
    }, 'Enter a positive whole number or zero.');

    $.validator.addMethod('wholePallets', function (value, element){
            var item_id = $(element).data('itemid');
            if( $("#pallet_"+item_id).is(':checked') )
            {
                var pallet_count = $("#pallet_size_"+item_id).val();
                return( (value % pallet_count) == 0 );
            }
            else
            {
                return true;
            }
    }, 'Cannot make whole pallets from this number');

    $.validator.addMethod("pickChecker", function(value, element) {
        if(value)
        {
            //return $(element).val() === $(element).parent().parent().find("input[name='thing1']").val();
            //console.log('pickcheck: '+$(element).data('pickcheck'));
            return parseInt($(element).val()) === parseInt($(element).data('pickcheck'));
        }
        else
        {
            return true;
        }
    }, 'Pick count is wrong');

    $.validator.addMethod("noDuplicates", function(value, element) {
        var matches  =  new Array();
        $('input.unique').each(function(index, item) {
            if (value == $(item).val()) {
                matches.push(item);
            }
        });
        return matches.length == 1;
    }, "Duplicate input detected.");

    $.validator.addMethod('atLeastOneContact', function(value, element, params) {
        var contacts = $('input.contact-name').filter(function() {
            return $(this).val() != '';
        });
        return contacts.length > 0;
    }, 'Please select at least one seat');

    //$.validator.addMethod("uniqueUserRole", $.validator.methods.remote, "User Role names need to be unique");

    ////////////////////////////////////////////////////////////
    //Validator default
    //console.log('validator loaded');
    $.validator.setDefaults({
        //errorElement: "p",
        errorElement: "em",
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            //console.log(validator.errorList);
            if (errors) {
                $('html, body').animate({
                    scrollTop: ( ($(validator.errorList[0].element).offset().top - $('navbar.navbar').height) )
                }, 200);
                //validator.errorList[0].element.focus();
            }
        },
        highlight: function ( element, errorClass, validClass ) {
        	$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
        	$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        errorPlacement: function ( error, element ) {
        	// Add the `text-danger` class to the error element
            //console.log(element.prop( "type" ))
        	error.addClass( "text-danger" );
            //error.addClass("font-italic");
        	if ( (element.prop( "type" ) === "checkbox")  ) {
        		error.insertAfter( element.parent().find( "label" ) );
        	}
            else if( (element.prop( "type" ) === "radio") ) {
                error.insertAfter( element.parent().parent().parent() );
            }
            else if( element.prop( "type" ) === "select-one" ) {
                error.insertAfter( element.closest( "div.bootstrap-select" ) );
            }
            else if ( element.parent().hasClass('input-group') && element.parent().find('div.input-group-append').length !== 0){
                error.insertAfter( element.next( "div.input-group-append" ) );
            }
            else if ( element.parent().hasClass('input-group') && element.parent().find('div.input-group-prepend').length !== 0){
                error.insertAfter( element.parent() );
            }
            else {
        		error.insertAfter( element );
        	}
        }
    });

    //Validators
    ///////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////
    $('form#add_user').validate({
        rules:{
            role_id:{
                notNone: true
            }
        },
        messages:{
            role_id:{
                notNone: "Please select a role"
            }
        }
    });
    ////////////////////////////////////////////////////////////
    $('form#client_add').validate({
        rules:{
            client_logo:{
    			accept: "image/*"
    		},
            website:{
                url: true
            }
        },
        messages:{
            client_logo:{
                accept: "Only upload image files here"
            }
        }
    });
    ///////////////////////////////////////////////////////////////////////////////
    $('form#send_a_message').validate({
        ignore: "[contenteditable='true']:not([name])",
        messages: {
            message:{
                required: "Please Type a Message"
            },
            subject:{
                required: "Please give your message a subject"
            }
        }
    });
    ////////////////////////////////////////////////////////////
    $('form#form-login').validate({

     });
    ////////////////////////////////////////////////////////////
    $('form#form-forgot-password').validate({
        
    });
    ////////////////////////////////////////////////////////////
    $('form#profile_update').validate({
    	rules:{
    		image:{
    			accept: "image/*"
    		},
            conf_new_password:{
                equalTo: "#new_password"
            }
    	},
        messages:{
            image:{
                accept: "Only upload image files here"
            },
            conf_new_password:{
                equalTo: "This does not match. Please check"
            }
        }
    });

});//end doc ready function