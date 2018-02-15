var chatApp = angular.module("chatApp",[]);

	chatApp.controller("ChatController",function($scope,$http){

		var id = document.getElementById("id").innerHTML;

		document.getElementById("id").style.display = "none";
		
		list = document.getElementsByClassName("userList");
		
		for (let index = 0; index < list.length; index++) {
			
			
		}
		

		$scope.limitMessage = 3;
		$scope.more = true ;
		$scope.less = false;

		$scope.lookMore = function(){
			$scope.limitMessage = 15;
			$scope.more=false;
			$scope.less=true;
		}
		$scope.lookLess = function(){
			$scope.limitMessage = 3;
			$scope.less = false;
			$scope.more = true;
		}

		// Controller calisan kimi bazadan melumatlari oxumaq ucun

		
        Read();
		getRequests();
		getFriends();
		getAllUsers();
		getBlockedUsers();
		getEmojis();
		


		
			
		

		//Oxuma
		function Read(){
            var url = "api/read.php";
			var id = document.getElementById("id").innerHTML;
            $http.post(url,{id:id})
            .success( function(data) {
               $scope.messages = data;
            })
            .error(function(data,status,headers,config){
                console.log(data);
            });

		 }
		 
		


		 function getAllUsers(){
			var id = document.getElementById("id").innerHTML;
			
						$http.post("api/users.php",{id:id})
						.success(function(data){
							
							$scope.users = data;
							
							
							 $scope.users.forEach(user => {
									if (user['id']==id) {
										console.log("Bu hazirki Userdi..");
										document.getElementById("userName").style.display = "none";
									} else {
										
									}
							 });
						})
						.error(function(data,status,headers,config){
								console.log(data);
			
						});
					}



         function getFriends(){
			var id = document.getElementById("id").innerHTML;
			
            $http.post("api/getFriends.php",{id:id})
            .success(function(data){
                $scope.friends = data;
            })
            .error(function(data,status,headers,config){
                console.log(data);
            });
		}

	

		function getRequests(){
			var id = document.getElementById("id").innerHTML;

			$http.post("api/requests.php",{id:id})
			.success(function(data){
				$scope.requests = data;
			})
			.error(function(data,status,headers,config){
				console.log(data);
			})
		}


		function getBlockedUsers(){
			var id = document.getElementById("id").innerHTML;

			$http.post("api/blackList.php",{id:id})
			.success(function(data){
					$scope.blackList = data;
					
						if($scope.blackList.length>0){

							document.getElementById("blackListMessage").style.display="none";
							
						}
						else
						{
							document.getElementById("blackListMessage").innerHTML = "Your BlackList is empty";
							
						}
				
					
			})
			.error(function(data,status,headers,config){
					console.log(data);
			})


		}

		function getEmojis(){

			$http.get("https://unpkg.com/emoji.json@5.0.0/emoji.json")
			.success(function(data){
				$scope.emojis = data;
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});


		}

		

		//ADD FRIEND REQUEST
		$scope.AddFriend = function(friendId){

			var id = document.getElementById("id").innerHTML;
			
			$http.post("api/addFriend.php",{id:id,friend_id:friendId})
			.success(function(data,status,headers,config){
				$scope.errors = data;
					$scope.errors.forEach(element => {
						if(element['msg']){
							swal({
								title : "Oops..",
								text : element['msg'],
								icon : "warning",
							});
						}
						
					});
				
				
				
				getRequests();
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		}




		//ACCEPT FRIEND REQUEST
		$scope.Accept = function(acceptid){
			
			var id = document.getElementById("id").innerHTML;
			
						$http.post("api/accept.php",{id:id,fid:acceptid})
						.success(function(data,status,headers,config){
							getRequests();
							getFriends();
							
						})
						.error(function(data,status,headers,config){
							console.log(data);
						});
					 }
			
					 //IGNORE FRIEND REQUEST
		 $scope.Ignore = function(ignore){
					
						$http.post("api/ignore.php",{ignore:ignore})
						.success(function(data,status,headers,config){
							getRequests();
							
						})
						.error(function(data,status,headers,config){
							console.log(data);
						 });
			
					 }

		 
		//ADD MESSAGE BUTTON
		 $scope.Add = function(){

			moment.locale('az');
			var tarix = moment().format('llll');

			if($scope.text==":)"){
				$scope.text = "😀";
			}
			

			$http.post("api/add.php",{text:$scope.text,tarix:tarix,user_id:$scope.id})
			.success(function(data,status,headers,config){
				 Read();
			})
			.error(function(data,status,headers,config){
				console.log(data);
			});

			$scope.text ="";
			
		 }


		 //DELETE MESSAGE
		 $scope.Delete = function(message){

			$http.post("api/delete.php",{id:message})
			.success(function(data,status,headers,config){
					Read();
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		 }

		
		 //CHANGE USER PASSWORD
		 $scope.passChange = function(){
			var id = document.getElementById("id").innerHTML;

			$http.post("api/passChange.php",{id:id,lastp:$scope.lastPass,newp:$scope.newPass})
			.success(function(data){
				$scope.msgs = data;
				$scope.msgs.forEach(element => {
						swal
						({
							title : element['title'],
							text : element['message'],
							icon : element['icon'],
						})
						.then((value)=>{
							if(value){
									if(element['icon']=='error'){
										
									}
									else{
										document.getElementById('myModal').style.display="none";
										$scope.newPass = "";
										$scope.lastPass = "";
									}
									
								
							}
						});
						$scope.newPass = "";
						$scope.lastPass = "";
					
				});
			})
			.error(function(data,status,headers,config){
				console.log(data);
			});


			
			
		 }


		 //BLOCK USER FROM EVERYWHERE
		 $scope.AddBlock = function(f_id){
			var id = document.getElementById("id").innerHTML;

			swal({
				title: "Are you sure?",
				text: "Once blocked, you will not be able to see this user",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  })
			  .then((willDelete) => {
				if (willDelete) {
					$http.post("api/block.php",{id:id,fid:f_id})
					.success(function(data,status,headers,config){
						swal("User has been blocked", {
							icon: "success",
						  }).then((value)=>{
							  if(value){
								getAllUsers();
								Read();
								getRequests();
								getFriends();
								window.location.href="index.php";
							  }
						  });
						
						  
					})
					.error(function(data,status,headers,config){
						console.log(data);
					});
				  
				} else {
				  swal("Operation is canceled");
				}
			  });
			
		 }


		 $scope.unFriend = function(fid){
			var id = document.getElementById("id").innerHTML;

			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to see this friend's profile",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  })
			  .then((willDelete) => {
				if (willDelete) {
					$http.post("api/unfriend.php",{id:id,fid:fid})
					.success(function(data,status,headers,config){
						swal("Your Friend has been deleted from your friendList", {
							icon: "success",
						  }).then((value)=>{
							  if(value){
								window.location.href="index.php";
							  }
						  });
						
						  
					})
					.error(function(data,status,headers,config){
						console.log(data);
					});
				  
				} else {
				  swal("Operation is canceled");
				}
			  });
			
		 }

		 $scope.removeBlock = function(fid){
			var id = document.getElementById("id").innerHTML;

			$http.post("api/removeBlock.php",{id:id,fid:fid})
			.success(function(data,status,headers,config){
					swal({
						title : "You can see this user now",
						icon : "success",
					})
					.then((value)=>{
						if(value){
							Read();
							getRequests();
							getFriends();
							getAllUsers();
							getBlockedUsers();
						}
					})
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
			
		 }

		
		 $scope.Like = function(message_id){
			var id = document.getElementById("id").innerHTML;
			
			$http.post("api/like.php",{id:id,message_id:message_id})
			.success(function(data,status,headers,config){
				Read();
				
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		 }

		 $scope.Dislike = function(message_id){
			var id = document.getElementById("id").innerHTML;
			
			$http.post("api/dislike.php",{id:id,message_id:message_id})
			.success(function(data,status,headers,config){
				Read();
				
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		 }

		 $scope.AddEmoji = function(emoji){
			if($scope.text){
				$scope.text = $scope.text + emoji;
			}
			else{
				$scope.text = "" + emoji;
			}

			if($scope.message){
				$scope.message = $scope.message + emoji
			}
			else{
				$scope.message = "" + emoji;
			}

		 }


	

			
         
         
         
         
                
    });
	




	
	chatApp.controller("DmController",function($scope,$http){



		getDmMessage();


		function getDmMessage(){
			var id = document.getElementById("id").innerHTML;
			var fid = document.getElementById("fid").innerHTML;

			$http.post("api/getDmMessage.php",{id:id,fid:fid})
			.success(function(data){
				$scope.dmmessages = data;
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		 }

		 $scope.AddDmMessage = function(){
			var id = document.getElementById("id").innerHTML;
			var fid = document.getElementById("fid").innerHTML;
			moment.locale('az');
			var tarix = moment().format('llll');

			$http.post("api/dmMessage.php",{id:id,fid:fid,message:$scope.message,date:tarix})
			.success(function(data,status,headers,config){
				getDmMessage();
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});

			$scope.message="";

		}

	});

	chatApp.controller("SnakeController",function($scope,$http,$timeout,$window){

		var id = document.getElementById("id").innerHTML;
		var game_id = document.getElementById("game_id").innerHTML;
		

		var snake, apple, interval, immortalTickInterval, immortalChecker;
		
			var SIZE = 20,
				LEFT = 37,
				UP = 38,
				RIGHT = 39,
				DOWN = 40,
				SNAKE = 'snake',
				APPLE = 'apple',
				BOARD = 'board',
				IMMORTAL_CODE = "iddqd",
				IMMORTAL_DURATION_SEC = 60;
		
			function initGame() {
				$scope.game = {};
				$scope.game.highScore = 0;
				$scope.game.totalGames = 0;
				startNewGame();
			}
		
			$scope.stop = true;
			$scope.start = false;

			

			$scope.stopGame = function(){
				if($scope.start==false){
					interval=360000;
					$scope.stop = false;
					$scope.start = true;
				}
				else{
					interval=200;
					$scope.stop = true;
					$scope.start = false;
				}
				
			}

			

			function startNewGame() {
				$scope.game.totalGames++;
				$scope.game.immortal = false;
				$scope.game.currentScore = 0;
				resetImmortal();
				initSnake();
				initBoard();
				generateApple();
				getUserPoints();
				interval = 200;
				// todo - show start game button
				$timeout(nextStep,interval);
			}
		
			function initBoard() {
				$scope.board = [];
				var i, len;
				for (i = 0; i < SIZE; i++) {
					$scope.board[i] = [];
					for (var j = 0; j < SIZE; j++) {
						$scope.board[i][j] = BOARD;
					}
				}
				for (i = 0, len = snake.body.length; i < len; i++) {
		
					$scope.board[snake.body[i].x][snake.body[i].y] = SNAKE;
				}
		
			}
		
			function initSnake() {
				snake = {
					body: [{x: 1, y: 0}, {x: 0, y: 0}],
					direction: RIGHT,
					pendingDirection: RIGHT
				};
			}
		
			// todo - refactor - use styles approach
			$scope.getColor = function (i, j) {
				if ($scope.board[i][j] === SNAKE) {
					return $scope.game.immortal ? '#7f203B' : '#595241';
				}
				if ($scope.board[i][j] === APPLE) {
					return $scope.game.immortal ? '#222526' : '#8A0917';
				}
				return $scope.game.immortal ? '#FFBB6E' : '#ACCFCC';
			};
		
			function nextStep() {
				var newHead = getNextHead();
				if (checkHitWall(newHead)) {
					gameOver();
					return;
				}
				if (!$scope.game.immortal && checkHitBody(newHead)) {
					gameOver();
					return;
				}
				snake.body.unshift(newHead);
				$scope.board[newHead.x][newHead.y] = SNAKE;
				if (checkHitApple(newHead)) {
					eatApple();
				}
				var tail = snake.body.pop();
				$scope.board[tail.x][tail.y] = checkHitBody(tail) ? SNAKE : BOARD;
				snake.direction = snake.pendingDirection;
				if (limitReached()) {
					win();
				} else {
					$timeout(nextStep,interval);
				}
			}
		
			function checkHitWall(point) {
				return point.x < 0 || point.y < 0 || point.x >= SIZE || point.y >= SIZE;
			}
		
			function checkHitBody(point) {
				var i, len;
				for (i = 0, len = snake.body.length; i < len; i++) {
					if (snake.body[i].x === point.x && snake.body[i].y === point.y) {
						return true;
					}
				}
				return false;
			}
		
			function checkHitApple(head) {
				return head.x === apple.x && head.y === apple.y;
			}
		
			function limitReached() {
				return snake.body.length === SIZE * SIZE;
			}
		
			function getNextHead() {
				var newHead = angular.copy(snake.body[0]);
				if (snake.pendingDirection === LEFT) {
					newHead.x--;
				} else if (snake.pendingDirection === RIGHT) {
					newHead.x++;
				} else if (snake.pendingDirection === UP) {
					newHead.y--;
				} else if (snake.pendingDirection === DOWN) {
					newHead.y++;
				}
				if ($scope.game.immortal) {
					if (newHead.x < 0 || newHead.x >= SIZE) {
						newHead.x = (newHead.x + SIZE) % SIZE;
					}
					if (newHead.y < 0 || newHead.y >= SIZE) {
						newHead.y = (newHead.y + SIZE) % SIZE;
					}
				}
				return newHead;
			}
		
			function eatApple() {
				$scope.game.currentScore++;
				var tail = angular.copy(snake.body[snake.body.length - 1]);
				snake.body.push(tail);
				interval -= 2;
				generateApple();
			}
		
			// todo - make generation by index from empty place to remove stack overflow
			function generateApple() {
				apple = {
					x: Math.floor(Math.random() * SIZE),
					y: Math.floor(Math.random() * SIZE)
				};
				if (checkHitBody(apple)) {
					generateApple();
				} else {
					$scope.board[apple.x][apple.y] = APPLE;
				}
			}
		
			function gameOver() {
				// todo - show game over popup
				if ($scope.game.currentScore > $scope.game.highScore) {
					
					$scope.game.highScore = $scope.game.currentScore;

					$http.post("api/snakeScore.php",{id:16,score:50})
					.success(function(data,status,headers,config){
						
					})
					.error(function(data,status,headers,config){
						console.log(data);
					});
					
				}
				
					startNewGame();

				
			}
		
			function win() {
				// todo - show win popup
				if ($scope.game.currentScore > $scope.game.highScore) {
					$scope.game.highScore = $scope.game.currentScore;
					
				}
				startNewGame();
				
			}
		
			// todo - need refactor, don't use 'view' in 'controller'
			$window.addEventListener("keydown", function (e) {
				var keyCode = e.keyCode;
				if (keyCode === LEFT && snake.direction !== RIGHT) {
					snake.pendingDirection = LEFT;
				} else if (keyCode === UP && snake.direction !== DOWN) {
					snake.pendingDirection = UP;
				} else if (keyCode === RIGHT && snake.direction !== LEFT) {
					snake.pendingDirection = RIGHT;
				} else if (keyCode === DOWN && snake.direction !== UP) {
					snake.pendingDirection = DOWN;
				} else {
					checkImmortal(e);
				}
		
			});
		
			function checkImmortal(e) {
				var charCode = e.which;
				if (!e.shiftKey) {
					charCode += 32;
				}
				if (immortalChecker.length > 0 && immortalChecker.charCodeAt(0) === charCode) {
					immortalChecker = immortalChecker.substr(1);
					if (immortalChecker.length === 0) {
						clearInterval(immortalTickInterval);
						if (!$scope.game.immortal)
						{
							$scope.game.immortal = true;
							$scope.game.timeout = IMMORTAL_DURATION_SEC;
							immortalTickInterval = setInterval(tickImmortalTimeout, 1000);
						} else {
							resetImmortal();
						}
					}
				} else {
					resetImmortalInput();
				}
			}
		
			function tickImmortalTimeout()
			{
				$scope.game.timeout--;
				if ($scope.game.timeout <= 0)
				{
					resetImmortal();
				}
			}
		
			function resetImmortal(){
				clearInterval(immortalTickInterval);
				$scope.game.immortal = false;
				$scope.game.timeout = 0;
				resetImmortalInput();
			}
		
			function resetImmortalInput() {
				immortalChecker = IMMORTAL_CODE;
			}
		
			initGame();


			function getUserPoints(){

				$http.post("api/userScore.php",{id:id,game_id:game_id})
				.success(function(data){
					$scope.userPoints = data;
				})
				.error(function(data,status,headers,config){
					console.log(data);
			    })
			}
		
	});

	
	

   
        
     

  
	