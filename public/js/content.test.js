  var map;
  var center;

  function initMap() {
    trace('initMap');


    center = {lat: 33.0888098, lng: -96.7944599};

    map = new google.maps.Map(document.getElementById('map'), {
      center: center,
      zoom: 15
    });

    addMarkers();
  }

  function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
  }


  function addMarkers(){
    trace('addMarkers');

    for(var i=0;i<5;i++){
      var d = 110000;
      var r = Math.random();
      var delta_lat = (Math.floor(r * d) * 0.0000001);
      if(r > 0.5) delta_lat = 0 - delta_lat;
      var lat = center.lat + delta_lat;
      lat = round(lat, 7);

      var r = Math.random();
      var delta_lng = (Math.floor(r * d) * 0.0000001);
      if(r > 0.5) delta_lng = 0 - delta_lng;
      var lng = center.lng + delta_lng;
      lng = round(lng, 7);

      var position = {lat: lat, lng: lng};
      var title = "Home";
      var icon = {url:"/img/get-a-mow-36.png", size:new google.maps.Size(36, 36)};
      var m = new google.maps.Marker({
        map:map,
        position: position,
        title:title,
        icon:icon
      });
    }

//    var position = {lat: 33.0862835, lng: -96.7813167};
//    var position = {lat: 33.0862835, lng: -96.8073167};
//    var position = {lat: 33.0772835, lng: -96.8073167};
//    var position = {lat: 33.0992835, lng: -96.8073167};

  }

  function trace(s){
    if(typeof(s) == 'object') s = JSON.stringify(s);
    if(window.console) window.console.log(s);s
  }



/*
(function($){

  $(document).ready(function(){
    trace('content.test.document.ready');
  });

  $(window).load(function(){
    trace('content.test.window.load');
  });


})(jQuery);
*/