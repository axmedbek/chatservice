<?php   

$message = null;

if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	$color = "";
	switch($msg){
		case "logout" :
			$message = "Successfully logout";
			$color = "success";
			break;
		case "LoginSuccess"	 :
				$message = "Successfully login";
				$color = "success";
				break; 
		case "loginError"	:
				$message = "Password or Username inValid";
				$color = "danger";
				break; 
		case "emptyForm"	:
				$message = "Can't be null";
				$color = "danger";
				break; 
		case "Registersuccess":
				$message = "Registration is Successfully.Please Control your Email Address";
				$color = "success";
				break;
		case "RegisterError":
				$message = "Registration is inValid";
				$color = "danger";
				break;
		case "email-error" : 
				$message = "Email isn't valid";
				$color = "danger";
				break;
		case "upload-error" : 
				$message = "Image wasn't uploaded";
				$color = "danger";
				break;		
		default :
				$message = "";
				$color = "";
				break;		
			
	}
}




?>