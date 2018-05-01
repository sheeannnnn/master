$.ajax({
	url: 'js/_dataAlert.js',
	dataType: 'script',
	success: 'success'
});

$(document).ready(function(){
myMap();
});


  var mapCanvas = "";
  var myCenter = "";
  var map = "";
  var actuator1 = "";
  var actuator2 = "";
  var inactiveActuator = "";
  var markerCenter = "";
  var markerActuator1 = "";
  var markerActuator2 = "";
  var mapOptions = "";


function myMap() { //map initialize
  mapCanvas = document.getElementById("map");
  myCenter = new google.maps.LatLng(7.079910,125.572397); 
  actuator1 = new google.maps.LatLng(7.085975, 125.572227);
  actuator2 = new google.maps.LatLng(7.065522, 125.571767);
 mapOptions = {
    center: myCenter, 
    zoom: 14, 
    mapTypeId:google.maps.MapTypeId.HYBRID
  };
 
  map = new google.maps.Map(mapCanvas,mapOptions);
 icons();
}

function clearMarker(){
  markerCenter.setMap(null);
  markerActuator1.setMap(null);
  markerActuator2.setMap(null);

}

function icons(animation = " ", iconMap = "img/greenpin.png"){

  if(markerCenter != ""){
  clearMarker();
  }

 inactiveActuator = {
    url: iconMap,
    scaledSize: new google.maps.Size(25,35)
  };

 markerCenter = new google.maps.Marker({
    position: myCenter,
    animation: animation,
    map: map
  });

 markerActuator1 = new google.maps.Marker({
    position: actuator1,
    icon: inactiveActuator,
    map: map
  });


 markerActuator2 = new google.maps.Marker({
    position: actuator2,
    icon: inactiveActuator,
    map: map
  });

}


