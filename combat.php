		
<?php
    
include 'header.php';
    

$map = file('db/map.txt');
$id = $user->getIDwithSession();
$u = $user->getUserByID($id);

$mapUserFile = "db/".$u['username'].".txt";

if(!file_exists($mapUserFile)){
   touch($mapUserFile);
   $fOpen = fopen($mapUserFile,'w+');
   for ($i=0; $i < 11 ; $i++) { 
       for ($j=0; $j < 17; $j++) {  
          
           fwrite($fOpen,$map[$i][$j]);
           
       }
       fwrite($fOpen,"\n");
   }
   fclose($fOpen);   
}

$mapUser = file($mapUserFile);
    


    if(isset($_GET['cmd'])){

        if(!isset($_SESSION['userScore'])){
            $_SESSION['userScore']= 0;
        }
        $userScore = $_SESSION['userScore'];
        

        $pX = $_GET['pX'];//1
        $pY = $_GET['pY'];//0

        if($pX==10 && $pY==16){
            header("Location:restartGame.php");
            exit;
        }
        switch ($_GET['cmd']) {

            

            case 'right':
            if($mapUser[$pX][$pY+1]==1){ 
                $mapUser[$pX][$pY] = 1;
                $mapUser[$pX][$pY+1]=3;

             }
             else if($mapUser[$pX][$pY+1]==4){
                $userScore = $userScore + 50;
                $_SESSION['userScore'] = $userScore;
                $mapUser[$pX][$pY] = 1;
                $mapUser[$pX][$pY+1]=3;
             }
             else if($mapUser[$pX][$pY+1]==5){
                 $pY = $pY + 1;
                header("Location:combatFight.php?pX=$pX&pY=$pY");
                exit;
             }
             else{
                
             }
             $fOpen = fopen($mapUserFile,'w+');
             for ($i=0; $i < 11 ; $i++) { 
                 for ($j=0; $j < 17; $j++) {  
                    
                     fwrite($fOpen,$mapUser[$i][$j]);
                     
                 }
                 fwrite($fOpen,"\n");
             }
             fclose($fOpen);    
                break;
            case 'down':
                    if($mapUser[$pX+1][$pY]==1){ 
                        $mapUser[$pX][$pY] = 1;
                        $mapUser[$pX+1][$pY]=3;

                    }
                    else if($mapUser[$pX+1][$pY]==4){
                        $userScore = $userScore + 50;
                        $_SESSION['userScore'] = $userScore;
                        $mapUser[$pX][$pY] = 1;
                        $mapUser[$pX+1][$pY]=3;
                    }
                    else if($mapUser[$pX+1][$pY]==5){
                        $pX = $pX  + 1;
                        header("Location:combatFight.php?pX=$pX&pY=$pY");
                        exit;
                     }
                    else{
                        
                    }
                    $fOpen = fopen($mapUserFile,'w+');
                    for ($i=0; $i < 11 ; $i++) { 
                        for ($j=0; $j < 17; $j++) {  
                            
                            fwrite($fOpen,$mapUser[$i][$j]);
                            
                        }
                        fwrite($fOpen,"\n");
                    }
                    fclose($fOpen);  
                    break;
            case 'up':
                    if($mapUser[$pX-1][$pY]==1){ 
                        $mapUser[$pX][$pY] = 1;
                        $mapUser[$pX-1][$pY]=3;
        
                     }
                     else if($mapUser[$pX-1][$pY]==4){
                        $userScore = $userScore + 50;
                        $_SESSION['userScore'] = $userScore;
                        $mapUser[$pX][$pY] = 1;
                        $mapUser[$pX-1][$pY]=3;
                     }
                     else if($mapUser[$pX-1][$pY]==5){
                        $pX = $pX-1; 
                        header("Location:combatFight.php?pX=$pX&pY=$pY");
                        exit;

                     }
                     else{
                        
                     }
                     $fOpen = fopen($mapUserFile,'w+');
                     for ($i=0; $i < 11 ; $i++) { 
                         for ($j=0; $j < 17; $j++) {  
                            
                             fwrite($fOpen,$mapUser[$i][$j]);
                             
                         }
                         fwrite($fOpen,"\n");
                     }
                     fclose($fOpen);    
                        break;
            default:
                
                break;
        }
        
        $points = $user->getPoint($id,1);
       

        if($_SESSION['userScore']>=$points->point){
          
         $user->addPoint($id,1,$_SESSION['userScore']);
        }
           
        
    }

  
    


    $mapTxt = file($mapUserFile);

   
    if(isset($_GET['game'])){
        $_SESSION['game'] = $_GET['game'];
    }

    
    
?>

<div class="col-sm-3" style="padding-top:50px;" ng-controller="SnakeController">
                    <span id="game_id" style="display:none"><?php echo  $_SESSION['game'] ?></span>
					<h1>LeaderBoard</h1>
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

<div class="col-sm-8" style="margin-top:20px;">
<h3>Your score :  <?php if (isset($_SESSION['userScore'])) {
    echo $_SESSION['userScore'];
}else{
    echo "0";
}?></h3>  

<a href="restartGame.php">Restart Game</a>


    <div class="combat-game-map">

        <?php   

        $imageContent = "";
            for ($i=0; $i < 11 ; $i++) { 
                for ($j=0; $j < 17; $j++) { 
                switch ($mapTxt[$i][$j]) {
                     case 3:
                        $pX=$i;
                        $pY=$j;          
                        $imageContent = "assets/images/character.jpg";
                        break;
                    case 1:
                        $imageContent = "assets/images/soilmill.jpg" ; 
                        break;
                    case 5:
                        $imageContent = "assets/images/enemy.jpg" ; 
                        
                        break;
                    case 4:
                        $imageContent = "assets/images/coinmill.jpg" ;                       
                        break;
                     default:
                        $imageContent = "assets/images/grass.jpg" ;                   
                        break;
                }
 ?>
                <img src=<?php echo $imageContent;?> alt="" width="35" height="35">

    <?php       
       }
       echo "<br>";
    }


?>


        </div>


      
            <a href="combat.php?cmd=right&pX=<?php echo $pX;?>&pY=<?php echo $pY;?>"><i class="fa fa-arrow-right fa-2x" aria-hidden="true"></i></a>
            <a href="combat.php?cmd=down&pX=<?php echo $pX;?>&pY=<?php echo $pY;?>"><i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i></a>
            <a href="combat.php?cmd=up&pX=<?php echo $pX;?>&pY=<?php echo $pY;?>"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>

    


</div>



<?php
	include 'rightbar.php';
 	include 'footer.php' ;
 ?>


