<?php
class User{
	private $_db;
	function __construct($db){
		$this->_db=$db;
	}
	public function register($username,$email,$password,$image){
		try {
			$query = $this->_db->prepare("INSERT INTO users SET
				username = :username,
				password =:password,
				email =:email,
				image = :image");
			$query->bindValue(':username',$username);
			$query->bindValue(':password',$password);
			$query->bindValue(':email',$email);
			$query->bindValue(':image',$image);
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

	public function getAllUsers(){
		$query = $this->_db->prepare("SELECT * FROM users");
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
		$query=$this->_db->prepare("select * from user where id=:id");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
		
	}

	public function getFriends($id){
		$query = $this->_db->prepare("SELECT users.username FROM users INNER JOIN friends ON users.id=friends.friend_id WHERE friends.user_id=:id and friends.status_u=1 and friends.status_f=1");
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
			status_u=1");
			$query->bindValue(":user_id",$id);
			$query->bindValue(":friend_id",$friend_id);
			$query->execute();
			return true;
	   }catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getRequests($id){

		$query = $this->_db->prepare("SELECT * FROM users INNER JOIN friends ON users.id=friends.user_id WHERE friends.friend_id=:id AND friends.status_f=0 AND friends.status_u=1");
		$query->bindValue(":id",$id);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function acceptRequest($id){
		$query = $this->_db->prepare("UPDATE friends INNER JOIN users ON users.id=friends.user_id SET friends.status_f=1 WHERE friends.friend_id=:id");
		$query->bindValue(":id",$id);
		$query->execute();
		return true;
	}

	public function deleteRequest($id,$friend_id){		
		$query=$this->_db->prepare("DELETE FROM friends WHERE friends.friend_id=:fid and friends.user_id=:id");
		$query-bindValue(":id",$id);
		$query->bindValue(":fid",$friend_id);
		$query->execute();
		return true;
	}

}
?>