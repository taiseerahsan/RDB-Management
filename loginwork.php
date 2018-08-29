<?php
	session_start();
	if($_POST["id"]!='' && $_POST["pass"]!='')
	{
       
        
        //var_dump($_POST);
		$id = $_POST["id"];
		$pass = $_POST["pass"];
        $conn = oci_connect("root", "root", "localhost/XE");
        
        
        
        
        
        
		$query = "select pass from customer where phoneno = '$id'";
        $query2 = "select phoneno from customer where phoneno = '$id'";
        $result = oci_parse($conn, $query);
        $result2 = oci_parse($conn, $query2);
		oci_execute($result);
        oci_execute($result2);
		$row = oci_fetch_array($result,OCI_BOTH);
        $row2 = oci_fetch_array($result2,OCI_BOTH);
	    
        if($id=="")
        {
            $_SESSION['alert']= "Please enter ID(Phone Number)";   
        }
        else
        {
           if(oci_num_rows($result2)>0)
            {
                if($pass=="")
                {
                    $_SESSION['alert']= "Please enter Password";
                }
                else 
                {
                    if($row[0]==$pass)
                    {
                        $_SESSION['id'] = $id;
                        $sql0 = "select status from admin where phone = $id";
                        $result0 = oci_parse($conn,$sql0);
                        oci_execute($result0);
                        $row0 = oci_fetch_array($result0,OCI_BOTH);
                        if($row0[0]=='admin')
                        {
                            $_SESSION['utype'] = $row0[0];
                            header("Location:addtrainview.php");
                        }
                        else
                        {
                            $_SESSION['utype'] = $row0[0];
                            header("Location:userhome.php");
                        }
                        
                    }
                    else
                    {			
                        $_SESSION['alert']= "Wrong Password";
                    }
                }
            }
            else
            {
                $_SESSION['alert']= "Wrong id";
            }
            
        }
        
		//header("Location:login.php");
	}
    else
    {
        $_SESSION['alert']= "Enter Id Password";
        
    }
header("Location:login.php");
?>
