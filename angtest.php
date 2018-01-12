<html ng-app="app">
   <head>
      <title>Angular JS Includes</title>
      
      <style>
         table, th , td {
            border: 1px solid grey;
            border-collapse: collapse;
            padding: 5px;
         }
         
         table tr:nth-child(odd) {
            background-color: #f2f2f2;
         }
         
         table tr:nth-child(even) {
            background-color: #ffffff;
         }
      </style>
      
   </head>
   <body>
      <h2>AngularJS Sample Application</h2>
      <div ng-controller = "ChatController">
      
         <table>
            <tr>
               <th>ID</th>
               <th>Username</th>
               <th>Email</th>
               <th>Password</th>
               <th>Delete</th>
            </tr>
         
         <tbody ng-init="Read();">
            <tr ng-repeat = "user in users">
               <td>{{ user.id }}</td>
               <td>{{ user.username }}</td>
               <td>{{ user.email }}</td>
               <td>{{user.password}}</td>
               <td><button ng-click="Delete(user.id);">Sil</button></td>
            </tr>
        </tbody>
         </table>

         <hr>

         <form name="former">
         
         <input type="text" name="username" ng-model="username"><br>
         <input type="text" name="email" ng-model="email"><br>
         <input type="text" name ="password" ng-model="password"><br>
         <button ng-click="Add();">Add</button>
         
         </form>
      </div>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>

      <script>

      var appModule = angular.module("app",[]);

      appModule.controller("UserController",function($scope,$http){

        Read();


        function Read(){
            var url = "data.php";

            $http.get(url)
            .success( function(data) {
               $scope.users = data;
            })
            .error(function(data,status,headers,config){
                console.log(data);
            });

         }

         $scope.Add = function(){
             $http.post("add.php",{username:$scope.username,email:$scope.email,password:$scope.password})
             .success(function(data,status,headers,config){
                     Read() 
                })
             .error(function(data,status,headers,config){
                    console.log(data);
             });
                $scope.username = "";
                $scope.email = "";
                $scope.password = "";
         }


         $scope.Delete = function(user){


            $http.post("delete.php",{id:user})
            .success(function(data,status,headers,config){
                Read();
            })
            .error(function(data,status,headers,config){
                console.log(data);
            });



         }

      });
        
      </script>
            
   </body>
</html>