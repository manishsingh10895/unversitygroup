

function O(obj)
{
    if(typeof obj == 'object')
    {
      ////console.log(obj);
        return obj;
    }       
    else 
    {
        //  ////console.log(document.getElementById(obj));
        return document.getElementById(obj);
    }
    
}


function S(obj)
{
    return O(obj).style;
}
function showMessage($object)
{
    with($object)
    {
        prompt("Enter your name");
    }
}
function C(name)
{
    return document.getElementsByClassName(name);
}
function validation(form)
{
	{
		this.form  = form;
	    this.elements = Array('txtFirstName','txtLastName','txtEmail','courses','year','txtPass1','txtPass2');
		this.getEmptyErrors = getEmptyErrors;	
		//this.validate = validate;
	}
}



function getEmptyErrors()
{
	var numErrors = 0;
	//////console.log("In getError");
	//alert(this.form.elements[0]);
	var elem = document.forms[1].elements;
	var i =0;
	for (i=0;i<elem.length;i++)
	{
		var element = elem[i].name;
		if(elem[i].value=="")
		{
			numErrors+=1;
			var errorLabel = O("validator"+element);
			errorLabel.innerHTML = "This Field can't be empty";
		}
			
	}
	return numErrors;
}

function genericValidate(field)
{
    //////console.log("in generic validate");
    if(field.type==="text"||field.type==="password")
    {
        if(field.value==="")
            return false;
        else 
            return true;
    }
    else if(field.type==="email")
    {
      //  ////console.log("email error");
        if(!/[a-z0-9]@[a-z]\.com/.test(field.value))
        {
        //    ////console.log("error in email : "+field.value);
            return false;
        }
        else 
            return true;
    }
    else if(field.type==="number")
    {
        if(!/[0-9]/.test(field.value))
            return false;
        else 
            return true;
    }
}

function validateFirstName(field)
{
    ////console.log("first name validator");
    ////console.log(field.value);
    var errorLabel = O('validator'+field.name);
    ////console.log(errorLabel);
    if(field.length>20)
    {
        errorLabel.innerHTML = "First name\n\
        can't be of more than 20 characters";
        //console.log("error length");
        return false;
    }
    else if(field.value==="")
    {
        errorLabel.innerHTML = "First name\n\
        can't be empty";
        //console.log("error empty value");
        return false;
    }
    else if(!/[a-z]/.test(field.value))
    {
        //console.log("error value");
        errorLabel.innerHTML = "First name\n\
        can only contain alphabets";
        return false;
    }
    else 
    {
        errorLabel.innerHTML = "";
        return true;
    }
}

function validateLastName(field)
{
    ////console.log("Last name validator");
    var errorLabel = O('validator'+field.name);
    if(field.length>20)
    {
        errorLabel.innerHTML = "Last name\n\
        can't be of more than 20 characters";
        return false;
    }
    else if(field.value==="")
    {
        errorLabel.innerHTML = "Last name\n\
        can't be empty";
        return false;
    }
    else if(/[^a-zA-z]/.test(field.value))
    {
        errorLabel.innerHTML = "Last name\n\
        can only contain alphabets";
        return false
    }
    else 
    {
        errorLabel.innerHTML = "";
        return true;
    }
}

function clearAllValidators()
{
    var validators = ['validatorFirstName','validatorLastName','validatorEmail','validatorPassword1','validatorPassword2'];
   for(var lbl in validators)
   {
       ////console.log(lbl);
      // //console.log(validators[lbl]);
       
       O(validators[lbl]).innerHTML = "";
   }
   
}

function validateEmail(field)
{
    //console.log(field.value);
    var errorLabel = O('validatorEmail');
    
    ////console.log("Inside email validator");
    if(field.value==="")
    {
    console.log("Email empty");
        errorLabel.innerHTML = "Email can't be empty";
        return false;
    }
    else if(!/[a-z0-9._%+-]+@(?:[a-z0-9-]+\.)+[a-z]{3,}/.test(field.value))
    {
    console.log("Email wrong format");
        errorLabel.innerHTML = "Email should be like example@example.com";
        return false;
    }
    else 
    {
    console.log("Correct");
        clearValidator(field);
        return true;
    }
    ////console.log("true");
}

function loginCheck()
{
    S('alertMessenger').display = 'block';   
}

function clearValidator(field)
{
    console.log("Text cleared");
    O("validator"+field.name).innerHTML = ""; 
}
function checkIfValid(field)
{
    var errorMessage;
    //console.log(field.name);
    switch(field.name)
    {
        case "Email"        :      validateEmail(field);break;
        case "FirstName"    :      validateFirstName(field);break;
        case "LastName"     :      validateLastName(field);break;
        
        default : break;
    }
                            
   
}
function validatePassword(field1,field2)
{
    var errorLabel = O("validatorPassword1");
    ////console.log("Inside validate password");
    if(field1.value.length>64||field1.value.length<8)
    {
        errorLabel.innerHTML = "Password's length should be between 8-64";  
        return false;
    }   
    else if(field1.value!=field2.value)
    {
        errorLabel.innerHTML = "Value don't match";
        return false;
    }
    else 
    {
        errorLabel.innerHTML = "";
        return true;
    }
}

function setVisible()
{
    var elems = C('input');
    for(var el in elems)
    {
        el.style.visiblity = visble
    }
}

function checkAll()
{
    var fname = O("txtFirstName");
    var lname = O("txtLastName");
    var email = O("txtEmail");
    var pass1 = O("txtPass1");
    var pass2 = O("txtPass2");
    var date  = O("dateBirth");
    var vEmail = validateEmail(email);
    console.log(vEmail);
    var vFirst =validateFirstName(fname);
    console.log(vFirst);
    var vLast = validateLastName(lname);
    console.log(vLast);
    var vPass  = validatePassword(pass1,pass2);
    console.log(vPass);
    var vDate = validateDateBirth(date);
    console.log(vDate);
    var cvd = vEmail&&vFirst&&vLast&&vPass&&vDate;
    console.log("vd : ",cvd);
    return cvd;    
}

function validateDateBirth(field)
{
    var errorLabel = O('validatordateBirth');
    var inputdate = new Date(field.value);
    var currentDate = new Date();
    if(inputdate>currentDate)
    {
        errorLabel.innerHTML = "You are not from the future, Enter correct date";
        return false;
    }
    else if(inputdate=="")
    {
        errorLabel.innerHTML = "Date of birth can't be Empty";
        return false;
    }
    else 
    {
        errorLabel.innerHTML = "";
        return true;
    }
}
function validateAll(form)
{
	//alert(form.elements[0]);
    //console.clear();
    clearAllValidators();
	var vd = new validation(form);
	var errors = vd.getEmptyErrors();   
	if(errors)
	{
		//alert("Feilds can't be empty");
                //console.log("empty errors");
		return false;
	}
	else 
	{
        //console.log("no empty error"); 
		if(!checkAll())
            {
                console.log("Not submit");
                return false;
            }
        else 
        {
            console.log("returned true")
              return true;
        }  
	}
}
