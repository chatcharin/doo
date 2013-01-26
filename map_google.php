<?
$id_gen = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
            <link rel="stylesheet" type="text/css" href="css/googlemap.css"/>
            <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAUf3LAxep-Yce9tOPTWsjintjII3dyxIQ&sensor=true"></script>
            <script type="text/javascript">
            
                var defaultCenterMap = new google.maps.LatLng(-34.397, 150.644);
                var marker;
                var map;
                var myzooom = 13;
                var myMapType;
                var geocoder;
                
                function initializeed() {
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
                    }
                    function getMyMarkers(){
                        marker = new google.maps.Marker({
                            map:map,
                            title: 'My workplace',
                            clickable: false,
                            icon: 'images/marker/1.png',
                            animation: google.maps.Animation.DROP,
                            position: map.getCenter()
                        });
                    }
                    
                    getMyMarkers();
                    $('#zoomInDiv').click(function(){
                        ++myzooom;
                        map.setZoom(myzooom);
                    });
                    $('#zoomOutDiv').click(function(){
                        --myzooom;
                        map.setZoom(myzooom);
                    });
                }
                
                $(document).ready(function(){
                    $.ajax({
                        type:"POST",
                        url:"get_marker.php",
                        data:"id=" + <?= $id_gen ?>,
                        success:function(marker){
                            var xx = marker.split(',');
                            defaultCenterMap = new google.maps.LatLng(xx[0],xx[1]);
                            initializeed();
                        }
                    });

                });
            </script>
    </head>

    <body>
        <div id="map_goo">
            <div id="map_canvas"></div>
            <div id="bg_sidebar"></div>
            <div id="sidebar_map">
                <a id="zoomInDiv" class="sidebar_button" title="ซูมเข้าเพื่อดูแผนที่ให้ละเอียดขึ้น" style="background-position: 0px -31px;">-</a>
                <a id="zoomOutDiv" class="sidebar_button" title="ซูมออกเพื่อดูแผนที่ในมุมกว้าง" style="background-position: 0px -62px;">-</a>
            </div>
        </div>
    </body>
</html>