(function($){

  function bindHandlers(){
    $('textarea[name=all_columns]').on('paste', function(){
      var element = $(this);
      window.setTimeout(function(){
        var items = [];
        var s = element.val();
        var lines = s.split('\n');
        for(var i=0;i<lines.length;i++){
          var line = $.trim(lines[i]);
          if(line) items[items.length] = line;
          if(i == 0){
            var input = $('input[name=tablename]');
            var sitems = line.split(' ');
            if(sitems.length == 2){
              tablename = sitems[0];
              tablename = tablename.replace(/_(i|c|ui)d/i, '');
              input.val(tablename);
            }else{
              alert('invalid tablename');
              return false;
            }
          }
        }
        $('textarea').val('');
        var result = items.join('\n');
        element.val(result);

        if($('input[name=auto]').is(':checked')) $('input.submit').trigger('click');

      },100);
    });
  }


  $(document).ready(function(){
    trace('document.ready');
    bindHandlers();
  });

})(jQuery);
