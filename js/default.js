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

var defaultCenterMap = new google.maps.LatLng(13.82031, 100.664710);
var marker;
var map;
var myzooom = 10;
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
$(document).ready(function(){
    $("#postLocation select[name='province']").change(function(){
        if($(this).val() != "เลือกจังหวัด"){
            codeAddress($(this).val(),"p");
            var my = $(this).val();
            jQuery.ajax({
                type:"POST",
                url:"thailand.php",
                data:"province=" + my+"&name=p",
                success:function(response){
                    var name = response.split('  ');
                    var countName = name.length;
                    var i;
                    jQuery.ajax({
                        type:"POST",
                        url:"thailand.php",
                        data:"province=" +my+"&name=p_id",
                        success:function(response1){
                            var id= response1.split(' ');
                            $('#postAmphur').children().remove()
                            $('#postAmphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
                            $('#postTambon').children().remove();
                            $('#postTambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                            for(i=0;i<countName;i++){
                                $('#postAmphur').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                            }
                        }
                            
                    });
                }
            });
        }else{
            $('#postAmphur').children().remove();
            $('#postAmphur').append("<option value='เลือกอำเภอ'>- เลือกอำเภอ -</option>");
            $('#postTambon').children().remove();
            $('#postTambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
        }
    });
    $("#postLocation select[name='amphur']").change(function(){
        if($(this).val() != "เลือกอำเภอ"){
            codeAddress($(this).val(),"a");
            var my = $(this).val();
            jQuery.ajax({
                type:"POST",
                url:"thailand_1.php",
                data:"amphur=" + my+"&name1=a",
                success:function(response){
                    var name = response.split('  ');
                    var countName = name.length;
                    var i;
                    jQuery.ajax({
                        type:"POST",
                        url:"thailand_1.php",
                        data:"amphur=" +my+"&name1=a_id",
                        success:function(response1){
                            var id= response1.split(' ');
                            $('#postTambon').children().remove()
                            $('#postTambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
                            for(i=0;i<countName;i++){
                                $('#postTambon').append("<option value='"+id[i]+"'>"+name[i]+"</option>");
                            }
                        }
                            
                    });

                        
                }
            });
        }
        else{
            $('#postTambon').children().remove();
            $('#postTambon').append("<option value='เลือกตำบล'>- เลือกตำบล -</option>");
        }
    });
    $("#postLocation select[name='tambon']").change(function(){
        codeAddress($(this).val(),"t");
    });
      
    //FORM FUNCTION     
    function topicz(my){
        var topic = my.val().trim();
        var ct = topic.length;
        if(topic == ""){
            my.next('.warning').text("ใส่หัวข้อประกาศด้วยครับ !");
            return false;
        }
        else if(ct < 5){
            my.next('.warning').text("หัวข้อควรมากกว่า 5 ตัวอักษรครับ !");
            return false;
        }else{
            my.next('.warning').text('');
            return true;
        }
    }
    function select(my){
        var data = my.val();
        if(data == "เลือกประเภทประกาศ" || data =="เลือกประเภทสินทรัพย์"){
            if(data == "เลือกประเภทประกาศ"){
                my.next('.warning').text("เลือกประเภทประกาศด้วยครับ !");
            }else{
                my.next('.warning').text("เลือกประเภทสินทรัพย์ด้วยครับ !");
            }
            return false;
        }else{
            my.next('.warning').text('');
            return true;
        }
    }
    function price(my){
        var data = my.val().trim();
        var rs = isNaN(data);
        if(data== ""){
            my.next().next('.warning').text("กรุณาระบุราคาทรัพย์สิน!");
            return false;
        }
        else if(rs){
            my.next().next('.warning').text("กรุณาระบุราคาด้วยตัวเลข !");
            return false;
        }else{
            my.next().next('.warning').text('');
            return true;
        }
    }
    function thai(my){
        var data = my.val();
        if(data == "เลือกตำบล" || data =="เลือกอำเภอ" || data =="เลือกจังหวัด"){
            if(data=="เลือกตำบล"){
                my.next('.warning').text("กรุณาเลือกตำบล !");
            }else if(data =="เลือกอำเภอ"){
                my.next('.warning').text("กรุณาเลือกอำเภอ !");
            }else if(data =="เลือกจังหวัด"){
                my.next('.warning').text("กรุณาเลือกจังหวัด !");
            }else{
                my.next('.warning').text('');
            }
            return false;
        }else{
            return true;
        }
    }
    function latitude(my){
        var data = my.val().trim();
        if(data == ""){
            $('#war_map').text('ต้องระบุตำแหน่งในแผนที่ !');
            return false;
        }else{
            $('#war_map').text('');
            return true();
        }
    }
    function nCon(my){
        var data = my.val();
        if(data ==""){
            my.next('.warning').text('ใส่ชื่อสำหรับติดต่อสอบถามด้วยครับ !');
            return false;
        }

        else{
            my.next('.warning').text('');
            return true;
        }

    }
    function tCon(my){
        var data = my.val().trim();
        var rs1 = /^08\d{8}$/.test(data);
        var rs2 = /^0[0-7,9]\d{7}$/.test(data);
        if(rs1 || rs2){
            my.next('.warning').text('');
            return true;
        }
        else{
            my.next('.warning').text('รูปแบบเบอร์โทรไม่ถูกต้องครับ !');
            return false;
        }
    }
    function eCon(my){
        var data = my.val().trim();
        if(data == ''){
            my.next('.warning').text('ระบบต้องการ email ของคุณเพื่อส่งคำถามจากผู้สนใจทรัพย์สิน !');
        }
        else{
            $.post('check/check_email.php', {
                email : data
            }, function(response){
                if(response==0){
                    my.next('.warning').text('รูปแบบอีเมล์ไม่ถูกต้องครับ !');
                }else if(response==1){
                    my.next('.warning').text('');
                }
            }); 
            return true;
        }
        return false;
    }
    
    function pro(my){
        var data = my.val();
        if(data == '' || data == 'เลือกจังหวัด'){
            my.next('.warning').text('กรุณาเลือกจังหวัดด้วยครับ !');
        }else{
            my.next('.warning').text('');
        }
    }
    function amp(my){
        var data = my.val();
        if(data == '' || data == 'เลือกอำเภอ'){
            my.next('.warning').text('กรุณาเลือกอำเภอด้วยครับ !');
        }else{
            my.next('.warning').text('');
        }
    }
      
    $('#topic').blur(function(){
        topicz($(this));
    });
    $('#data_class,#data_type').blur(function(){
        select($(this));
    });
    $('#postPrice').blur(function(){
        price($(this));
    })
    $('#postName').blur(function(){
        nCon($(this));
    });
    $('#postEmail').blur(function(){
        eCon($(this));
    });
    $('#postTel').blur(function(){
        tCon($(this));
    });
    $('#postProvince').blur(function(){
        pro($(this));
    });
    $('#postAmphur').blur(function(){
        amp($(this));
    });
    
    $('#submitPost').click(function(){

        //1
        var user_id = $('#user_id').val();
        var topic = $('#topic').val();
        var data_class = $('#data_class').val();
        var data_type = $('#data_type').val();
        var postPrice = $('#postPrice').val();
        var unit = $('#unit').val();
        var rai = $('#rai').val();
        var ngan = $('#ngan').val();
        var tarang = $('#tarang').val();
        //2
        var postAddress = $('#postAddress').val();
        var postRoad = $('#postRoad').val();
        var postSoy = $('#postSoy').val();
        var postProvince = $('#postProvince').val();
        var postAmphur = $('#postAmphur').val();
        var postTambon = $('#postTambon').val();
        var marker_lat = $('#marker_lat').val();
        var marker_lng = $('#marker_lng').val();
        var locationData = $('#locationData').val();
        //3
        var img1= $('#img_area').find('img').eq(0).attr('alt');
        var img2= $('#img_area').find('img').eq(1).attr('alt');
        var img3= $('#img_area').find('img').eq(2).attr('alt');
        var img4= $('#img_area').find('img').eq(3).attr('alt');
        var img5= $('#img_area').find('img').eq(4).attr('alt');
        if(img1 == undefined){
            img1="";
        }
        if(img2 == undefined){
            img2="";
        }
        if(img3 == undefined){
            img3="";
        }
        if(img4 == undefined){
            img4="";
        }
        if(img5 == undefined){
            img5="";
        }
        //4
        var detailArea = $('#detailArea').val();
        //5
        var postName = $('#postName').val();
        var postEmail = $('#postEmail').val();
        var postTel = $('#postTel').val();
            
        //6
        var status = 0;
        var usable  = $('#usable').attr('checked');
        if(usable == 'checked'){
            status = 1;
        }
        
        //check
        var topicT = topicz($('#topic'));
        var data_classT = select($('#data_class'));
        var data_typeT = select($('#data_type'));
        var priceT = price($('#postPrice'));
        var postNameT = nCon($('#postName'));
        var postEmailT = eCon($('#postEmail'));
        var postTelT = tCon($('#postTel'));
        var provinceT = $('#postProvince').val();
        var amphurT = $('#postAmphur').val();
        var lat = $('#marker_lat').val().trim();
        var lng = $('#marker_lng').val().trim();
        if(topicT === true && data_classT === true && data_typeT === true && priceT === true && postNameT ===true && postEmailT != '' && postTelT === true){
            if(provinceT != 'เลือกจังหวัด' && amphurT != 'เลือกอำเภอ'){
                $('#postAmphur').next('.warning').text('');
                if(lat != '' && lng !=''){
                    $('.warning').text('');
                   
                    $.ajax({
                        type:"POST",
                        url:"check/get_post.php",
                        data:"topic=" + topic + "&data_class=" + data_class + "&data_type=" + data_type +"&postPrice=" +postPrice +"&unit=" +unit  +"&rai=" +rai
                        + "&ngan="+ngan+"&tarang="+tarang+"&postAddress="+postAddress +"&postRoad=" + postRoad +"&postSoy=" +postSoy +"&postProvince="+postProvince
                        + "&postAmphur=" +postAmphur +"&postTambon="+postTambon +"&marker_lat=" + marker_lat+"&marker_lng=" + marker_lng + "&locationData="+locationData
                        + "&detailArea=" + detailArea +"&postName=" +postName + "&postEmail=" +postEmail+"&postTel=" +postTel+"&user_id=" +user_id+"&status=" +status
                        + "&img1=" + img1 + "&img2=" +img2+"&img3=" +img3 + "&img4=" +img4 +"&img5=" +img5,
                        success:function(response){
                            if(response==1){
                                alert('คุณได้ลงประกาศเรียบร้อยแล้ว !');
                                window.location ="index.php";
                            }
                        }
                    });
                }else{
                    alert('ต้องระบุตำแหน่งในแผนที่ ด้วยครับ !');
                }
            }else{
                if(provinceT == 'เลือกจังหวัด' || provinceT == ''){
                    $('#postProvince').next('.warning').text('กรุณาเลือกจังหวัดด้วยครับ !');
                    
                }else if(amphurT == 'เลือกอำเภอ' || amphurT == ''){
                    $('#postProvince').next('.warning').text('');
                    $('#postAmphur').next('.warning').text('กรุณาเลือกอำเภอด้วยครับ !');
                }
            }
        }else{
            if(topicT === false){
                $('#topic').focus();
            }else if(data_classT === false){
                $('#data_class').focus();
            }else if(data_typeT === false){
                $('#data_type').focus();
            }else if(priceT === false){
                $('#postPrice').focus();
            }else if(provinceT == '' || provinceT == 'เลือกจังหวัด'){
                $('#postProvince').focus();
            }else if(amphurT == '' || amphurT == 'เลือกอำเภอ'){
                $('#postAmphur').focus();
            }else if(postNameT === false){
                $('#postName').focus();
            }else if(postEmailT === false){
                $('#postEmail').focus();
            }else if(postTelT === false){
                $('#postTel').focus();
            }
        }

    });
});
