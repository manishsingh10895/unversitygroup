<?php
@session_start();
require_once '../Includes/database.php';
if(isset($_SESSION['username']))
{redirect('../');}
require_once '../Includes/header.php';
 
require_once '../Includes/formvalidation.php';
 
?>
<script src="../Scripts/formHandling.js" type="text/javascript"></script>
<?php
    
    if(isset($_POST['submit']))
    {
        
        $formFields = array('Email','FirstName','LastName',
            'Password1');
        $errors = array();
        $errors['Email'] = validateEmail($_POST['Email']);
        $errors['FirstName'] = validateName($_POST['FirstName']);
        $errors['LastName'] = validateName($_POST['LastName']);
        $errors['Password1'] = validatePassword($_POST['Password1']);
        //$errors['Password2'] = validatePassword($_POST['Password2']);
        if($errors['Password1']=="")
        {
            if($_POST['Password1']!=$_POST['Password2'])
            {
                $errors['Password1'] = "Values don't match";
            }
        }        
        $totalErrors = "";
        foreach($formFields as $fields)
        {
            $totalErrors .= $errors[$fields];
            echo $totalErrors;
            //echo "error :{$fields}".$errors[$fields]."<br/>";
            //echo $totalErrors;  
        }
        if($totalErrors=="")
        {
            //No error, proceed with insertion
                echo "no error";
            $user = new UserDatabase();
            $fname = mysqlPrep($_POST['FirstName']);
            $lname = mysqlPrep($_POST['LastName']);
            $email = mysqlPrep($_POST['Email']);
            $pass = encrypt(mysqlPrep(trim($_POST['Password1'])));
            $registerTime = getStandardTime(time());
            $exists = $user->CheckIfUserExists($_POST['Email']);
            if(!$exists)
            {
                echo "not exists";
                $user->InsertUserDetails($fname, $lname, $course, $year, $email, $pass,$registerTime,$dateBirth);
                header("Location:successfulSignup.php");   
            }
            else 
            {
                echo "exist";
                $errors['userExists']= "This email id is already taken";
            }
//           
        }
    }//closing brackets if(isset($_POST['submit])
?>
<style>
    body{
        background-image: url(../Images/hoodies.png);
        
        background-repeat: no-repeat;
        background-size:  cover;
    }
    .form-group label
    {
        color: white;
    }
    .nav-pills li a
    {
        color: white;
        background: #0099ff;
        margin: 2px;
        opacity: 0.5;
    }
    .nav-pills,.nav-justified li
    {
        opacity: 2;
    }
    .validators{
        color:blue;
        foreground: blue;
    }
</style>
<div class="container" style="max-width: 700px;padding-top: 50px">
    <form role="form" id="signupForm" class="form-horizontal" action="Signup.php" method="post" onsubmit="return validateAll(this)">
        <div class="form-group">
            <label for="txtFirstName" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-5">
                <input type="text" name="FirstName" class="form-control" id="txtFirstName" onblur="checkIfValid(this)" 
                    value=<?php if($_SERVER['REQUEST_METHOD']=="POST"){echo $_POST['FirstName'];}else echo"";?>
                    >
            </div>
            <div class="col-sm-5">
                <label id="validatorFirstName" class="validators"><?php if(isset($errors))echo $errors['FirstName'];?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="txtLastName" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"   name="LastName" onblur="checkIfValid(this)" id="txtLastName" 
                    value=<?php if($_SERVER['REQUEST_METHOD']=="POST"){echo $_POST['LastName'];}else echo"";?>
                    >
            </div>
            <div class="col-sm-5">
                <label id="validatorLastName"  class="validators"><?php if(isset($errors))echo $errors['LastName']?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="txtEmail" class="col-sm-2 control-label">Email-ID</label>
            <div class="col-sm-5">
                <input type="email" autocomplete="off" class="form-control"  onblur="checkIfValid(this)" name="Email" id="txtEmail" onkeydown="clearValidator(this)"
                    value="<?php if($_SERVER['REQUEST_METHOD']=="POST"){echo $_POST['Email'];}else echo"";?>"
                     onkeyup="validateEmail(this)">
            </div>
            <div class="col-sm-5">
                <label id="validatorEmail" class="validators" style="color:red">
                    <?php 
                        if($_SERVER['REQUEST_METHOD']=="POST")
                        {
                            if(!empty($errors['Email']))
                            {
                                echo $errors['Email'];
                                
                            }
                            else if(isset($errors['userExists'])&&!empty ($errors['userExists']))
                            {   
                                echo $errors['userExists'];
                            }
                            
                        }
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="txtPass1" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-5">
                <input type="password" name="Password1" required="true" class="form-control" id="txtPass1">
            </div>
            <div class="col-sm-5">
                <label id="validatorPassword1" class="validators"><?php if(isset($errors))echo $errors['Password1'];?></label>   
            </div>
        </div>
        <div class="form-group">
            <label for="txtPass2" class="col-sm-2 control-label">Re-Enter Password</label>
            <div class="col-sm-5">
                <input type="password" required="required" class="form-control" name="Password2" id="txtPass2">
            </div>
            <div class="col-sm-5">
                <label id="validatorPassword2" class="validators"><?php //if(isset($errors))echo $errors['Password2'];?></label>
            </div>
        </div>
        
        <input type="submit" class="btn btn-success col-sm-7" id="btnSubmit" name="submit" value="Sign Up"/>
        
    </form>
</div>

<?php
    
?>
<?php require_once '../Includes/footer.php';?>