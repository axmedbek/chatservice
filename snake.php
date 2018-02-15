<?php
    include 'header.php';
    
    if(isset($_GET['game'])){
        $_SESSION['game'] = $_GET['game'];
    }
    
?>    

<style>

.column {
    border: 1px solid #97b9b6;
    width: 25px;
    height: 25px;
    display: inline-block;
}


</style>


    

<div class="col-sm-3" style="padding-top:50px;" ng-controller="SnakeController">
					<h1>LeaderBoard</h1>
                    <span id="game_id" style="display:none"><?php echo  $_SESSION['game'] ?></span>
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Username</th>
                                <th>Image</th>
                                <th><strong>Score</strong></th>
							</tr>
							</thead>
							<tbody ng-init="getUserPoints();">
                            
                            <tr ng-repeat="up in userPoints">
                                <td>{{up.username}}</td>
                                <td><img src="{{up.image}}" alt="{{up.username}}" width="40" height="40"></td>
                                <td>{{up.point}}</td>
                            </tr>
                            
                            </tbody>

						</table>


</div>



<div class="col-sm-8"  style="padding-top:10px;" ng-controller="SnakeController">
    <div class="snakeContainer" class="row">
        <h1 class="text-center">Snake Game</h1>
        <div class="scoresContainer">
            <div class="best-container">Max score: {{game.highScore}}</div>
            <div class="score-container">Score: {{game.currentScore}}</div>
            <button class="btn btn-primary" ng-if="stop" ng-click="stopGame();">Stop</button>
            <button class="btn btn-primary" ng-if="start" ng-click="stopGame();">Start</button>
            <div class="immortal-timer" ng-show="game.timeout > 0">Immortal mode expires in <span class="iddqd">{{game.timeout}}</span> sec</div>
        </div>
        <div>
            <div class="row" ng-repeat="column in board">
                <div ng-repeat="row in column track by $index"
                    class="column"
                    ng-style="{'background-color':getColor($index, $parent.$index)}">
                </div>
            </div>
        </div>
    </div>		
					
</div>




<?php
    include 'rightbar.php';
    include 'footer.php' ;
 ?>