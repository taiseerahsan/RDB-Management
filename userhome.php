<html>
    <head>
     
        <style>
            body 
            {
                background-image: url("images/home.jpg");
                font-family: sans-serif;
                color: darkred;
                font-style: normal;   
            }
            
            
            .menu-bar 
            {    
                display: flex;
                margin-left: -10px;
                margin-top: -8px;
                width: 100%;
                border: 0px solid white;
                padding: 1% 1% 1% 1%;
                background-color: rgba(255, 255, 255, .5);
                flex-flow: row-reverse;
                            
            }
            
            .logout 
            {
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -0.3% -1% -1%;
            }
            .admin 
            {
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
            }
            .user 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            .show-cart
            {
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }
            .profile
            {
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }
            
            
           a
            {
                text-decoration: none;
                color: #c70ddc;
            }
            a:hover
            {
                text-decoration: none;
                color: orange;
            }

            
            table 
            {
                border-collapse: separate;
                border-radius: 3px;
                text-align:center;
                margin-left:260px
            }
            table, th, td
            {
                border: 1px solid white;
            }
            tr:nth-child(even)
            {
                background-color: rgba(242, 242, 242, 0.81);;
                color: #37298e;
            }
            tr:nth-child(odd)
            {
                background-color: rgba(242, 242, 242, 0.81);;
                color: #37298e;
            }
            tr:nth-child(1)
            {
                font-weight: bold;
                font-size:16px;
                background-color:#26c3c2;
                color:white;
            }
            input[type=submit] 
            {
                cursor: pointer;
                width: 23%;
                height: 24px;
                background-color: #42ef4d;
                border: 0;
                color: azure;
                font-size: 16;
                font-weight: bold;
            }
            input[type=text] 
            {
                margin-right: 8px;
                width: 67%;
                
            }
        </style>
    </head>
    <body>
<?php
session_start();
    if(isset($_SESSION['id']))
	{
       
	}

	else
    {
		header("Location:login.php");
	}
        
    echo " <div class='menu-bar'>";    
    echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
    echo "<div class='show-cart'><a href='viewcart.php'>Cart</a></div>";
    echo "<div class='profile'><a href='profile.php'>Profile</a></div>"; 
    if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
    {
        
        
        echo "<div class='admin'><a href='addtrainview.php'>Admin</a></div>";
        echo "<div class='user'><a href='userdetails.php'>Users</a></div>";
        
       
    }  
    
     echo "</div>";
    $conn = oci_connect("root", "root", "localhost/XE");
    $date = date('M-d-Y');
        
    $sql = "select r_date from reservation where r_date = '$date'";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    $row0 = oci_fetch_array($result,OCI_BOTH);
    //var_dump ($row0);

    if($row0[0]== $date)
    {
        $flag=0;
       global $sql2;
        $sql2 = "select train_details.*,totalseats - reserved as remaining  from train_details,(select  t_no, sum(seatreserved) as reserved from reservation where r_date ='$date' group by t_no ) where t_no = trainno";
       global $result2;
        $result2= oci_parse($conn, $sql2);
       oci_execute($result2);
        global $sql3;
        $sql3 = "SELECT train_details.*, train_details.totalseats as remaining FROM train_details WHERE trainno NOT IN (SELECT t_no FROM reservation where r_date= '$date')";
        global $result3;
        $result3= oci_parse($conn, $sql3);
        oci_execute($result3);

    }
    else
    {
        $sql2 = "select train_details.*,train_details.totalseats as remaining  from train_details";
        $result2 = oci_parse($conn, $sql2);
        oci_execute($result2); 
        $flag=1;
    }



    echo "<h1 style='text-align:center'>Train Details for $date</h1>";
    echo "<table border=1; style='text-align:center;margin-left: 50;' align:'center' cellspacing=0px; cellpadding=10px>";
    echo "<tbody >";
    echo "<tr width = '500px'>";
        echo "<td> Train No</td>";
        echo "<td> Train Type </td>";
        echo "<td> Origin </td>";
        echo "<td> Destination </td>";
        echo "<td> Departure Time </td>";
        echo "<td> Arrival Time </td>";
        echo "<td> Seat Price </td>";
        echo "<td> Total Seats </td>";
        echo "<td> Remaining Seats </td>";
        echo "<td> Buy Tickets </td>";
    echo "</tr>";
    while($row = oci_fetch_array($result2,OCI_ASSOC))
    {
        echo "<tr>";
        foreach($row as $item )
        {
            echo "<td>".$item."</td>";
        }
        echo "<td>";
            echo "<form action='cart.php' method='post' style='margin-bottom: 0em; text-align: center;'>";
            echo "<input type='hidden' name='select' value='".$row['TRAINNO']."'>";
            echo "<input type='text' name='seats'>";
            echo "<input type='submit' value='Enter'>";
            echo "</form>";
        echo "</td>";
        echo "<tr>";
    }
    if($flag==1)
    {


    }
    else
    {
         while($row12 = oci_fetch_array($result3,OCI_ASSOC))
            {
                echo "<tr>";
                foreach($row12 as $item )
                {
                    echo "<td>".$item."</td>";
                }
                echo "<td>";
                    echo "<form action='cart.php' method='post' style='margin-bottom: 0em; text-align: center;'>";
                    echo "<input type='hidden' name='select' value='".$row12['TRAINNO']."'>";
                    echo "<input type='text' name='seats'>";
                    echo "<input type='submit' value='Enter'>";
                    echo "</form>";
                echo "</td>";
                echo "<tr>";
            }
    }
    echo "<tbody>"; 
    echo "</table>";

oci_close($conn);
        

?>
    </body>
</html>