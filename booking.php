<?php
	session_start();
	if(isset($_POST["select"]) && $_POST['seats']){
        var_dump($_POST);
	    $trainNo=$_POST['select'];
        $date = date('M-d-Y');
        $seat = $_POST['seats'];
        $id = $_SESSION['id'];
        $status = 'queued';
        $conn = oci_connect("root", "root", "localhost/XE");
        $query2 = "select c_id from customer where phoneno = '$id'";
        $result2 = oci_parse($conn, $query2);
        oci_execute($result2);
        $row2 = oci_fetch_array($result2,OCI_BOTH);
        $cid = $row2[0];
        $_SESSION['cid']=$cid;
        //$status = 'queued';
        settype($seat,'integer');
        settype($cid,'integer');
        $sql = "CALL bookTicket(:p1,:p2, :p3, :p4, :p5)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p1',$trainNo);
        oci_bind_by_name($result, ':p3',$seat, OCI_B_INT);
        oci_bind_by_name($result, ':p2',$cid, OCI_B_INT);
        oci_bind_by_name($result, ':p4',$date);
        oci_bind_by_name($result, ':p5',$status);
        oci_execute($result);
        
	}
	header("location:showbill.php");
    //var_dump($_POST);
	
?>
