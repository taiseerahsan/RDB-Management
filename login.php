<html>
	<head>
		<title>
			Login
		</title>
        <script>
		function register()
            {
                window.location.href = 'registration.php';
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
                margin-top: 12%;
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
                
                background-color: #55db5a;
                 height: 10%;
                width: 49%;
                color: white;
                font-size: 15;
            }
            button{
                 height: 10%;
                width: 49%;
                background-color: #5588db;
                color: white;
                font-size: 15;
            }
            h2{
                text-align: center;
            }
        
        </style>
	</head>
	<body>	
		
        <div>
            <form method="post" action="loginwork.php">
                <h2>Login</h2>
                <font color='black'>Id (Phone No.):</font><br/>
                <input type="text" name="id"><br><br/>
                <font color='black'>Password:</font><br/>	
                <input type="password" name="pass"><br/> 
                <hr>
                <input class="button" type="submit" value="Login">
                <button type="button" onclick="register()">Register</button>
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