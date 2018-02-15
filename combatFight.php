<?php
    
include 'header.php';

$id = $user->getIDwithSession();
$u = $user->getUserByID($id);

include 'sidebar.php';


if(isset($_GET['pX']) && isset($_GET['pY'])){
    $_SESSION['enemyPosition']=[$_GET['pX'],$_GET['pY']];
}

if(isset($_SESSION['healthYours']) && isset($_SESSION['healthEnemy'])){

   
    if(isset($_GET['cmd'])){ 
        

        if($_SESSION['healthYours']==0){ ?>
            <script>
                alert("You are lost :(");
            </script>
       <?php 
        header("refresh:0.5;url=restartGame.php");
        exit;
        }
        if($_SESSION['healthEnemy']==0){ ?>
            <script>
                alert("You are win :)");
            </script>
       <?php 
        
        $pX = $_SESSION['enemyPosition'][0];
        $pY = $_SESSION['enemyPosition'][1];

        //write to file 

        $mapUserFile = "db/".$u['username'].".txt";
        $mapUser = file($mapUserFile);

        $mapUser[$pX][$pY]=1;
        $fOpen = fopen($mapUserFile,'w+');
        for ($i=0; $i < 11 ; $i++) { 
            for ($j=0; $j < 17; $j++) {  
               
                fwrite($fOpen,$mapUser[$i][$j]);
                
            }
            fwrite($fOpen,"\n");
        }
        fclose($fOpen); 

        unset($_SESSION['healthYours'],$_SESSION['healthEnemy']);
        header("refresh:0.5;url=combat.php");
        exit;
        }

        $enemyCmd = mt_rand(1,3);
        switch ($_GET['cmd']) {
            case 1:
                if($enemyCmd==1){
                    $_SESSION['healthEnemy']= $_SESSION['healthEnemy']-25;
                }
                else{
                    $_SESSION['healthYours']= $_SESSION['healthYours']-25;
                }
                break;
            case 2:
                if($enemyCmd==2){
                    $_SESSION['healthEnemy']= $_SESSION['healthEnemy']-25;
                }
                else{
                    $_SESSION['healthYours']= $_SESSION['healthYours']-25;
                }
                break;
            case 3:
                if($enemyCmd==3){
                    $_SESSION['healthEnemy']= $_SESSION['healthEnemy']-25;
                }
                else{
                    $_SESSION['healthYours']= $_SESSION['healthYours']-25;
                }
                break;    
        }
    }
}
else{
    $_SESSION['healthYours']=100;
    $_SESSION['healthEnemy']=100;
}







?>

<div class="col-sm-8 fight" style="margin-top:20px;">
 
<div class="row fighters">
    <div class="col-sm-6 userFighter">
        <p class="health">Your Health <i class="fa fa-heart" style="color:white;" aria-hidden="true"></i>: <span><?php echo $_SESSION['healthYours']?></span></p>
        <img src="assets/images/combatUser.png" alt="" width="120" height="180">
    </div>
    <div class="col-sm-6 enemyFighter">
        <p class="health">Enemy <i class="fa fa-heart" style="color:white;" aria-hidden="true"></i> : <span><?php echo $_SESSION['healthEnemy']?></span></p>
        <img src="assets/images/combatFriend.png" alt="" width="120" height="180">

    </div>
    <div style="padding-top:20px;padding-left:280px;">
    <a href="combatFight.php?cmd=1" class="btn btn-danger">High Kick</a>
    <a href="combatFight.php?cmd=2" class="btn btn-danger">Mid Kick</a>
    <a href="combatFight.php?cmd=3" class="btn btn-danger">Low Kick</a>
    </div>
</div>


</div>






<?php
	include 'rightbar.php';
 	include 'footer.php' ;
 ?>