function myMap() {
var mapProp= {
    center:new google.maps.LatLng(1.3521, 103.8198),
    zoom:12,
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}