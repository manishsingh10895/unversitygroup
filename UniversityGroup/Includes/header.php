<!DOCTYPE html>
<?php
    $rootDirectory = "\\UniversityGroup\UniversityGroup\\";
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Groups</title>
<link rel="stylesheet" href="..\BootStrap\dist\css\bootstrap.css">
<script src="../Scripts/jquery.min.js"></script>
<script src="../BootStrap\dist\js\bootstrap.js"></script>

</head>
<body>
<div class="bs-example">
    <nav id="myNavbar" class="navbar navbar-inverse" style="background:#002034" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../">Groups</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../">Home</a></li>
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                    <li>
                        <a href='../UserInteractivity/Signup.php'>Sign up</a>      
                    </li>
                    <li><a href='../UserInteractivity/Login.php'>Login</a></li>
                </ul>
                <div>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search for Groups"/>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    
</div>
