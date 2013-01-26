//
// CREATE BY gooKooNg
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
$(document).ready(function(){
          initializeed();
});
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  -----------------------------------------------------------------------  GLOBAL VARIABLE  ---------------------------------------------------------------------- 

var defaultCenterMap = new google.maps.LatLng(12.067355, 101.464350);
var marker;
var map;
var myzooom = 5;
var myMapType;

function initializeed() {
          
          //  ---------------------------------------------------------------------- CREATE MAP  --------------------------------------------------------------------- 
          createMyMap();
          function createMyMap(){
                    var mapOptions = {
                              panControl: false,
                              mapTypeControl: true,
                              scaleControl: false,
                              streetViewControl: false,
                              overviewMapControl: false,
                              zoomControl: false,
                              scrollwheel: false,
                              zoom: myzooom,
                              mapTypeId: google.maps.MapTypeId.ROADMAP,
                              center: defaultCenterMap
                    };
                    
                    map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
          }
            
          //  ------------------------------------------------------------------- CREATE MARKER  ------------------------------------------------------------------- 
          function getMyMarkers(){
                    marker = new google.maps.Marker({
                              map:map,
                              draggable:true,
                              title: 'My workplace',
                              clickable: false,
                              icon: 'images/marker/1.png',
                              animation: google.maps.Animation.DROP,
                              position: map.getCenter()
                    });
                    
                    updateHiddenFields();
                    google.maps.event.addListener(marker, "dragend", function() {
                              updateHiddenFields();	
                    });
          }
          

          
          // ----------------------------------------------------------------- REMOVE MARKER ----------------------------------------------------------------------
          
          function clearOverlays() {
                    $('#marker_lat').val('');
                    $('#marker_lng').val('');
                    marker.setMap(null);
          }

          //  ----------------------------------------------------------------- EVENT SIDEBAR -------------------------------------------------------------------- 
          $('#zoomInDiv').click(function(){
                    ++myzooom;
                    map.setZoom(myzooom);
          });
          $('#zoomOutDiv').click(function(){
                    --myzooom;
                    map.setZoom(myzooom);
          });
          
          $('#markerDiv').toggle(function(){
                    $(this).css('background-position','32px -93px').css('width','32px');
                    getMyMarkers();
          },function(){
                    $(this).css('background-position','0px -93px').css('width','31px');
                    clearOverlays();
          });
          
}

//  -----------------------------------------------------------------------  UPDATE LATLNG  ---------------------------------------------------------------------- 
function updateHiddenFields(){
          $('#marker_lat').val(marker.position.lat());
          $('#marker_lng').val(marker.position.lng());
}
