(function($){

  function bindHandlers(){
    trace('bindHandlers');
  }

  function init(){
    trace('init');
  }

  $(document).ready(function(){
    trace('document.ready');
    bindHandlers();
    init();
  });

  $(window).load(function(){
    trace('window.load');
  });

})(jQuery);
