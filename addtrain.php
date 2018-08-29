<?php
	session_start();
	if($_POST["trainno"] !='' && $_POST["traintype"] !='' && $_POST["origin"] !='' && $_POST["destination"] !=''  && $_POST["dtime"] !=''  && $_POST["atime"] !=''  && $_POST["seatprice"] !=''  && $_POST["totalseat"] !=''){

        $trainno = $_POST["trainno"];
        $traintype = $_POST["traintype"];
        $origin = $_POST["origin"];
        $destinantion = $_POST["destination"];
        $dtime = $_POST["dtime"];
        $atime = $_POST["atime"];
        $seatprice = $_POST["seatprice"];
        $totalseat = $_POST["totalseat"];
        
        $conn = oci_connect("root", "root", "localhost/XE");
        $sql = "CALL addTrainInfo(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p1',$trainno);
        oci_bind_by_name($result, ':p2',$traintype);
        oci_bind_by_name($result, ':p3',$origin);
        oci_bind_by_name($result, ':p4',$destinantion);
        oci_bind_by_name($result, ':p5',$dtime);
        oci_bind_by_name($result, ':p6',$atime);
        oci_bind_by_name($result, ':p7',$seatprice, OCI_B_INT);
        oci_bind_by_name($result, ':p8',$totalseat, OCI_B_INT);
        $p = oci_execute($result);
        $_SESSION['alert']="New Train Info Added";
        
        
	}
    else
    {
        $_SESSION['alert']="Missing fields";
       
    }
	header("location:addtrainview.php");
	

?>
