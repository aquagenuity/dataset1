$(document).ready(function(){
	$('form#view').find('input,textarea,select').bind('focus click', return_false);
});

function return_false(){
	$(this).trigger('blur');
	return false;
}