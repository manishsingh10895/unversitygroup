<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $dateFormat = "%Y-%m-%d %H:%M:%S";

 function redirect($loc)
 {
     header("Location: {$loc}");
 }
 
function getStandardTime($time)
{
    global $dateFormat;
    return strftime($dateFormat,$time);
}

function encrypt($pass)
{
    //$enc = hash('ripemd256',$pass);
    $enc = crypt($pass,"$#tellme#MORE");
    return $enc;
}
function verify($typedPass,$savedPass)
{
    echo password_verify($typedPass,$savedPass);
    return password_verify($typedPass,$savedPass);
}

function mysqlPrep($value)
{
//    $magic_quotes = get_magic_quotes_gpc();
//    $new_enough_php = function_exists("mysql_real_escape_string");
//    
//    if($new_enough_php)
//    {
//        if($magic_quotes){$value = stripslashes($value);}
//        $value = mysql_real_escape_string($value);
//    }
//    else 
//    {
//        if(!magic_quotes){$value=addslashes($value);}
//    }
    
    return mysql_escape_string($value);
}