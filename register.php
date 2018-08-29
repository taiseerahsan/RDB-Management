<?php
	session_start();
	if($_POST["name"] !='' && $_POST["age"] !='' && $_POST["gen"] !='' && $_POST["phone"] !='' && $_POST["add"] !='' && $_POST["pass"] !=''){
        var_dump($_POST);

	$name=$_POST['name'];
    $age=$_POST['age'];
    $gen=$_POST['gen'];
    $phone=$_POST['phone'];
    $add=$_POST['add'];
    $pass=$_POST['pass'];
    
        $conn = oci_connect("root", "root", "localhost/XE");
        $sql0 = "select * from admin";
        $result0 = oci_parse($conn,$sql0);
        oci_execute($result0);
        $row0 = oci_fetch_array($result0,OCI_BOTH);
        if($row0[0] == $phone)
        {
            $_SESSION['alert'] = "existing number";
            header("location:registration.php");
        }
        else if ($row0[1]=='admin')
        {
            $sql1 = "insert into admin values($phone,'user')";
            $result1 = oci_parse($conn,$sql1);
            oci_execute($result1);
            
        }
        else
        {
            $sql1 = "insert into admin values($phone,'admin')";
            $result1 = oci_parse($conn,$sql1);
            oci_execute($result1);
        }
        
        $sql = "CALL customerReg(:p2,:p3, :p4, :p5, :p6, :p7)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p2',$name);
        oci_bind_by_name($result, ':p3',$age);
        oci_bind_by_name($result, ':p4',$gen);
        oci_bind_by_name($result, ':p5',$phone);
        oci_bind_by_name($result, ':p6',$add);
        oci_bind_by_name($result, ':p7',$pass);
        oci_execute($result);
        $_SESSION['alert']="Registration Successful";
        header("location:login.php");
        
	}
	else
    {
        $_SESSION['alert']="Fill up every fileds";
        header("location:registration.php");
    }
	
?>