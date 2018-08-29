<?php
	session_start();
   
  if($_POST['up-name']!='' && $_POST['up-age']!='' && $_POST['up-gender']!='' && $_POST['up-pass']!='' && $_POST['up-add']!='')
  {

	$name=$_POST['up-name'];
    $age=$_POST['up-age'];
    $gen=$_POST['up-gender'];
    $phone=$_SESSION['id'];
    $add=$_POST['up-add'];
    $pass=$_POST['up-pass'];
        
        $conn = oci_connect("root", "root", "localhost/XE");
        
        
        $sql = "CALL updateCustomerInfo(:p1,:p2, :p3, :p4, :p5, :p6)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p1',$name);
        oci_bind_by_name($result, ':p2',$age);
        oci_bind_by_name($result, ':p3',$gen);
        oci_bind_by_name($result, ':p4',$phone);
        oci_bind_by_name($result, ':p5',$add);
        oci_bind_by_name($result, ':p6',$pass);
        oci_execute($result);
        $_SESSION['alert']= "Information Updated";
	}
    else
    {
        $_SESSION['alert']= "Missing Feilds";
    }
	header("location:profile.php");
	
?>


