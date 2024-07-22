<!DOCTYPE html>
<html>
<?php require "../include/header_min.inc.php"?>
<body class="login-page">
    <div class="login-box">
        <div class="card">
            <div class = "header logo text-center">
                <img src="../data/files/image/Don_Bosco_College_Logo.svg" class="rounded mx-auto d-block my-3" style ="width: 35%;" alt="DBC Logo">
                <h3><strong>DBC-CMS</strong> Login</h3>
            </div>
            <div class="body">
                <form name = "loginform" id="sign_in" method="POST">
                    <span id = "loginStatus"></span>
                    <div class="form-group form-float">
                        <div class ="mb-3 row">
                            <label class="form-label">Username</label>
                            <div class="form-line">
                                <input 
                                    type="text" 
                                    id="username" 
                                    name = "username" 
                                    class="form-control" 
                                    required
                                >
                            </div>
                        </div>
                        <div class ="mb-3 row">
                            <label class="form-label">Password</label>
                            <div class="form-line">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name = "password" 
                                    class="form-control"      
                                    required 
                                >
                            </div>
                        </div>
                    </div>
                    <div class= "row">
                        <div class= "d-flex justify-content-end">
                            <button type="submit" id = "loginformSubmit" class="btn bg-blue btn-lg waves-effect">Sign In</button>  
                        </div>
                        <div id = "loginformAlert" class="alert alert-danger text-center my-4" hidden></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require "../include/footer_min.inc.php"?>
</body>
</html>
        <!-- Checkboxes for 'Remember me' and 'Show Password' options 
        <div class="row align-items-start">
                <div class="col-xs-2">
                <input 
                    type="checkbox" 
                    id="rememberme" 
                    name = "" 
                    class="filled-in chk-col-pink"
                >
                <label for="rememberme">Remember Me?</label>
                </div>
                <div class="col-xs-2">
                <input 
                    type="checkbox" 
                    id="showpw" 
                    name = "" 
                    class="filled-in chk-col-pink"
                >
                <label for="showpw">Show Password</label>
            </div>
        </div>
        -->
