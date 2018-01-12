<?php 
require('db/connect.php');
require('message.php');


 if(!$user->checkLogin())
 {
 	header("Location:login.php");
 	exit;
 }

 $users = $user->getAllUsers();
 $id = $user->getIDwithSession();

 ?>
<!DOCTYPE html>
<html ng-app="chatApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chat Service</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body ng-controller="ChatController" >

	<div class="container">
		<div class="row">
				<div class="col-sm-12">
				
					<div class="special-alert alert alert-<?php echo $color ?> alert-block" role="alert">
						<?php echo $message ?>  
					</div>
					
				</div>
			
				<div class="col-sm-3">
					<h1>Userlist</h1>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Users' Username</th>
							</tr>
							</thead>
							<tbody ng-init="getAllUsers();">
							
								<tr  ng-repeat="user in users">
									<td>
									<div class="row">
										<!-- <p class="userList">
 											{{user.id}}
										</p> -->
										<div class="col-sm-3 ">
											<span>{{user.username}}</span>
										</div>
										<div class="col-sm-6">
												<button class="btn btn-success btn-sm" ng-click="AddFriend(user.id);">ADD</button>
										</div>
									    <div class="col-sm-3">
									        <img class="image" src="{{user.image}}" alt="{{user.username}} profile photo" width="40" height="40">
									    </div>
									</div>
									  
									</td>
								</tr>
							
							</tbody>
						</table>
				</div>
				<div class="col-sm-8">
					<h1>Messages</h1>
					<button ng-click="lookMore();" ng-if="more"  class="btn btn-outline-danger btn-sm btn-block">Look More</button>
					<button ng-click="lookLess();" ng-if="less" class="btn btn-outline-danger btn-sm btn-block">Look Less</button>
				<div  ng-repeat="message in messages | limitTo:limitMessage">
				
					   <div class="alert alert-success" role="alert">
 								<p style="font-size:15px;">{{message.date}}</p>
								<h6 class="text-right">{{message.text}}</h6>
								<span id="user-sv">{{message.username}}</span>

						</div>
				
					
				</div>	
					
				
				</div>
				<div class="col-sm-1">
					    <h6 id="id"><?php echo $id ?></h6>
						<h6 class="user-cl"><?php echo $_SESSION['login'] ?></h6>
						<a href="logout.php" class="btn btn-danger">Logout</a>
						<hr>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Your FriendList</th>
							</tr>
							</thead>
							<tbody ng-init="getFriends();">
							
								<tr ng-repeat="fr in friends">
									<td>
									<div class="row">
									<div class="col-sm-8">
											  {{fr.username}}
									  </div>
									  <!-- <div class="col-sm-4">
									  <img class="image" src="{{f.image}}" alt="profile photo" width="40" height="40">
									</div> -->
									</div>
									  
									</td>
								</tr>
							
							</tbody>
						</table>

						<hr>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Friend Requests</th>
							</tr>
							</thead>
							<tbody ng-init="getRequests();">
							
								<tr ng-repeat="rq in requests">
									<td>
									<div class="row">
									<div class="col-sm-8">
											  {{rq.username}}
									  </div>
									  <div class="btn-group">
										<button  ng-click="Accept(rq.id);" class="btn btn-success btn-sm" >Accept</button>
										<button  ng-click="Ignore(rq.id);" class="btn btn-danger btn-sm">Ignore</button>
										<a href="profile.php" class="btn btn-info btn-sm btn-block">Profile</a>
									 </div>
									 
									</div>
									  
									</td>
								</tr>
							
							</tbody>
						</table>


				</div>
		</div>

 		<div class="row">
 				<div class="col-sm-4">
				 </div>
				 <div class="col-sm-8">
				
						 <form name="former">
					
						<input type="hidden" name="id" ng-model="id" ng-init="id=<?php echo $id ?>">
						<div class="row">
							<div class="col-sm-8 form-group">
								<textarea row="3" name="text" ng-model="text" class="form-control"></textarea>
							</div>
							
							<div class="col-sm-4 form-group">
								<button ng-click="Add();"  class="btn btn-success">Send</button>
							</div>
						</div>
					</form>
						 
				 </div>
		 
		 </div>
	</div>

<?php include 'footer.php' ?>
