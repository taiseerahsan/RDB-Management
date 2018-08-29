<html>
	<head>
		<title>
			Admin View
		</title>
        <style>
            body
            {
                background-image: url("images/admin.jpg");
                font-family: sans-serif;
                color: whitesmoke;
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
                margin: -1% -1% -1% 1%;
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
            input[type=submit] 
            {
               cursor:pointer;
                width: 100%;
                height: 34px;
                background-color: #42ef4d;
                border:0;
                color: azure;
                font-size: 16;
                font-weight: bold;
            }
            #delete 
            {
               cursor:pointer;
                width: 100%;
                height: 34px;
                background-color: #f73131;
                border:0;
            }
            input[type=text] 
            {
                margin-bottom: 8px;
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
                            
            
            if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
            {

            }
            else if(isset($_SESSION['id']) && $_SESSION['utype']=="user")
            {
               header("Location:userhome.php");
            }
            
            else
            {
                header("Location:login.php");
            }
            echo " <div class='menu-bar'>";  
            echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
            echo "<div class='show-cart'><a href='viewcart.php'>Cart</a></div>";
            echo "<div class='profile'><a href='profile.php'>Profile</a></div>";
            echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
            echo "<div class='user'><a href='userdetails.php'>Users</a></div>";
            echo "</div>";
        ?>
        <h2 style="text-align:center">Admin</h2>
        <table height="90%">
            <tr >
                <td width ="500" align='center'>
		<table height="100%" align='center'>
		<tbody>
			<tr width ="500">
				<td>
					<form method="post" action="addtrain.php">
						
						<fieldset>
							<legend><b><font>Add Train Info</font></b></legend>
							
                            Train No<br/>
							<input type="text" name="trainno"><br/>
                            Train type<br/>
							<input type="text" name="traintype"><br/>
                            Origin<br/>
							<input type="text" name="origin"><br/>
                            Destination<br/>
							<input type="text" name="destination"><br/>
                            Departure Time<br/>
							<input type="text" name="dtime"><br/>
                            Arrival Time<br/>
							<input type="text" name="atime"><br/>
                            Seat Price<br/>
							<input type="text" name="seatprice"><br/>
                            Total Seats<br/>
							<input type="text" name="totalseat"><br/>
                            <br/>
							<input type="Submit" value="Enter">
						</fieldset>             
					</form>	
				</td>
			</tr>		
			</tbody>
		</table>
        </td>
        <td width ="500" align='center'>
        <table height="100%" align='center'>
		<tbody>
			<tr width ="500">
				<td>
					<form method="post" action="updatetrain.php">
						
						<fieldset>
							<legend><b><font>Update Train Info</font></b></legend>
                            
                            Select Train: <select name='select-train'>
                            <?php 
                            $conn = oci_connect("root", "root", "localhost/XE");
                            $query = "select trainno from train_details";
                            $result = oci_parse($conn, $query);
                            oci_execute($result);
                            //$row = oci_fetch_array($result,OCI_BOTH);
                            while( $row = oci_fetch_array($result,OCI_BOTH))
                            {
                                echo "<option value='".$row[0]."'>".$row[0]."</option>";   
                            }

                            ?>
                            </select>				
		                    <br/>
                            <br/>
                            Train No<br/>
							<input type="text" name="up-trainno"><br/>
                            Train type<br/>
							<input type="text" name="up-traintype"><br/>
                            Origin<br/>
							<input type="text" name="up-origin"><br/>
                            Destination<br/>
							<input type="text" name="up-destination"><br/>
                            Departure Time<br/>
							<input type="text" name="up-dtime"><br/>
                            Arrival Time<br/>
							<input type="text" name="up-atime"><br/>
                            Seat Price<br/>
							<input type="text" name="up-seatprice"><br/>
                            Total Seats<br/>
							<input type="text" name="up-totalseat"><br/>
                            <br/>
							<input type="Submit" value="Enter">
						</fieldset>             
					</form>	
				</td>
			</tr>		
			</tbody>
		</table>
        </td>
        <td width ="500" align='center'>
        <table height="100%" align='center'>
		<tbody>
			<tr width ="500">
				<td>						
						<fieldset>
							<legend><b><font>Delete Train Info</font></b></legend>
                            
                            
                            <?php 
                            $conn = oci_connect("root", "root", "localhost/XE");
                            $query = "select trainno from train_details";
                            $result = oci_parse($conn, $query);
                            oci_execute($result);
                            echo "<table border='1'>
                                    <tr>
                                        <td> Train No</td>
                                        <td> Delete </td>
                                    </tr>
                            
                            ";
                            
                            while( $row = oci_fetch_array($result,OCI_BOTH))
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo $row[0];
                                echo "</td>";
                                echo "<td>";
                                echo "<form action='deletetrain.php' method='post'>
                                        <input type='hidden' name='train' value='".$row[0]."'>
                                        <input id='delete' type='submit' value='Delete' style='margin-bottom: -15;'>
                                    </form>";
                                echo "</td>";
                                echo "</tr>";   
                            }
                            echo "</table>";

                            ?>
                        
                    </fieldset>
                </td>
			</tr>		
			</tbody>
		</table>
        </td>
        </tr>
        </table>
        <?php
        if(isset($_SESSION['alert']))
               {
                   echo "<script type='text/javascript'>";
                    echo "alert('".$_SESSION['alert']."')";
                    echo '</script>';
                   unset ($_SESSION['alert']);
                   
               }
        ?>
	</body>
<html>