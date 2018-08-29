<?php
	session_start();
	if(isset($_POST["update-user"]) && isset($_POST["phone"]))
    {
    var_dump($_POST);

	$status=$_POST['update-user'];
    $phone=$_POST['phone'];
    
        
        $conn = oci_connect("root", "root", "localhost/XE");
        $sql = "CALL updateUserStatus(:p1,:p2)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p1',$phone);
        oci_bind_by_name($result, ':p2',$status);
        
        oci_execute($result);
        $_SESSION['alert']="User Type Updated";
        //header("location:userdetails.php");
        
	}
	
	header("location:userdetails.php");
?>