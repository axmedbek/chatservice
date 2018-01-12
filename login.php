<?php   

require('message.php');

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> </title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="container">
	<div class="row">
			
		<div class="col-sm-6">
				<div class="special-alert alert alert-<?php echo $color?> alert-block" role="alert">
  					<?php  echo $message?>
					  
				</div>
			<form action="db/operation.php" id="login" method="post" > 
					<div class="form-group">
						<h1 class="text-center login-text">Login Form</h1>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Please insert username">

					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="password" placeholder="Please insert password">

					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-primary btn-block" name="login">Login</button>		
					</div>
			</form>
			</div>
			<div class="col-sm-6">
			<form id="register" action="db/operation.php" method="post" enctype="multipart/form-data"> 
					<div class="form-group">
						<h1 class="text-center login-text">Register Form</h1>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Please insert username">

					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Please insert email">

					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="image" id="image" placeholder="Please insert image">

					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="password" placeholder="Please insert password">

					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-primary btn-block" name="register">Registration</button>		
					</div>
			</form>
		</div>	

		</div>
	</div>
		
	<?php include 'footer.php' ?>