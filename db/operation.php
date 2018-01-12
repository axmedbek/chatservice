<?php
require('connect.php');




if (isset($_POST['register']) && isset($_POST['username']) && is_string($_POST['username']) 
&& is_string($_POST['password']) && isset($_POST['password']) && isset($_POST['email']) 
&& is_string($_POST['email'])) {
	
			
					$username = $_POST['username'];
					$email = $_POST['email'];
					$password = md5($_POST['password']);

					$upload_dir = '../assets/images';
					$tmp_name = $_FILES['image']['tmp_name'];
					$name = $_FILES['image']["name"];
					$error = $_FILES['image']['error'];
					$type = $_FILES['image']['type'];
					$size = $_FILES['image']['size'];
					$random = rand(100000,500000);
					$image_path = strlen($upload_dir."/".$random.$name,3);
			
				// Check for errors
					if($error > 0){
						header("Location:../login.php?msg=upload-error");
						exit;
						//echo "An error ocurred when uploading.";
					}
			
					if(!getimagesize($tmp_name)){
						header("Location:../login.php?msg=image-empty");
						exit;
						//echo "Please ensure you are uploading an image.";
					}
			
				// Check filetype
					if($type != 'image/png' && $type!='image/jpg' && $type!='image/gif' && $type!='image/jpeg'){
						header("Location:../login.php?msg=unsupported-error");
						exit;
						//echo "Unsupported filetype uploaded.";
					}
			
				// Check filesize
					if($size > 1000000){
						header("Location:../login.php?msg=size-error");
						exit;
						//echo "File uploaded exceeds maximum upload size.";
					}
			
				// Check if the file exists
					if(file_exists($image_path)){
						header("Location:../login.php?msg=exists-error");
						exit;
						//echo "File with that name already exists.";
					}
			
				// Upload file
					if(!move_uploaded_file($tmp_name,$image_path)){
						header("Location:../login.php?msg=izin-error");
						exit;
			
						//echo "Error uploading file - check destination is writeable.";
					}
					if (!empty($username) && !empty($password) && !empty($email)) {
						$result = $user->register($username,$email,$password,$image_path);
						if ($result) {
							header('Location:../login.php?msg=Registersuccess');
							exit;
						}
						else{
							header('Location:../login.php?msg=RegisterError');
							exit;
						}
					}
					else{
						header('Location:../login.php?msg=emptyForm');
							exit;
					}	
					
		}






// 	$username = $_POST['username'];
// 	$email = $_POST['email'];
// 	$password = md5($_POST['password']);
// 	if (!empty($username) && !empty($password) && !empty($email)) {
// 		$result = $user->register($username,$email,$password);
// 		if ($result) {
// 			header('Location:../login.php?msg=Registersuccess');
// 			exit;
// 		}
// 		else{
// 			header('Location:../login.php?msg=RegisterError');
// 			exit;
// 		}
// 	}
// 	else{
// 		header('Location:../login.php?msg=emptyForm');
// 			exit;
// 	}
// }




if (isset($_POST['login']) && isset($_POST['username']) && is_string($_POST['username']) && isset($_POST['password']) && is_string($_POST['password'])) {
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	if ($username && $password) {
		
		$result = $user->login($username,$password);
		if ($result) {
			$_SESSION['login']=$result["username"];
			$_SESSION['id'] = $result['id'];
			header('Location:../index.php?msg=LoginSuccess');
			exit;
		}
		else{
			header('Location:../login.php?msg=loginError');
			exit;
		}
	}
	else{
		header('Location:../login.php?msg=emptyForm');
			exit;
	}
}




?>