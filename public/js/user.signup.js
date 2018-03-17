var rvalidator;

$(window).load(function(){

    rvalidator = $('form#signup').validate({
      onsubmit: false,
      onkeyup: false,
      errorClass: 'val-error',
      focusInvalid: false,
      rules: {
        email:{required:true,maxlength:100,email:true},
        first_name:{required:true,maxlength:100},
        last_name:{required:true,maxlength:100},
        address:{required:true,maxlength:100},
        city:{required:true,maxlength:100},
        state:{required:true},
        zip:{required:true,maxlength:5,digits:true},
        card_type:{required:true},
        card_no:{required:true,creditcard:true},
        card_exp_mm:{required:true},
        card_exp_yyyy:{required:true},
        card_name:{required:true},
        card_zip:{required:true}
      },
      groups:{
      	card_exp:'card_exp_mm card_exp_yyyy'
      },
      messages:{
        email:{required:'Email is required'},
        first_name:{required:'First Name is required'},
        last_name:{required:'Last Name is required'},
        address:{required:'Address is required'},
        city:{required:'City is required'},
        state:{required:'State is required'},
        zip:{required:'Zip is required'},
        card_type:{required:'Card Type is required'},
        card_no:{required:'Card Number is required',creditcard:'Invalid Card Number'},
        card_exp_mm:{required:'Card Expiration is required'},
        card_exp_yyyy:{required:'Card Expiration is required'},
        card_name:{required:'Name on Card is required'},
        card_zip:{required:'Billing Zip Code is required'}
      },
      errorPlacement:function(error, element){
      	var name = element.attr('name');
      	if(name == 'card_exp_mm' || name == 'card_exp_yyyy'){
      		error.insertAfter('#card_exp_yyyy');
      	}else{
      		error.insertAfter(element);
      	}
      }
    });

  $('form#signup input[type=text],form#signup input[type=password],form#signup select').val('');
  $('form#signup  #username').focus();
});
function Register(){

  var p = $('.register-wait');
  p.css('height', (parseInt(p.parent().height()) + 25) + 'px');
  if (p.hasClass('wait')) return;

  p.addClass('wait');

  var settings = {};
  settings.url = 'default.ashx';
  settings.cache = false;
  settings.async = true;
  settings.dataType = 'json';

  var data = {};
  data.cmd = 'Register';

  data.username = $('#username').val();
  data.email = $('#email').val();
  data.password = $('#password').val();
  data.phone = $('#phone').val();
  data.first_name = $('#first_name').val();
  data.last_name = $('#last_name').val();
  data.address = $('#address').val();
  data.city = $('#city').val();
  data.state = $('#state').val();
  data.zip = $('#zip').val();

  settings.data = data;

  settings.error = function(XMLHttpRequest, textStatus, errorThrown) { trace('Error'); trace(textStatus); trace(errorThrown); };
  settings.success = function(data, textStatus, XMLHttpRequest) {
    if (data.status == 'success') {

	    setTimeout(function(){
	    	p.addClass('success')
	    	setTimeout(function(){
	    		p.animate({'opacity':0}, 333, function(){
	    			p.removeClass('wait').removeClass('success').css('opacity',0.83);
			    	$('form#signup .request').fadeOut('fast', function(){
				    	$('form#signup .response').show();
			    	});

	    		});
	    	}, 667);
	   	}, 1667);

    } else {
			if(data.error.indexOf('Email') != -1){
		    $('.input-email.input-msg').html(data.error);
			}else if(data.error.indexOf('Username') != -1){
		    $('.input-username.input-msg').html(data.error);
			}else{
		    $('.valsum').html(data.error);
			}

	    setTimeout(function(){ p.animate({'opacity':0}, 333, function(){ p.removeClass('wait').css('opacity',0.83); }); }, 0.33);
    }
  };
  $.ajax(settings);
}

$(document).ready(function(){
  $('form#signup .submit').click(function(){
   $('.valsum').html('');
    var isValid = $('form#signup').valid();
    if(isValid){
    	$('form#signup').append($('<input>').attr({'type':'hidden','name':'cmd','value': $(this).val()}));
    	$('form#signup').submit();
    }
  });

  $('form#signup input[type=text],form#signup input[type=password]').keypress(function(e) {
    if (e.which == 13) $('form#signup .submit').trigger('click');
  });

	$('input[type=text].digits-only').keydown(function(event) {
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 ) return;
		else if (event.keyCode > 47 && event.keyCode < 58 ) return;
		else if (event.keyCode > 95 && event.keyCode < 106 ) return;
		else event.preventDefault();
	});

	$('#vendor_yes').click(function(){
		var div = $('#vendor_license_container');
		if($(this).is(':checked')){
			div.show();
			$('#vendor_no').removeAttr('checked');
		}else{
			div.hide();
		}
	});
	$('#vendor_no').click(function(){
		var div = $('#vendor_license_container');
		if($(this).is(':checked')){
			div.hide();
			$('#vendor_yes').removeAttr('checked');
		}else{
			div.show();
		}
	});

	$('#billing_same').click(function(){
		if($(this).is(':checked')){
			$('#billing_address1').val($('#shipping_address1').val());
			$('#billing_address2').val($('#shipping_address2').val());
			$('#billing_city').val($('#shipping_city').val());
			$('#billing_state').val($('#shipping_state').val());
			$('#billing_zip').val($('#shipping_zip').val());
		}
	});

	$('input[type=text]').attr('autocomplete','off');


});
function trace(s){
  if(window.console)window.console.log(s);
}
