<html>
	<head>
		<title>
			User Details
		</title>
        <style>
            body
            {
                background-image: url("images/admin.jpg");
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
            .profile
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }
            .admin 
            {
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -1% -1% -1%;
                float: right;
            }
            
            .logout 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -0.3% -1% -1%;
            }
            
            .buy 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            .show-cart
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }        
            a
            {
                text-decoration: none;
                color: greenyellow;
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
                background-color: #89a8ea;
                color: black;
            }
            input[type=submit] 
            {
                cursor: pointer;
                width: 47%;
                height: 30px;
                background-color: #42ef4d;
                border: 0;
                color: azure;
                font-size: 15px;
                font-weight: bold;
            }
            
            
            
        </style>
	</head>
	<body>
<?php

            session_start();
            
            $conn = oci_connect("root", "root", "localhost/XE");
            echo " <div class='menu-bar'>";  
            echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
            echo "<div class='show-cart'><a href='viewcart.php'>Cart</a></div>";
            echo "<div class='profile'><a href='profile.php'>Profile</a></div>";
            echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
            echo "<div class='admin'><a href='addtrainview.php'>Admin</a></div>";
            
            echo "</div>";
            if (!$conn) {
               $m = oci_error();
               echo $m['message'], "\n";
               exit;
            }
            else 
            {
               $result = oci_parse($conn, 'select c_id, c_name, age, gender, phoneno, address, status from customer,admin where phoneno = phone order by c_id asc');
                oci_execute($result);
                echo "<h2>Customer Details</h2>";
                echo "<table border=1; align:'center' cellspacing=0px; cellpadding=10px;>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td><b> ID </b></td>";
                echo "<td><b> Name </b></td>";
                echo "<td><b> Age </b></td>";
                echo "<td><b> Gender </b></td>";
                echo "<td><b> Phone No. </b></td>";
                echo "<td><b> Address </b></td>";
                echo "<td><b> User Type </b></td>";
                echo "<td><b> Update User Type </b></td>";
                echo "</tr>";
                while($row = oci_fetch_array($result,OCI_BOTH))
                {
                    
                    echo "<tr>";
                        echo "<td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        echo "<td>".$row[2]."</td>";
                        echo "<td>".$row[3]."</td>";
                        echo "<td>0".$row[4]."</td>";
                        echo "<td>".$row[5]."</td>";
                        echo "<td>".$row[6]."</td>";
                    
                        echo "<td>";
                            echo "<form action='changeuserstatus.php' method='post' style='margin-bottom:0px'>";
                            echo "<select name='update-user'>";
                            echo "<option value='user'>User</option>";
                            echo "<option value='admin'>Admin</option>";
                            echo "<option value='staff'>Staff</option>";
                            echo "</select> &nbsp";
                        
                            echo "<input type='hidden' name='phone' value='".$row[4]."'>";
                            echo "<input type='submit' value='Update'>";
                            echo "</form>";
                        echo  "</td>";
                    echo "</tr>";
                }
                echo "<tbody>";
                echo "</table>";
    
          }
        if(isset($_SESSION['alert']))
               {
                   echo "<script type='text/javascript'>";
                    echo "alert('".$_SESSION['alert']."')";
                    echo '</script>';
                   unset ($_SESSION['alert']);
                   
               }

oci_close($conn);
?>
    </body>
</html>