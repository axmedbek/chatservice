<?php
require('connect.php');

include 'class.phpmailer.php';




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
					$image_path =$upload_dir."/".$random.$name;
			
					
				// Check for errors
					if(!$user->isValidEmail($email)){
						header("Location:../login.php?msg=email-error");
						exit;
					}
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
					$image_path = substr($upload_dir,3)."/".$random.$name;
					if (!empty($username) && !empty($password) && !empty($email)) {
						
						$activation = md5(rand(1000,5000));
						$result = $user->register($username,$email,$password,$image_path,$activation);

						$mail = new PHPMailer();
						$mail->IsSMTP();
						$mail->SMTPAuth = true;
						$mail->Host = 'smtp.alfakitab.com';
						$mail->Port = 587;
						$mail->Username = 'elaqe@alfakitab.com';
						$mail->Password = '6627398ehmed';
						$mail->SetFrom($mail->Username, 'ChatBox Admistration');
						$mail->AddAddress($email, 'Alıcının Adı');
						$mail->CharSet = 'UTF-8';
						$mail->Subject = 'Validation Account Mail';
						$content = '<a href="http://localhost/AhmadMammadli/db/validation.php?email='.$email.'&activation='.$activation.'">Do Active</a>';
						$mail->MsgHTML($content);
						if($mail->Send()) {
							echo 'Mail gönderildi!';
						} else {
							echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
						}
						



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