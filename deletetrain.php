<?php
	session_start();
    
	if(isset($_POST['train']))
	{
		$trainNo=$_POST['train'];
        
        $conn = oci_connect("root", "root", "localhost/XE");
        
        $sql = "CALL deleteTrainInfo(:p1)";
        $result  = oci_parse($conn,$sql);
        
        oci_bind_by_name($result, ':p1',$trainNo);
   
        oci_execute($result);
        $_SESSION['alert']="Train Info Deleted";
		
	 
	}
	header("location:addtrainview.php");
	
?>