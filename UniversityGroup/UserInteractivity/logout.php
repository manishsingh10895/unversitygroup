<?php
    require 'Includes/database.php';
    @session_start();
    if(!isset($_SESSION['username'])&&!isset($_COOKIE['userid']))
        redirect ('/newForum');
    session_unset();
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    }
    session_destroy();
    print_r($_COOKIE);
    if(isset($_COOKIE['userid']))
    {
        setcookie('firstName',$_COOKIE['firstName'],  time()-24*9*60*60);
        setcookie('userid',$_COOKIE['userid'],time()-24*9*60*60);
    }
    redirect('/newForum');
echo "lakjfd";
?>