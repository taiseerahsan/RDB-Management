<html>
	<head>
		<title>
			Registration
		</title>
        <script>
        	function login()
            {
                window.location.href = 'login.php';
            }
        </script>
        <style>
             body {
                background-image: url("images/login.jpg");
                font-family: sans-serif;
                
            }
            a {
                text-decoration: none;
                color:darkslateblue;
                float: right;
            }
            div{
                margin: auto;
                margin-top: 5%;
                width: 25%;
                border: 1px solid white;
                padding: 2% 5% 2% 5%;
                background-color: rgba(255, 255, 255, .5);
                border-radius: 5px;
            }
            input{
                width:100%;
                height: 5%;
            }
            .button{
                
                background-color: #5588db;
                 height: 10%;
                width: 49%;
                color: white;
                font-size: 15;
            }
            button{
                 height: 10%;
                width: 49%;
                background-color: #55db5a;
                color: white;
                font-size: 15;
            }
            h2{
                text-align: center;
            }
        
        </style>
	</head>

	<body background="registration.jpg">
        
        <div>
            <form method="post" action="register.php">
                <h2>Register</h2>
                 Name<br/>
                <input type="text" name="name"><br/>
                Age<br/>
                <input type="text" name="age"><br/>
                Gender<br/>
                <input type="text" name="gen"><br/>
                Phone No.<br/>
                <input type="text" name="phone"><br/>
                Address<br/>
                <input type="text" name="add"><br/>
                Password<br/>
                <input type="password" name="pass"><br/>
                <hr>
                <input class="button" type="submit" value="Register">
                <button type="button" onclick="login()">Login</button>   
            </form>	
        </div>
        <?php
        
	
	   session_start();
        if(isset($_SESSION['id']) && $_SESSION['utype']=="admin")
            {
                header("Location:addtrainview.php");
            }
            else if(isset($_SESSION['id']) && $_SESSION['utype']=="user")
            {
               header("Location:userhome.php");
            }
            
            else
            {
                //header("Location:login.php");
            }
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