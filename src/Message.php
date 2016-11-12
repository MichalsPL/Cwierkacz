<?php
class Message{
   
    private $message;
    private $senderId;
    private $reciverId;
    private $id;
    private $isReaded;
    private $sendDate;
    
    
    public function __construct() {
        $this->message = "";
        $this->senderId = NULL;
        $this->reciverId = NULL;
        $this->id = NULL;
        $this->isReaded = NULL;
        $this->sendDate = "";
    }
    
    public function getMessage() {
        return $this->message;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReciverId() {
        return $this->reciverId;
    }

    public function getId() {
        return $this->id;
    }

    public function getIsReaded() {
        return $this->isReaded;
    }

    public function getSendDate() {
        return $this->sendDate;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setReciverId($reciverId) {
        $this->reciverId = $reciverId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIsReaded($isReaded) {
        $this->isReaded = $isReaded;
    }

    public function setSendDate($sendDate) {
        $this->sendDate = $sendDate;
    }

   public function loadMessageByRecieverId($conn, $id){
       $safeid=$conn->real_escape_string($id);
       $sql="SELECT * FROM messages WHERE reciver_id =  ".($safeid);
        $result=$conn->query($sql);
        $messages=[];
        if($result !=FALSE &&$result->num_rows>0){
            while ( $row=$result->fetch_assoc()){
             $message= new Message;                                         
             $message->message = $row['message'];
             $message->senderId = $row['sender_id'];
             $message->reciverId = $row['reciver_id'];
             $message->id = $row['id'];
             $message->isReaded = $row['is_readed'];
             $message->sendDate = $row['send_time'];
            
            $messages[] = $message;
            }
        }
         
        return $messages;
     
     }
        public function loadSendedMessages($conn, $id){
          $safeid=$conn->real_escape_string($id);
         $sql="SELECT * FROM messages WHERE reciver_id =  ".($safeid);
        $result=$conn->query($sql);
        $messages=[];
        if($result !=FALSE &&$result->num_rows>0){
            while ( $row=$result->fetch_assoc()){
                $message= new Message;                                       
             $message->message = $row['message'];
             $message->senderId = $row['sender_id'];
             $message->reciverId = $row['reciver_id'];
             $message->id = $row['id'];
             $message->isReaded = $row['is_readed'];
             $message->sendDate = $row['send_time'];
            
            $messages[] = $message;
            }
        }
         
        return $messages;
     
     }
     
      public function loadMessagesByMessageId($conn, $id){
         $safeid=$conn->real_escape_string($id);
         $sql="SELECT * FROM messages WHERE reciver_id =  ".($safeid);
        $result=$conn->query($sql);        
        $messages=[];
        if($result !=FALSE &&$result->num_rows>0){
            while ( $row=$result->fetch_assoc()){
             $message= new Message;                                       
             $message->message = $row['message'];
             $message->senderId = $row['sender_id'];
             $message->reciverId = $row['reciver_id'];
             $message->id = $row['id'];
             $message->isReaded = $row['is_readed'];
             $message->sendDate = $row['send_time'];  
            $messages[] = $message;
            }
        }
        return $messages;
     
     }


     public function createNewMessage($newMessage, $senderId, $reciverId ){
          if($senderId!=$reciverId){
             $this->message = $newMessage;
             $this->senderId = $senderId;
             $this->reciverId = $reciverId;
             $this->isReaded = 0;
             return $this ;
          }else 
              print 'nie możesz wysłać wiadomości do siebie';
     }
     
     public function saveMessagetoDB($conn){
          $safeIsReaded=$conn->real_escape_string($this->getIsReaded());
          $safeGetReciver=$conn->real_escape_string($this->getReciverId());
          $safeGetSenderId=$conn->real_escape_string( $this->getSenderId());
          $safeGetMessage=$conn->real_escape_string($this->getMessage());
        $sql='INSERT INTO messages ( is_readed, reciver_id, sender_id,  message) '
                . 'VALUES('.$safeIsReaded.','.$safeGetReciver.', '
                .$safeGetSenderId.',"'.$safeGetMessage.'")';
  
       $result= $conn->query($sql);
       if ($result){
           print'<div class="form" style="margin-top : 5px">';
             Print 'Wiadomośś o treści  '.$this->getMessage().' została dodane <br>';
             
             print"</div>"; 
     }else print $conn->error;

  }
  
  
       public function displayMessagesOnPage($tabOrObj,$conn){
         if (is_object($tabOrObj)){
             print'<div class="form" style="margin-top : 5px">';
                   if($tabOrObj->isReaded==0) print "<strong>" ;
                   $safeGetSenderId=$conn->real_escape_string( ($tabOrObj->senderId));
             Print 'Wiadomość z dnia'.$tabOrObj->sendDate.'<br>';
              $sql= "SELECT username from users WHERE id =".$safeGetSenderId;
              $result=$conn->query($sql);
            if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "Od ".$row['username'].'<br>';
             Print 'o początku <br>'.substr($tabOrObj->getMessage(),0,30).'<br>';
             
             if($tabOrObj->isReaded==0) print "</strong>";
             
             print' <form method="POST"><input type="hidden" name="displayessage" '
             . 'value="'.$tabOrObj->getId().'"><button type="submit" name="ShowOneMessage"'
                   . ' action="#">zobacz całą wiadomość </button></form>'; 
               }
            }  
         
             print"</div>"; 
        }
    
         if  (is_array($tabOrObj)){
          foreach ($tabOrObj as $obj){
            print'<div class="form" style="margin-top : 5px">';
             if($obj->isReaded==0) print "<strong>" ;
             Print 'Wiadomość z dnia'.$obj->sendDate.'<br>';
             $safeGetSenderId=$conn->real_escape_string($obj->senderId);
             $sql= "SELECT username from users WHERE id =".$safeGetSenderId;
            $result=$conn->query($sql);
            if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "Od ".$row['username'].'<br>';
             Print 'o początku <br>'.substr($obj->getMessage(),0,30).'<br>';
             if($obj->isReaded==0) print "</strong>";
           print' <form method="POST"><input type="hidden" name="displayessage" value="'
             .$obj->getId().'"><button type="submit" name="ShowOneMessage" action="#">zobacz całą wiadomość </button></form>'; 
               }
            }  
         
             print"</div>";  
            }
         
         }
         }  
         
         
                public function displayDetailsMessagesOnPage($obj,$conn){
         if (is_object($obj)){
      
             print'<div class="form" style="margin-top : 5px">';
                  
                   
             Print 'Wiadomość z dnia'.$obj->sendDate.'<br>';
             $safeGetSenderId=$conn->real_escape_string($obj->senderId);
              $sql= "SELECT username from users WHERE id =".$safeGetSenderId;
              $result=$conn->query($sql);
            if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "Od ".$row['username'].'<br>';
                Print 'o treści <br>'.$obj->getMessage().'<br>';}
              if($obj->isReaded==0 && $_SESSION['userId']==$obj->getreciverId()) {
                  $safeId=$conn->real_escape_string($obj->id);
                  $sql="UPDATE `messages` SET is_readed=1 WHERE id = ".$safeId;
                  $result=$conn->query($sql);
                  
              
             

               }
            }
         
             print"</div>"; 
        }
// 
     }
}
