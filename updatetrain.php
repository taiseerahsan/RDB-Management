<?php
	session_start();
	//if($_POST["select-train"] && isset($_POST["up-trainno"]) && isset($_POST["up-traintype"]) && isset($_POST["up-origin"]) && isset($_POST["up-destination"]) && isset($_POST["up-dtime"]) && isset($_POST["up-atime"]) && isset($_POST["up-seatprice"]) && isset($_POST["up-totalseat"])){
    if($_POST["select-train"]!='' && $_POST["up-trainno"]!='' && $_POST["up-traintype"]!='' && $_POST["up-origin"]!='' && $_POST["up-destination"]!='' && $_POST["up-destination"]!='' && $_POST["up-dtime"]!='' && $_POST["up-atime"]!='' && $_POST["up-seatprice"]!='' && $_POST["up-totalseat"]!='')
    {
        $selettrain = $_POST["select-train"];
        $trainno = $_POST["up-trainno"];
        $traintype = $_POST["up-traintype"];
        $origin = $_POST["up-origin"];
        $destinantion = $_POST["up-destination"];
        $dtime = $_POST["up-dtime"];
        $atime = $_POST["up-atime"];
        $seatprice = $_POST["up-seatprice"];
        $totalseat = $_POST["up-totalseat"];
        
        $conn = oci_connect("root", "root", "localhost/XE");
        $sql = "CALL updateTrainInfo(:p0, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p0',$selettrain);
        oci_bind_by_name($result, ':p1',$trainno);
        oci_bind_by_name($result, ':p2',$traintype);
        oci_bind_by_name($result, ':p3',$origin);
        oci_bind_by_name($result, ':p4',$destinantion);
        oci_bind_by_name($result, ':p5',$dtime);
        oci_bind_by_name($result, ':p6',$atime);
        oci_bind_by_name($result, ':p7',$seatprice, OCI_B_INT);
        oci_bind_by_name($result, ':p8',$totalseat, OCI_B_INT);
        oci_execute($result);
        
        //var_dump($_POST);
       $_SESSION['alert']="Train Info Updated";
        header("location:addtrainview.php");
	}
	
    else
    {
        $_SESSION['alert']="Missing some fields";
        header("location:addtrainview.php");
    }
	

?>
