<?php
	session_start();
    //$con = mysqli_connect("localhost", "root", "", "srest");
    //echo "<a href='userhome.php'>User</a>";
    if(isset($_SESSION['cart']))
    {
        $id = $_POST['select'];
        $seats = $_POST['seats'];
        for($i=0;$i<count($_SESSION['cart']);$i++)
        {
            echo $i;
            
            if($_SESSION['cart'][$i]['id']==$id)
            {
                $q = intval($_SESSION['cart'][$i]['seats']);
                $q =$q + intval($seats);
                $_SESSION['cart'][$i]['seats']=strval($q); 
                header("location:userhome.php");
                var_dump($_SESSION['cart']);
                return;
                
            }
            else if($i==count($_SESSION['cart'])-1)
            {
                $cart = array("id"=>$id,"seats"=>$seats);
                array_push($_SESSION['cart'], $cart);
                var_dump($_SESSION['cart']);
                header("location:userhome.php");
                return;
            }
            
        }
        
        
    }
    else{        
	if(isset($_POST['select']) && isset($_POST['seats']) )
	{
        $_SESSION['cart'] = array();
        
        $id = $_POST['select'];
        $seats = $_POST['seats'];
        $cart = array("id"=>$id,"seats"=>$seats);
        array_push($_SESSION['cart'], $cart);
        var_dump($_SESSION['cart']);  
        header("location:userhome.php");   
        
	
	}
    }

?>


