<?php
class User{
	private $_db;
	function __construct($db){
		$this->_db=$db;
	}

	public function isValidEmail($email){
		
			 //patternimizi (kalıp) yukarıdaki gibi belirledik;
		
			  if (filter_var($email,FILTER_VALIDATE_EMAIL)){ //eregi() fonksiyonu belirleyici patterne uygun değerlerin içerik içinde arar sonuç olarak true yada false değer döndürür.
		
				 return true;
		
			  }
		
			  else {
		
				 return false;
		
			  }   
		
		   }


	public function accountActivation($email,$activation){
		$query = $this->_db->prepare("UPDATE users SET
		active=1 WHERE email=:email AND activation=:activation");
		$query->bindValue(":email",$email);
		$query->bindValue(":activation",$activation);

		$query->execute();
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}


	}	   


	public function register($username,$email,$password,$image,$activation){
		try {
			$query = $this->_db->prepare("INSERT INTO users SET
				username = :username,
				email =:email,
				password =:password,
				image = :image,
				activation=:activation");
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$query->bindValue(':image',$image);
			$query->bindValue(':activation',$activation);
			$insert = $query->execute();
			return true;
		} catch ( PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function login($username,$password){
		$query = $this->_db->prepare("select * from users where username=:username and password=:password");
		$query->bindValue(':username',$username);
		$query->bindValue(':password',$password);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_ASSOC);
				
		return $result;
	}
	public function logout(){
		session_destroy();
	}
	public function checkLogin(){
		if (isset($_SESSION['login']) && $_SESSION['login']==true) {
			return true;
		}
	}

	public function getIDwithSession(){
		if (isset($_SESSION['id']) && $_SESSION['id']==true) {
			return $_SESSION['id'];
		}
		else{
			return false;
		}
	}

	public function getAllUsers($id){
		$query = $this->_db->prepare("SELECT * FROM users WHERE users.id!= 
		ALL(SELECT block.friend_id FROM block WHERE block.user_id=:id
		 UNION ALL SELECT block.user_id FROM block WHERE block.friend_id=:id)");
		// $query = $this->_db->prepare("SELECT DISTINCT users.id , users.username , users.image 
		// FROM users LEFT JOIN friends ON users.id=friends.friend_id WHERE users.id!= 
		// ALL(SELECT friends.user_id FROM friends WHERE friends.friend_id=:id AND
		//  friends.status=3 UNION ALL SELECT friends.friend_id FROM friends 
		//  WHERE friends.user_id=:id AND friends.status=3 )");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function deleteUser($id){
		$query = $this->_db->prepare("DELETE FROM users WHERE id=:id");
		$query->bindValue(":id",$id);
		$result = $query->execute();
		return $result;
	}

	public function getUserByID($id){
		$query=$this->_db->prepare("SELECT * FROM users WHERE id=:id");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
		
	}
	public function getUserByUsername($username){
		$query = $this->_db->prepare("SELECT * FROM users WHERE username=:username");
		$query->bindValue(":username",$username);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getFriends($id){
		// $query = $this->_db->prepare("SELECT * FROM users INNER JOIN friends ON users.id=friends.user_id WHERE friends.status=1 and friends.friend_id=:id UNION ALL SELECT * FROM users INNER JOIN friends ON users.id=friends.friend_id WHERE friends.status=1 and friends.user_id=:id");
		$query = $this->_db->prepare("SELECT * FROM users INNER JOIN friends ON 
		users.id = friends.user_id WHERE friends.status=1 AND friends.friend_id=:id 
		AND users.id!=ALL(SELECT users.id FROM users INNER JOIN block ON users.id=block.friend_id
		 WHERE block.user_id=:id UNION ALL SELECT users.id FROM users INNER JOIN block 
		 ON users.id=block.user_id WHERE block.friend_id=:id) UNION ALL SELECT * 
		 FROM users INNER JOIN friends ON users.id=friends.friend_id WHERE friends.status=1 
		 AND friends.user_id=:id and users.id!=ALL(SELECT users.id FROM users INNER JOIN block 
		 ON users.id=block.friend_id WHERE block.user_id=:id UNION ALL SELECT users.id FROM users 
		 INNER JOIN block ON users.id=block.user_id WHERE block.friend_id=:id)");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function addFriend($id,$friend_id){
		try
		{
			$query = $this->_db->prepare("INSERT INTO friends SET
			user_id = :user_id,
			friend_id = :friend_id,
			status=0");
			$query->bindValue(":user_id",$id);
			$query->bindValue(":friend_id",$friend_id);
			$query->execute();
			return true;
	   }catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getRequests($id){

		// $query = $this->_db->prepare("SELECT * FROM users INNER JOIN friends ON users.id=friends.user_id WHERE friends.friend_id=:id AND friends.status=0");
		$query = $this->_db->prepare("SELECT * FROM users INNER JOIN friends ON 
		users.id = friends.user_id WHERE friends.status=0 AND friends.friend_id=:id 
		AND users.id!=ALL(SELECT users.id FROM users INNER JOIN block ON users.id=block.friend_id
		 WHERE block.user_id=:id UNION ALL SELECT users.id FROM users INNER JOIN block 
		 ON users.id=block.user_id WHERE block.friend_id=:id)");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function acceptRequest($id,$fid){
		$query = $this->_db->prepare("UPDATE friends SET friends.status=1 WHERE friends.user_id=:fid and friends.friend_id=:id");
		$query->bindValue(":id",$id);
		$query->bindValue(":fid",$fid);
		$query->execute();
		return true;
	}

	public function deleteRequest($id){		
		$query=$this->_db->prepare("DELETE FROM friends WHERE id=:id");
		$query->bindValue(":id",$id);
		$result = $query->execute();
		return $result;
	}

	public function checkRequest($id,$fid){
		$query = $this->_db->prepare("SELECT * FROM friends WHERE friends.user_id=:id AND friends.friend_id=:fid OR friends.user_id=:fid AND friends.friend_id=:id");
		$query->bindValue(":id",$id);
		$query->bindValue(":fid",$fid);
		$query->execute();
		if($query->rowCount()>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function passChange($id,$lastp,$newp){
		$query = $this->_db->prepare("UPDATE users SET password=:newp WHERE id=:id AND password=:lastp");
		$query->bindValue(":id",$id);
		$query->bindValue(":newp",$newp);
		$query->bindValue(":lastp",$lastp);
		$query->execute();
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}



	public function blockUser($id,$fid){
		// $query = $this ->_db->prepare("UPDATE friends SET friends.status=3 WHERE 
		// (friends.user_id = :id AND friends.friend_id=:fid) or 
		// (friends.user_id=:fid AND friends.friend_id=:id)");
		// $queryBlock = $this->_db->prepare("INSERT INTO block SET user_id=:id,friend_id=:fid");
		// $queryBlock->bindValue(":id",$id);
		// $queryBlock->bindValue(":fid",$fid);
		// $query->bindValue(":id",$id);
		// $query->bindValue(":fid",$fid);
		// $queryBlock->execute();
		$query = $this->_db->prepare("INSERT INTO block SET user_id=:id,friend_id=:fid");
		$query->bindValue(":id",$id);
		$query->bindValue(":fid",$fid);
		$query->execute();
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}


	public function unFriendUser($id,$fid){

		$query=$this->_db->prepare("DELETE FROM friends WHERE user_id=:id AND friend_id=:fid OR user_id=:fid AND friend_id=:id");
		$query->bindValue(":id",$id);
		$query->bindValue(":fid",$fid);
		$query->execute();
		return true;



	}

	public function blockList($id){

		$query = $this->_db->prepare("SELECT * FROM users INNER JOIN block ON users.id=block.friend_id 
		WHERE block.user_id=:id");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;


	}

	public function removeBlock($id,$fid){

		$query = $this ->_db->prepare("DELETE FROM block WHERE user_id=:id AND friend_id=:fid");
		$query->bindValue(":id",$id);
		$query->bindValue(":fid",$fid);
		$query->execute();
		return true;

	}

	public function getPoint($user_id,$game_id){
		$query=$this->_db->prepare("SELECT * FROM points WHERE user_id=:user_id AND game_id=:game_id");
		$query->bindValue(":user_id",$user_id);
		$query->bindValue(":game_id",$game_id);
		$query->execute();
		$result = $query->fetchObject();
		return $result;
	}

	public function getUserPoint($id,$game_id){
		$query=$this->_db->prepare("SELECT users.username , users.image , points.point 
		FROM users INNER JOIN points ON users.id=points.user_id WHERE points.game_id=:game_id AND users.id!= 
		ALL(SELECT block.friend_id FROM block WHERE block.user_id=:id 
		UNION ALL SELECT block.user_id FROM block WHERE block.friend_id=:id) 
		ORDER BY points.point DESC");
		$query->bindValue(":id",$id);
		$query->bindValue(":game_id",$game_id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function addPoint($user_id,$game_id,$point){
			$query=$this->_db->prepare("SELECT points.point FROM points WHERE points.user_id=:user_id AND points.game_id=:game_id");
			$query->bindValue(":user_id",$user_id);
			$query->bindValue(":game_id",$game_id);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);

		if($result){
			$query=$this->_db->prepare("UPDATE points SET points.point=:point WHERE 
			points.user_id=:user_id AND points.game_id=:game_id");
			$query->bindValue(":point",$point);
			$query->bindValue(":user_id",$user_id);
			$query->bindValue(":game_id",$game_id);
			$query->execute();
			return true;

		}
		else{
			$query=$this->_db->prepare("INSERT INTO points SET
			user_id=:user_id,
			game_id=:game_id,
			point=:point");
			$query->bindValue(":user_id",$user_id);
			$query->bindValue(":game_id",$game_id);
			$query->bindValue(":point",$point);
			$query->execute();
			return true;
		}
		
	}



	






}
?>