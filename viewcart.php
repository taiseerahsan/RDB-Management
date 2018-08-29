<html>
    <head> 
    
    <style>
        body
            {
                background-image: url("images/cart.jpg");
                font-family: sans-serif;
                color: whitesmoke;
                font-style: normal;
                text-align:center;
                
            }
            .menu-bar 
            {           
                display: inline-block;
                margin-left: -10px;
                margin-top: -8px;
                width: 100%;
                border: 0px solid white;
                padding: 1% 1% 1% 1%;
                background-color: rgba(255, 255, 255, .5);
                            
            }
            .bill
            {
                margin-right: -7px;
                float: right;
                width: 10%;
                border: 1px solid white;
                padding: 1% 1% 1% 1%;
                background-color: rgba(255, 255, 255, .5);
            }
            .logout 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -0.3% -1% -1%;
            }
            .profile
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }
            .show-cart
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }  
            .buy 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            .user 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            .admin 
            {
                float: right;   
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -1% -1% -1%;
            }
            
             a
            {
                text-decoration: none;
                color: greenyellow;
            }
            .show-cart a
            {
                text-decoration: none;
                color: red;
            }
            a:hover
            {
                text-decoration: none;
                color: ghostwhite;
            }
             table 
            {
                border-collapse: separate;
                border-radius: 3px;
                text-align:center;
                margin-left:450px;
                margin-top:200px;
                               
            }
            table, th, td
            {
                border: 1px solid white;
            }
            tr:nth-child(even)
            {
                background-color: #f2f2f2;
                color: mediumslateblue;
            }
            tr:nth-child(odd)
            {
                background-color: #f2f2f2;
                color: mediumslateblue;
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
                width: 100%;
                height: 30px;
                background-color: #42ef4d;
                border: 0;
                color: azure;
                font-size: 14;
                font-weight: bold;
            }
    </style>
    </head>
    <body>
        
<?php
            session_start();
            $conn = oci_connect("root", "root", "localhost/XE");
            
           if(isset($_SESSION['id']))
            {

            }
            
            else
            {
                header("Location:login.php");
            }
            echo " <div class='menu-bar'>";  
            echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
            echo "<div class='show-cart' style='width: 84.484;'><a href='cancelcart.php'>Cancel Cart</a></div>";
            echo "<div class='profile'><a href='profile.php'>Profile</a></div>";
            echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
            
        if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
            {

                echo "<div class='admin'><a href='addtrainview.php'>Admin</a></div>";
                echo "<div class='user'><a href='userdetails.php'>Users</a></div>";


            }  
            
         echo "</div>";
        
	if(isset($_SESSION['cart']))
	{
        echo "
            <table  height: 100%; border=1; cellspacing=0px; cellpadding=10px;>
        <tr>
        <td>Train No.</td>
        <td>Price</td>
        <td>Quantity </td>
        <td>Total</td>
        <td style='width: 30%; padding:0'>Book</td>
    </tr>";
		 for($i=0;$i<count($_SESSION['cart']);$i++)
         {
             $sql = "select trainno,seatprice from train_details where trainno = '".$_SESSION['cart'][$i]['id']."'";
             $result = oci_parse($conn, $sql);
             oci_execute($result);
             
             while($row = oci_fetch_array($result,OCI_BOTH))
             {
                echo "<tr>";
                    echo "<td>";
                        echo $row[0];
                    echo "</td>";
                echo "<td>";
                        echo $row[1];
                    echo "</td>";
                echo "<td>";
                       echo $_SESSION['cart'][$i]['seats'];
                echo "</td>";
                echo "<td>";
                    echo ($row[1] * $_SESSION['cart'][$i]['seats']);
                echo "</td>";
                
                 echo "<td>";
                 echo "<form action='booking.php' method='post' style='margin-bottom:0px;'>
                    <input type='hidden' name='select' value='".$_SESSION['cart'][$i]['id']."'>
                <input type='hidden' name='seats' value='".$_SESSION['cart'][$i]['seats']."'>
                    <input type='submit' value='Book'>
                    </form>";
                echo "</td>";
                echo "</tr>";
                
                


            }
             
         }
        echo "</table>";
		
	}
        else
        {
            
            
             $sql2 = "select status from reservation where cid = (select c_id from customer where phoneno='".$_SESSION['id']."')";
             $result2 = oci_parse($conn, $sql2);
             oci_execute($result2);
             $row2 = oci_fetch_array($result2,OCI_BOTH);
            if($row2[0]=='queued')
            {
                echo "<a href='showbill.php'><div class=bill>Bill</div></a>";
                
            }
            echo "<h2 style='text-align:center'>Cart is empty</h2>";
            
        }
?>
        
        
    </body>
</html>
