<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
          <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <title>แจ้งปัญหา</title>
          </head>
          <body>
                    <?php
					$date=date("d-m-Y");
                    $time=date("H:i:s");
                    if (isset($_POST['prob_name'], $_POST['prob_email'], $_POST['prob_tel'], $_POST['prob_area'])) {
                              $name = $_POST['prob_name'];
                              $email = $_POST['prob_email'];
                              $tel = $_POST['prob_tel'];
                              $detail = $_POST['prob_area'];
                              include '../config.php';
                              $sql = "insert into tb_problem(name,email,tel,detail,date,time) values('$name','$email','$tel','$detail','$date','$time')";
                              $result = mysql_query($sql);
                              if ($result)
                                        echo "ข้อมูลแจ้งปัญหาของท่านบันทึกเรียบร้อยแล้ว !";
                              print"<meta http-equiv=refresh content=1;URL=../index.php>";
                    }
                    ?>
          </body>
</html>