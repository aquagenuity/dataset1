var rvalidator;

$(window).load(function(){
  rvalidator = $('form#signin').validate({
    onsubmit: false,
    onkeyup: false,
    errorClass: 'val-error',
    focusInvalid: false,
    rules: {
      email:{required:true,maxlength:100,email:true},
      password:{required:true}
    },
    messages:{
      email:{required:'Email is required'},
      password:{required:'Password is required'}
    }
  });
  $('input[type=text],input[type=password]').val('');
  $('#email').focus();
});
$(document).ready(function(){
	$('form').submit(function(){
		return $(this).valid();
	});

  $('input[type=text],input[type=password]').keypress(function(e) {
    if (e.which == 13) $('input[type=submit]').trigger('click');
  });

});
function trace(s){
  if(window.console)window.console.log(s);
}
