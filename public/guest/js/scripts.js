jQuery(document).ready(function($j){
	$j.fn.serializeObject = function() {
	    var data = {};

	    function buildInputObject(arr, val) {
	        if (arr.length < 1) {
	            return val;
	        }
	        var objkey = arr[0];
	        if (objkey.slice(-1) == "]") {
	            objkey = objkey.slice(0,-1);
	        }
	        var result = {};
	        if (arr.length == 1){
	            result[objkey] = val;
	        } else {
	            arr.shift();
	            var nestedVal = buildInputObject(arr,val);
	            result[objkey] = nestedVal;
	        }
	        return result;
	    }

	    function gatherMultipleValues( that ) {
	        var final_array = [];
	        $j.each(that.serializeArray(), function( key, field ) {
	            // Copy normal fields to final array without changes
	            if( field.name.indexOf('[]') < 0 ){
	                final_array.push( field );
	                return true; // That's it, jump to next iteration
	            }

	            // Remove "[]" from the field name
	            var field_name = field.name.split('[]')[0];

	            // Add the field value in its array of values
	            var has_value = false;
	            $j.each( final_array, function( final_key, final_field ){
	                if( final_field.name === field_name ) {
	                    has_value = true;
	                    final_array[ final_key ][ 'value' ].push( field.value );
	                }
	            });
	            // If it doesn't exist yet, create the field's array of values
	            if( ! has_value ) {
	                final_array.push( { 'name': field_name, 'value': [ field.value ] } );
	            }
	        });
	        return final_array;
	    }

	    // Manage fields allowing multiple values first (they contain "[]" in their name)
	    var final_array = gatherMultipleValues( this );

	    // Then, create the object
	    $j.each(final_array, function() {
	        var val = this.value;
	        var c = this.name.split('[');
	        var a = buildInputObject(c, val);
	        $j.extend(true, data, a);
	    });

	    return data;
	};

	jQuery("#register-form").on("show.bs.modal", function() {
  		jQuery('.message-form').html('').hide();
	});

	jQuery('#frmRegister').on('submit', function(ev){
		ev.preventDefault();
		var error = '',
			form_data = new FormData(),
			password = jQuery('#password').val(),
			password_retype = jQuery('#password_retype').val(),
			email = jQuery('#email').val();

		jQuery('#frmRegister input.has-required').each(function(){
			var fieldValue = jQuery(this).val(),
				fieldName = jQuery(this).attr("name");

			if(jQuery.trim(fieldValue)=="") {
				error += 'Field is empty';
				jQuery(this).addClass('error');
			}
			else{
				jQuery(this).removeClass('error');
				form_data.append(fieldName, fieldValue);
			}
		});

		if(validateEmail(email)==true){
			jQuery('#email').removeClass('error');
			form_data.append('email', email);
		}
		else{
			error += 'Email invalid';
			jQuery('#email').addClass('error');
		}

		if(password.length < 6){
			error += 'Password length should more than 5characters';
			jQuery('#password').addClass('error');
			jQuery('.password-error').show();
		}
		else{
			jQuery('.password-error').hide();
			jQuery('#password').removeClass('error');
			if(password!=password_retype) {
				error += 'Password not match';
				jQuery('#password_retype').addClass('error');
			}
			else{
				jQuery('#password_retype').removeClass('error');
				form_data.append('password', password);
			}
		}

		if(error=='') {
			var formData = jQuery('#frmRegister').serializeObject();
			jQuery('button[type="submit"]').hide();
			jQuery('.loading-form').show();
			jQuery.ajax({
				url: './inc/ajax.php?task=register',
				type: 'post',
				dataType: "json",
				data: {
					formData
				},
				success: function(res) {
					jQuery('button[type="submit"]').show();
					jQuery('.loading-form').hide();

					if(res['status']=="success"){
						/*
						var htmlMessage = '<p class="sys-message message-success">'+ res['msg'] +'</p>';
						jQuery('#frmRegister').find('input').val('');*/
						location.reload();
					}
					else{
						var htmlMessage = '<p class="sys-message message-error">'+ res['msg'] +'</p>';
					}

					jQuery('.message-form').html(htmlMessage).show();
				},
				error: function(){
				}
		    });
		}
	});
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}