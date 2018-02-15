<div class="col-sm-3">
					<h1>Userlist</h1>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Users' Username</th>
							</tr>
							</thead>
							<tbody ng-init="getAllUsers();">
							<?php foreach ($users as $user) { ?>
								<tr>   <!--ng-repeat="user in users" -->
									
									<?php if($id!=$user['id']){ ?>
										<td>
										<div class="row">

											<div class="col-sm-3">
												<span><?php echo $user['username']?></span>
											</div>

											<div class="col-sm-3" style="padding-left:50px;" >
												
													
													<button class="btn btn-success btn-sm" ng-click="AddFriend(<?php echo $user['id'];?>);"><i class="fa fa-plus" aria-hidden="true"></i>
</button>

													
													
												
											</div>

											<div class="col-sm-3" style="padding-left:30px;padding-right:5px;" >
												
													
													<button class="btn btn-danger btn-sm" ng-click="AddBlock(<?php echo $user['id'];?>);"><i class="fa fa-ban" aria-hidden="true"></i>
</button>

													
													
												
											</div>

											<div class="col-sm-3">
												<img class="img-circle img-responsive" src="<?php echo $user['image'];?>" alt="<?php echo $user['username'];?> profile photo" width="40" height="40">
											</div>
										</div>
									  
									</td>

									<?php } ?>
									
									
								</tr>
								<?php	}?>
							</tbody>
						</table>



						<!-- <h1>Userlist with Angular</h1>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Users' Username</th>
							</tr>
							</thead>
							<tbody ng-init="getAllUsers();">
							
								<tr ng-repeat="user in users">   <!--ng-repeat="user in users" -->
									
									
										<!-- <td id="userName">
										    <div class="row">

											<div class="col-sm-3">
												<span>{{user.username}}</span>
												<span id="userID">{{user.id}}</span>
											</div>

											<div class="col-sm-3" style="padding-left:50px;" >
												
													
													<button class="btn btn-success btn-sm" ng-click="AddFriend(user.id);"><i class="fa fa-plus" aria-hidden="true"></i>
</button>

													
													
												
											</div>

											<div class="col-sm-3" style="padding-left:30px;padding-right:5px;" >
												
													
													<button class="btn btn-danger btn-sm" ng-click="AddBlock(user.id);"><i class="fa fa-ban" aria-hidden="true"></i>
</button>

													
													
												
											</div>

											<div class="col-sm-3">
												<img class="img-circle img-responsive" src="{{user.image}}" alt="{{user.username}} profile photo" width="40" height="40">
											</div>
										</div>
									  
									</td>

									
									
									
								</tr>
								
							</tbody>
						</table> -->
</div>

<!-- <script>
	document.getElementById("userID").style.display = "none";
</script> -->