
<div class="col-sm-8">
					<h1>Messages</h1>
					<button ng-click="lookMore();" ng-if="more"  class="btn btn-outline-danger btn-sm btn-block">Look More</button>
					<button ng-click="lookLess();" ng-if="less" class="btn btn-outline-danger btn-sm btn-block">Look Less</button>
					<div  ng-repeat="message in messages | limitTo:limitMessage">
				
					    <div class="alert alert-success" role="alert">
 								<p style="font-size:15px;">{{message.date}}</p>
								<h6 class="text-right">{{message.text}}</h6>
								<span id="user-sv">{{message.username}}</span>
								<div style="padding-left:80%">
									<span id="likeCount">{{message.likes}}</span>
									
									<button class="btn btn-info btn-sm"  ng-click="Like(message.id);">Like</button>
									<span id="dislikeCount">{{message.dislikes}}</span>
									<button class="btn btn-info btn-sm" ng-click="Dislike(message.id);">Dislike</button>
								</div>
								

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
									<textarea row="3" name="text" ng-model="text" class="form-control"></textarea>
								</div>
								
								<div class="col-sm-4 form-group">
									<button id="btnEmojiList"><img src="assets/images/like.png" alt="" width="50" height="50">Emoji</button>
									<button ng-click="Add();"  class="btn btn-success btn-lg">Send</button>

								</div>
							</div>
					    </form>
				    </div>	
					
</div>