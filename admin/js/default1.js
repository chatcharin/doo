//
// CREATE BY gooKooNg
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  -----------------------------------------------------------------------  GLOBAL VARIABLE  ---------------------------------------------------------------------- 


var marker;
var map;
var myzooom = 16;
var myMapType;
var geocoder;

$(document).ready(function(){
    var defaultCenterMap1 = new google.maps.LatLng($('#marker_lat').val(),$('#marker_lng').val());
    initializeed(defaultCenterMap1);

});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function initializeed(defaultCenterMap) {
    geocoder = new google.maps.Geocoder();
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
        getMyMarkers();
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
		clearOverlays();
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

//  -----------------------------------------------------------------------  GET ADDRESS ---------------------------------------------------------------------- 
function codeAddress(address,my) {
    $.ajax({
        type:"POST",
        url:"check/list_thailand.php",
        data:"jood=" + address + "&my=" +my,
        success:function(response){
			
            geocoder.geocode( {
                'address': response
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    if(my == "p")
                        map.setZoom(myzooom);
                    else if(my=="a"){
                        if(myzooom < 13)
                            map.setZoom(myzooom = 13);
                    }
                                    
                    else if(my =="t"){
                        if(myzooom < 15)
                            map.setZoom(myzooom = 15);
                    }
                                   
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    });
}