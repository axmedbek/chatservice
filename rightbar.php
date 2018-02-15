<div class="col-sm-1">
					    <h6 id="id" style="display:none;"><?php echo $id ?></h6>
						<h6 class="user-cl"><?php echo $_SESSION['login'] ?></h6>
						<div class="btn-group-vertical">
						<button id="myBtn" class="btn btn-info">Pass Change</button>



												<!-- The Modal -->
						<div id="myModal" class="modal">

							<!-- Modal content -->
							<div class="modal-content">
								<span id="closePassChange" class="close">&times;</span>
								
								<form id="pasChange">
								
									<div class="form-group">
									  
										<label for="lastPass">Last Password</label>
										<input type="text" class="form-control" id="lastPass" ng-model="lastPass">
									</div>
									<div class="form-group">
										
										<label for="newPass">New Password</label>
										<input type="text" class="form-control" id="newPass" ng-model="newPass">
									</div>
									<button class="btn btn-primary btn-sm btn-block" ng-click="passChange();">Change Password</button>
									
								</form>
							</div>

						</div>

						<button id="btnBlackList" class="btn btn-warning">BlackList</button>

						<div id="blackListModal" class="modal">

							<!-- Modal content -->
							<div class="modal-content">
								<span id="closeBlackList" class="close">&times;</span>
								<h1>Your BlackList</h1>
								<hr style="color:black;">
								<h2 id="blackListMessage"></h2>
								<form id="blackList">
									
								<div class="row" ng-repeat="bl in blackList">
								
									<div class="col-sm-3">
											<span>{{bl.username}}</span>
									</div>
									
									<div class="col-sm-3">
											<img class="img-circle img-responsive" src="{{bl.image}}" alt="{{bl.username}} profile photo" width="60" height="60">
									</div>
									
								
									<div class="col-sm-6" style="padding-left:20px;" >
																				
									<button class="btn btn-success btn-sm" ng-click="removeBlock(bl.id)"><i class="fa fa-plus" aria-hidden="true"></i>Remove Block</button>
								
																					
									</div>
								
							</div>
								
									
								</form>
							</div>

						</div>

						<button id="gameBtn" class="btn" style="background-color:blueviolet;color:white;">Games</button>

						<div id="gamesModal" class="modal">

							<!-- Modal content -->
							<div class="modal-content">
								<span id="closeGames" class="close">&times;</span>
								<h1>Your games</h1>
								<hr>
								
									
								<div class="row">
								
									<div class="col-sm-4">
										<p>Combat</p>
										<hr>
										<p>Snake</p>
									</div>
									<div class="col-sm-8">
										<a href="combat.php?game=1" class="btn btn-info">Combat Play</a>
										<hr>
										<a href="snake.php?game=2" class="btn btn-info">Combat Play</a>
									</div>
								
								</div>
								
								
							</div>

						</div>
						
						<a href="index.php" class="btn btn-success" id="main-page-btn">Main Page</a>
						
						<script>
							var path = window.location.pathname;
							if(path=="/AhmadMammadli/index.php"){
								document.getElementById("main-page-btn").style.display = "none";
							}
							
						
						</script>

						<a href="logout.php" class="btn btn-danger">Logout</a>
						</div>
						
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
									<a class="btn btn-info" href="profile.php?user={{fr.username.toLowerCase();}}">
									<div class="col-sm-12">
									
											  {{fr.username}}
											  
									  </div>
									  <a>	
									  <!-- <div class="col-sm-4">
									  <img class="image" src="{{f.image}}" alt="profile photo" width="40" height="40">
									</div> -->
									</div>
									
									</td>
									
								</tr>
							
							</tbody>
						</table>

						<hr>


						<!-- Friend Requests Starts in Here -->
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
										<button  ng-click="Accept(rq.user_id);" class="btn btn-success btn-sm" >Accept</button>
										<button  ng-click="Ignore(rq.id);" class="btn btn-danger btn-sm">Ignore</button>
										<a href="profile.php?user={{rq.username}}" class="btn btn-info btn-sm btn-block">Profile</a>
									 </div>
									 
									</div>
									  
									</td>
								</tr>
							
							</tbody>
						</table>



</div>