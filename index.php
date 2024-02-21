<script src="plugins/jquery/jquery.min.js"></script>
<?php
include "core/connection.ini";
include "query/useraccounts.php";   
$usr=new USERACCOUNTS();
if(isset($_POST['username']))
    {     
        $result=$usr->verify_user($db1,$_POST['username'],$_POST['password']);     
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"></a>
            <h1>Welcome!</h1>
            <h4>DBC-CMS Login</h4>
        </div>
        <div class="card">
            <div class="body">
                <form action="index.php" id="sign_in" method="POST">
                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="username" id="username" class="form-control">
                                    <label class="form-label">User Name</label>
                                </div>
                                <div class="form-line">
                                    <input type="text" name="password" id="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 p-t-5">
                                    <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                    <label for="rememberme">Remember Me</label>
                                </div>
                                <div class="col-xs-4">
                                    <input class="btn btn-block bg-blue" type="submit" value="Sign in">
                                </div>
                            </div>
                        <span id = "loginStatus"></span>
                        <?php // php script for checking login status
                        if(isset($_POST['username']))
                        { 
                            $_SESSION['trycount'];
                            $_SESSION['logged_in'];  
                            if($result!=0){ 
                                $_SESSION['logged_in'] = 1; 
                                $_SESSION['trycount'] = 0; // RESET
                            }
                            else {
                                $_SESSION['logged_in'] = 0;  
                                $_SESSION['trycount'] ++;
                            } 
                        } 
                        ?>        
                        <script type = "application/javascript">
                            var login_timeout = <?php echo $_SESSION['trycount']?>;
                            var login_OK = <?php echo $_SESSION['logged_in']?>;
                            if(login_OK == 0){
                                document.getElementById("loginStatus").innerHTML = "<b>Login Error:</b><br> Please enter a valid username and password."
                            }
                        </script>
                        </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Login scripts 
    <script src="js/login.js"></script>-->

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <!-- <script src="js/pages/examples/sign-in.js"></script> -->
</body>
</html>