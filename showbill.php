<html>
    <head>
        <style>
            body
            {
                background-color: #ffb64e;
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
            .show-cart
            {
                float: right;
                border: 1px solid #b9b4b4;
                padding: 1%;
                margin: -1% 1% -1% -1%;
                text-align: center;
            }
            .profile
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
                margin-left:36%;
                margin-top: 0px;
                text-align:center;
            }
            table
            {
                border: 2px dotted black;
            }
            td
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
               background-color: #6feca5;
                color: black;
            }
        
        
        </style>
        
    
    </head>
    <body>
        	
<?php
	session_start();
    //var_dump($_SESSION);
    unset($_SESSION['cart']);
    
   
	if(isset($_SESSION['cid']))
	{
        $conn = oci_connect("root", "root", "localhost/XE");
        
            echo " <div class='menu-bar'>";  
            echo "<div class='logout'><a href='logout.php'>Logout</a></div>";
            echo "<div class='show-cart'><a href='viewcart.php'>Cart</a></div>";
            echo "<div class='profile'><a href='profile.php'>Profile</a></div>";
	    echo "<div class='buy'><a href='userhome.php'><span>Ticket</span></a></div>";
            if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
            {
                echo "<div class='admin'><a href='addtrainview.php'>Admin</a></div>";
                echo "<div class='user'><a href='userdetails.php'>Users</a></div>";
            }  
            
        echo "</div>";
        echo "<h2 style='text-align:center'>Bill</h2>"; 
		$cid=$_SESSION['cid'];
        
        $conn = oci_connect("root", "root", "localhost/XE");
        
        $sql = "select customer.* ,reservation.seatreserved, reservation.receiptno, reservation.r_date, train_details.trainno, train_details.traintype, train_details.origin, train_details.destination,  train_details.departuretime, train_details.arrivaltime, train_details.seatprice, (train_details.seatprice * reservation.seatreserved) as totalbill from customer, reservation, train_details where customer.c_id=reservation.cid and c_id = ".intval($cid)." and train_details.trainno = reservation.t_no and reservation.status = 'queued' and reservation.r_date='".date('M-d-Y')."'";
        //SELECT * FROM (select * from reservation ORDER BY RECEIPTNO DESC) reservation2 WHERE rownum <= 1 ORDER BY rownum DESC;
        $result  = oci_parse($conn,$sql);   
        oci_execute($result);
         while($row = oci_fetch_array($result,OCI_BOTH)){
             //echo "<div id='$row[8]'>";
         echo "<table border=1; cellspacing=0px; cellpadding=5px; style='text-align:center' id='$row[8]'>";
            echo "<tr>";
                echo "<td colspan=2;>Recipt No</td>";
                echo "<td colspan=2;>Buying Date</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td colspan=2;>".$row[8]."</td>";
                echo "<td colspan=2;>".$row[9]."</td>";
            echo "</tr>";
        
            echo "<tr>";
                echo "<td colspan=2;> Customer Serial </td>";
                echo "<td colspan=2;> Customer Name </td>";
            echo "</tr>";
        
            echo "<tr>";
                echo "<td colspan=2;>".$row[0]."</td>";
                echo "<td colspan=2;>".$row[1]."</td>";
            echo "</tr>";
        
            echo "<tr>";
                echo "<td> Age </td>";
                echo "<td>Gender</td>";
                echo "<td>Phone No</td>";
                echo "<td>Address</td>";        
            echo "</tr>";
        
            echo "<tr>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";               
                echo "<td>".$row[5]."</td>";
            echo "</tr>";   
               
            echo "<tr>";
                
                echo "<td>Train No</td>";
                echo "<td>Train Type</td>";
                echo "<td>Origin</td>";
                echo "<td>Destination</td>";
            echo "</tr>";
            echo "<tr>";
                    
                    echo "<td>".$row[10]."</td>";
                    echo "<td>".$row[11]."</td>";
                    echo "<td>".$row[12]."</td>";
                    echo "<td>".$row[13]."</td>";
                    
            echo "</tr>";
            echo "<tr>";
                echo "<td colspan=2;>Departure Time</td>";
                echo "<td colspan=2;>Arrival Time</td>";
            echo "</tr>";  
            echo "<tr>";
                echo "<td colspan=2;>".$row[14]."</td>";
                echo "<td colspan=2;>".$row[15]."</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>Seat Price</td>";
                echo "<td> Seat Booked</td>";
                echo "<td colspan=2;>Total</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>".$row[16]."</td>";
                echo "<td>".$row[7]."</td>";
                echo "<td colspan=2;>".$row[17]."</td>";
            echo "</tr>";
        echo "</table> <br/>";
             //echo"</div>";
             echo "<form action='updatebillstattus.php' method='post'>";
                    echo "<input type='hidden' name='rno' value='$row[8]'>";
                    echo "<input type='submit' value='Print' class='btn'>";
             echo "</form>";
             
           echo " <script src='jquery.min.js'></script>
                    <script>
                        $('.btn').click(function(){
                            var printkon = document.getElementById('$row[8]');
                            
                            var winkon = window.open('','','width=900,height=650');
                            winkon.document.write(printkon.outerHTML);
                            winkon.document.close();
                            winkon.focus();
                            winkon.print();
                            winkon.close();
                        });
                    </script>";

             
         }
	}	
?>
	

    </body>
</html>
