<?php 

class Mess {
    
    private $_db;
	function __construct($db){
		$this->_db=$db;
	}



    public function addMess($text,$date,$id){
        try{
            $query = $this->_db->prepare("INSERT INTO message SET
            text = :text,
            date = :tarix,
            user_id=:id");
            $query->bindValue(':text',$text);
            $query->bindValue(':tarix',$date,PDO::PARAM_STR);
            $query->bindValue(':id',$id);
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function getAllMessage(){

        $query = $this->_db->prepare("select users.username , message.text , message.date from message INNER JOIN users on message.user_id=users.id
        order by date desc");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function deleteMessage($id){
        $query = $this->_db->prepare("delete from message where id=:id");
        $query->bindValue(":id",$id);
        $result = $query->execute();
        return $result;
    
    }

    

}
















?>