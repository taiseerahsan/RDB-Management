<html>
	<head>
		<title>
			User Profile
		</title>
        <style>
            body
            {
                background-image: url("images/admin.jpg");
                font-family: sans-serif;
                color: white;
                font-style: normal;
                            
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
            
            .admin 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% -1% -1% -1%;
            }
            .user 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            
            .buy 
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% 1%;
            }
            .show-cart0
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
                margin-left:300px;
                margin-top: 80px;
                text-align:center;
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
            td:nth-child(1)
            {
                background-color: #89a8ea;
                color: black;
            }
            input[type=submit] 
            {
                cursor: pointer;
                width: 100%;
                height: 30px;
                background-color: #42ef4d;
                border: 0;
                color: azure;
                font-size: 15px;
                font-weight: bold;
            }
            input[type=text] 
            {
                margin-bottom: 8px;
            }
            form
            {
                    margin-left: 60%;
                    margin-top: -245;
                    
            }
            fieldset
            {
                background-color: #272727;
                border: 1px white;
                
            }
            
        </style>
	</head>
	<body>
<?php

            session_start();
            
            $conn = oci_connect("root", "root", "localhost/XE");
        
            echo " <div class='menu-bar'>";  
            echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
                
            if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
            {

                
                echo "<div class='show-cart0'><a href='viewcart.php'>Cart</a></div>";
                echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
                echo "<div class='admin'><a href='addtrainview.php'>Admin</a></div>";
                echo "<div class='user'><a href='userdetails.php'>Users</a></div>";


            }  
            else
            {

                echo "<div class='show-cart0'><a href='viewcart.php'>Cart</a></div>";
                echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
            }
            
            
            echo "</div>";
            if (!$conn) {
               $m = oci_error();
               echo $m['message'], "\n";
               exit;
            }
            else 
            {
                $phone = $_SESSION['id'];
               $result = oci_parse($conn, "select c_name, age, gender, phoneno, address from customer where phoneno = $phone");
                oci_execute($result);
                 $row = oci_fetch_array($result,OCI_BOTH);
                echo "<h2 style='text-align:center'>Profile</h2>";
                echo "<table border=1; align:'center' cellspacing=0px; cellpadding=10px;>";
                echo "<tbody>";
                
                    echo "<tr>";
                        echo "<td><b> Name </b></td>";
                        echo "<td>".$row[0]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                         echo "<td><b> Age </b></td>";
                        echo "<td>".$row[1]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td><b> Gender </b></td>";
                        echo "<td>".$row[2]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td><b> Phone No. </b></td>";
                        echo "<td>0".$row[3]."</td>";
                   echo "</tr>";
                    echo "<tr>";
                        echo "<td><b> Address </b></td>";
                        echo "<td>".$row[4]."</td>";                      
                    echo "</tr>";
                echo "<tbody>";
                echo "</table>";
                
    
          }
    ?>
               <form method="post" action="updateuser.php">
						
						<fieldset style="width:10%">
							<legend><b><font>Change Your Info</font></b></legend>
                            
                            Name <br/>
							<input type="text" name="up-name"><br/>
                            Age<br/>
							<input type="text" name="up-age"><br/>
                            Gender<br/>
							<input type="text" name="up-gender"><br/>
                            Address<br/>
							<input type="text" name="up-add"><br/>
                            Password<br/>
							<input type="password" name="up-pass"><br/>
                            
                            <br/>
							<input type="Submit" value="Enter">
						</fieldset>             
					</form>	
				
<?php
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