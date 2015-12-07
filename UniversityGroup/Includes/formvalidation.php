<?php 
require_once 'functions.php';
    function validateEmail($email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            echo "filter"."<br/>";
            return "Email not in a correct format";
        }
        else if(!isset($email)||empty($email))
        {
            echo "empty"."<br/>";
            return "Email can't be empty";
        }
        else 
            return "";
    }
    
    function validateName($name)
    {
        if(!isset($name)||empty($name))
        {
            return "Name can't be empty";
        }
        else if(ereg("[^a-zA-z]", $name))
        {
            return "Name can only contain Alphabets";
        }
                
        else 
            return "";
        
    }

    function validateDateBirth($date)
    {
        $curdate =  getStandardTime(time());

        if($curdate<$date)
            return "You are not from the future,Enter you're correct DOB";
        else 
            return "";

    }


    function validatePassword($password)
    {
        echo "inside validate Password";
        if(!isset($password)||empty($password))
        {
            return "Password can't be empty";
        }
        if(strlen($password)<8||strlen($password)>64)
        {
            return "Password should be between 8 to 64 letters";
        }
        else 
            return "";
    }