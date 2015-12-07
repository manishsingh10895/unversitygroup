<?php

    require_once 'header.php';
    require_once '../Includes/database.php';
    @session_start();
    if(isset($_SESSION['username'])||isset($_COOKIE['userid']))
        redirect ('/newForum');
    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}
?>
<?php
    if(!isset($_SESSION['username']))
    {
        if(isset($_POST['login']))
        {
            $user  = new UserDatabase();
            $eror = $user->login(mysqlPrep($_POST['txtUsername']),mysqlPrep(trim($_POST['txtPassword'])));        

            if($eror)
            {
                echo ";;fkjd";
                $loginError = "Login Successful";
                {
                    @session_start();
                    $_SESSION['username']=$eror[2];
                    $_SESSION['id'] = $eror[0];
                    $_SESSION['firstname'] = $eror[1];
                    if(isset($_POST['remember'])&&$_POST['remember']==0)
                    {   
                        //echo "posted";
                        setcookie('userid',$eror[0],time()+24*7*60*60);
                        setcookie('firstName',$eror[1], time()+24*7*60*60);
                    }
                    //print_r($_POST);
                    redirect("/newForum/index.php?usrid={$eror[1]}");
                }
            }
            else 
            {
                $loginError = "Username / Password incorrect";
            }
        }
    }
    else
    {
        echo "sldkgjg";
        $loginError = "already Logged in";
        redirect("/newForum/");
    }
?>

<script src="Scripts/formHandling.js"></script>
<div class="container" style="max-width: 700px;padding-top: 50px">
    <form role="form" class="form-horizontal" action="login.php" method="post">
        <div class="form-group">
            <label for="txtUsername" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="txtUsername" class="form-control" id="txtUsername"
                       value=<?php if($_SERVER['REQUEST_METHOD']=="POST" && isset($loginError))
                                    echo "{$_POST['txtUsername']}";
                                    
                       ?>    
                       >
            </div>
            </div>
        <div class="form-group">
            <label for="txtPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="txtPassword" class="form-control" id="txtPassword">
            </div>
        </div>
        
        <div class="form-group">
            <label class=" col-sm-3  control-label" for="remember"><input id="remember" value="0" name="remember" type="checkbox"><label>Remember Me</label></label>                        
            <a class="link" style="float:right" href="/newForum/user-content/forgotPassword.php">Forgot Password</a>
        </div>

        <?php
                if($_SERVER['REQUEST_METHOD']=="POST" && isset($loginError))
                {
                    echo " <div class='alert alert-danger col-lg-11' id='alertMessenger'>"; 
                    echo $loginError."<br/>";
                    echo "</div>";
                }
        ?>
        
        <button type="submit" class="btn btn-primary col-lg-11" value="Login" name="login" id="btn">Login</button>
        
    </form>
</div>

<?php require_once '../Includes/footer.php';?>