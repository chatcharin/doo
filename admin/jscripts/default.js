
$(document).ready(function(){
    $('#submitPro').click(function(){
        var name = $('#name').val();
        var type = $('#type').val();
        var title = $('#title').val();
        var price = $('#price').val();
        var manage = $('#manage').val();
        var tel = $('#tel').val();
        var web = $('#web').val();
        var email = $('#email').val();
        var feature = $('#feature').val();
        var description = $('#description').val();
        var amphur = $('#e_amphur').val();
        var province = $('#e_province').val();
        var upload = $('#img_area1').find('img').attr('alt');
        var num =  $('#img_area').find('img').length;
        var i;
        var aImg = new Array();
        var mydata='';
        for(i=0;i<num;i++){
            aImg[i] = $('#img_area').find('img').eq(i).attr('alt');
            if(aImg[i] == undefined){
                aImg[i]="";
            }else{
                mydata +="&img"+i.toString()+"=" +aImg[i] ;
            }
                
        }
        if(province=='เลือกจังหวัด')
            province ='';
        if(amphur == 'เลือกอำเภอ')
            amphur='';
        
        $.ajax({
            type:"POST",
            url : "add_Project2.php",
            data:"name=" + name + "&type=" + type + "&title=" + title + "&price=" + price
            + "&manage=" + manage + "&tel=" + tel + "&web=" +web + "&email=" +email
            + "&feature=" + feature + "&description=" + description +"&upload=" +upload
            + mydata+"&num=" + num +"&amphur=" + amphur + "&province="+province,
            success: function(){
                window.location="add_Project.php";
            }
        });
    });
});
