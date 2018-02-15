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


    public function getAllMessage($id){
        
        // $query=$this->_db->prepare("SELECT * FROM users LEFT JOIN block ON users.id=block.friend_id
        //  INNER JOIN message ON users.id=message.user_id WHERE users.id!=ALL(SELECT block.friend_id
        //   FROM block WHERE block.user_id=:id UNION ALL SELECT block.user_id FROM 
        //   block WHERE block.friend_id=:id) ORDER BY date DESC");
        $query = $this->_db->prepare("SELECT DISTINCT(message.id) , users.username,
        message.text,message.date, (SELECT count(notions.notion) FROM notions WHERE 
        notions.notion=1 AND notions.message_id=message.id) as likes, (SELECT count(notions.notion)
         FROM notions WHERE notions.notion=2 AND notions.message_id=message.id) as dislikes 
         FROM users INNER JOIN message ON users.id=message.user_id LEFT JOIN notions ON 
         message.id=notions.message_id WHERE users.id!=ALL(SELECT block.friend_id FROM 
         block WHERE block.user_id=:id UNION ALL SELECT block.user_id FROM block WHERE 
         block.friend_id=:id) ORDER BY message.date DESC");
        $query->bindValue(":id",$id);
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

    public function getDmMessage($id,$fid){
        $query = $this->_db->prepare("SELECT users.username , dm_message.message , dm_message.date 
        FROM users INNER JOIN dm_message on users.id=dm_message.send_id 
        WHERE dm_message.send_id=:id and dm_message.rec_id=:fid UNION ALL 
        SELECT users.username , dm_message.message , dm_message.date 
        FROM users INNER JOIN dm_message on users.id=dm_message.send_id 
        WHERE dm_message.send_id=:fid and dm_message.rec_id=:id Order by date Desc");
        $query->bindValue(":id",$id);
        $query->bindValue(":fid",$fid);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function dmMessageAdd($id,$f_id,$message,$date){
        $query = $this->_db->prepare("INSERT INTO dm_message SET 
        send_id=:id,
        rec_id=:f_id,
        date=:date,
        message=:message");
        $query->bindValue(":id",$id);
        $query->bindValue(":f_id",$f_id);
        $query->bindValue(":date",$date);
        $query->bindValue(":message",$message);
        $query->execute();
        return true;
    }

    public function getLikes($messageID){
        $query = $this->_db->prepare("SELECT COUNT(*) as say FROM notions WHERE notions.message_id=:messageID 
        AND notions.notion=1");
        $query->bindValue(":messageID",$messageID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getDislikes($messageID){
        $query = $this->_db->prepare("SELECT COUNT(*) as say FROM notions WHERE notions.message_id=:messageID 
        AND notions.notion=2");
        $query->bindValue(":messageID",$messageID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function like($id,$message_id){
        $query=$this->_db->prepare("SELECT * FROM notions WHERE notions.friend_id=:id
        AND notions.message_id=:message_id");
       $query->bindValue(":id",$id);
       $query->bindValue(":message_id",$message_id);
       $query->execute();
  
       if($query->rowCount()>0){
                $query = $this->_db->prepare("UPDATE notions SET notions.notion=1 WHERE 
                notions.friend_id=:id AND notions.message_id=:message_id");
                $query->bindValue(":id",$id);
                $query->bindValue(":message_id",$message_id);
                $query->execute();
       }
       else{
               $query = $this->_db->prepare("INSERT INTO notions SET 
               notions.notion=1,
               notions.message_id=:message_id,
               notions.friend_id=:id");
               $query->bindValue(":message_id",$message_id);
               $query->bindValue(":id",$id);
               $query->execute();
        }
           
        
        
    }

    public function dislike($id,$message_id){
            $query=$this->_db->prepare("SELECT * FROM notions WHERE notions.friend_id=:id
             AND notions.message_id=:message_id");
            $query->bindValue(":id",$id);
            $query->bindValue(":message_id",$message_id);
            $query->execute();
       
            if($query->rowCount()>0){
                     $query = $this->_db->prepare("UPDATE notions SET notions.notion=2 WHERE 
                     notions.friend_id=:id AND notions.message_id=:message_id");
                     $query->bindValue(":id",$id);
                     $query->bindValue(":message_id",$message_id);
                     $query->execute();
            }
            else{
                    $query = $this->_db->prepare("INSERT INTO notions SET 
                    notions.notion=2,
                    notions.message_id=:message_id,
                    notions.friend_id=:id");
                    $query->bindValue(":message_id",$message_id);
                    $query->bindValue(":id",$id);
                    $query->execute();
             }
        
           
    
            
        
        
    }

    

    

}
















?>