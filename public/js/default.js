
$(document).ready(function(){
  $('.loader .green').addClass('sd0');
  $('.loader .red').addClass('sd05');
  $('.loader .blue').addClass('sd1');
  $('.loader .yellow').addClass('sd15');
});

$(window).load(function(){
  setTimeout(function() { window.scrollTo(0, 1); }, 1);
});

function trace(s){
  if(typeof(s) == 'object') s = JSON.Stringify(s);
  if(window.console) window.console.log(s);s
}