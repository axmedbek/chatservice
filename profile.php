<?php 
require('db/connect.php');

if(!isset($_GET['user'])){
    header("Location:index.php");
}

$username = $_GET['user'];

$u = $user->getUserByUsername($username);
$id = $user->getIDwithSession();

if(!$u){
    echo "Bele istifadeci yoxdur.";
}
else{


?>

<!DOCTYPE html>
<html lang="en" ng-app="chatApp">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body ng-controller="ChatController">
    <div class="container">
    
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                
                <img src="<?php echo $u['image']?>" alt="<?php echo $u['username']?> profile image" width="300" height="300">
                <h6 id="fid" style="display:none"><?php echo $u['id']?></h6>
                <h1><?php echo $u['username']?></h1>
                <p class="title">Email : <?php echo $u['email']?></p>
                

                   
                    <button class="btn btn-success" ng-click="unFriend(<?php echo $u['id'];?>);"><i class="fa fa-close" aria-hidden="true"></i>
                    Unfriend</button>
                    
               
                    
            </div>        
            
        </div>
        <div class="col-sm-7" ng-controller="DmController">
        <h1>Messages</h1>
					<button ng-click="lookMore();" ng-if="more"  class="btn btn-outline-danger btn-sm btn-block">Look More</button>
					<button ng-click="lookLess();" ng-if="less" class="btn btn-outline-danger btn-sm btn-block">Look Less</button>
					<div  ng-repeat="dm in dmmessages | limitTo:limitMessage">
				
					    <div class="alert alert-success" role="alert">
 								<p style="font-size:15px;">{{dm.date}}</p>
								<h6 class="text-right">{{dm.message}}</h6>
								<span id="user-sv">{{dm.username}}</span>
                                <!-- <div style="padding-left:80%">
									<span id="likeCount">{{dm.likes}}</span>
									
									<button class="btn btn-info btn-sm"  ng-click="Like(message.id);">Like</button>
									<span id="dislikeCount">{{dm.dislikes}}</span>
									<button class="btn btn-info btn-sm" ng-click="Dislike(message.id);">Dislike</button>
								</div> -->
						</div>
				
                    </div>
                    
                    <div id="emojiModal" class="modal">

							<!-- Modal content -->
							<div id="emojiContent" class="modal-content">
								<span id="closeEmojiList" class="close">&times;</span>
								<h1>Emoji List &#x1F602</h1>
								<hr>
								<div class="row" ng-repeat="emoji in emojis | limitTo : 15">
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
									<button id="btnEmojiAdd" ng-click="AddEmoji(emoji.char);">{{emoji.char}}</button>
								
								</div>

							</div>

						</div>
                    <div class="col-sm-12">
				
						 <form name="former">
					
						<input type="hidden" name="id" ng-model="id" ng-init="id=<?php echo $id ?>">
						<div class="row">
							<div class="col-sm-8 form-group">
								<textarea row="3" name="text" ng-model="message" class="form-control"></textarea>
							</div>
							
							<div class="col-sm-4 form-group">
                            <button id="btnEmojiList"><img src="assets/images/like.png" alt="" width="50" height="50">Emoji</button>

								<button ng-click="AddDmMessage();"  class="btn btn-success">Send</button>
                            
                            </div>
						</div>
					</form>
						 
				 </div>	


        </div>   
    
    
<?php } ?>



<?php
    include 'rightbar.php';
    include 'footer.php' ;
 ?>