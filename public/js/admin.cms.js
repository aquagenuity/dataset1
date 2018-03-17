$(document).ready(function(){
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

		$('form').submit(function(){
			$('textarea').each(function(i,o){
				var s = $(this).parent().find('.nicEdit-main').html();
				//trace(s);
				$(this).html(s);
			});
			return true;
		});
});
$(window).load(function(){
});