var rvalidator;

$(window).load(function(){

    rvalidator = $('form#account').validate({
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
        card_no:{required:true, creditcard:true},
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

  $('form#account  #first_name').focus();
});
$(document).ready(function(){
  $('form#account .submit').click(function(){
   $('.valsum').html('');
    var isValid = $('form#account').valid();
    if(isValid){
    	$('form#account').append($('<input>').attr({'type':'hidden','name':'cmd','value': $(this).val()}));
    	$('form#account').submit();
    }
  });

  $('form#account input[type=text],form#account input[type=password]').keypress(function(e) {
    if (e.which == 13) $('form#account .submit').trigger('click');
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

	$('#username,#email').addClass('readonly');

	$('.readonly').focus(function(){
		$(this).blur();
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
