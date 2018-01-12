var chatApp = angular.module("chatApp",[]);

	chatApp.controller("ChatController",function($scope,$http){

		var id = document.getElementById("id").innerHTML;
		
		document.getElementById("id").style.display = "none";
		
		list = document.getElementsByClassName("userList");
		
		for (let index = 0; index < list.length; index++) {
			list[index].style.display="none";
			
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
        getFriends();
		getRequests();
		getAllUsers();

		//Oxuma
		function Read(){
            var url = "api/read.php";

            $http.get(url)
            .success( function(data) {
               $scope.messages = data;
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

		function getAllUsers(){

			$http.get("api/users.php")
			.success(function(data){
				$scope.users = data;
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
		
		$scope.AddFriend = function(friendId){

			var id = document.getElementById("id").innerHTML;
			
			$http.post("api/addFriend.php",{id:id,friend_id:friendId})
			.success(function(data,status,headers,config){
				getRequests();
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		}
		$scope.Accept = function(accept_id){
			
						$http.post("api/accept.php",{id:accept_id})
						.success(function(data,status,headers,config){
							getRequests();
							getFriends();
							
						})
						.error(function(data,status,headers,config){
							console.log(data);
						});
					 }
			
		 $scope.Ignore = function(ignore_id){
						var id = document.getElementById("id").innerHTML;
						
						$http.post("api/ignore.php",{id:id,ignore_id:ignore_id})
						.success(function(data,status,headers,config){
							getRequests();
							
						})
						.error(function(data,status,headers,config){
							console.log(data);
						 });
			
					 }
		 
		 $scope.Add = function(){

			moment.locale('az');
			var tarix = moment().format('llll');


			$http.post("api/add.php",{text:$scope.text,tarix:tarix,user_id:$scope.id})
			.success(function(data,status,headers,config){
				 Read();
			})
			.error(function(data,status,headers,config){
				console.log(data);
			});

			$scope.text ="";
			
		 }

		 $scope.Delete = function(message){

			$http.post("api/delete.php",{id:message})
			.success(function(data,status,headers,config){
					Read();
			})
			.error(function(data,status,headers,config){
					console.log(data);
			});
		 }


			
         
         
         
         
                
    });
    

   
        
     

  
	