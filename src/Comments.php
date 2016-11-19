<?php

class Comments {
    
    private $id;
    private $tweetId;
    private $userId;
    private $CreationDate;
    private $text;
    
    public function __construct() {
     $this->id = -1;
     $this->tweetId = null;
     $this->userId = null;
     $this->creationDate = null;
     $this->text = "";
     
     
     }
     public function getId() {
         return $this->id;
     }

     public function getTweetId() {
         return $this->tweetId;
     }

     public function getUserId() {
         return $this->userId;
     }

     public function getCreationDate() {
         return $this->CreationDate;
     }

     public function getText() {
         return $this->text;
     }


     public function setTweetId($tweetId) {
         $this->tweetId = $tweetId;
     }

     public function setUserId($userId) {
         $this->userId = $userId;
     }

     public function setCreationDate() {
        return $this->creationDate = time();
     }

     public function setText($text) {
         $this->text = $text;
     }

     public static function loadCommentsByTweetId($conn, $id){
         
         $safeId=$conn->real_escape_string($id);
         $sql="SELECT * FROM comments WHERE tweet_id = $safeId ORDER BY comm_date DESC";
         $result=$conn->query($sql);
         $comments=[];
        if($result !=FALSE &&$result->num_rows>0){
            while ( $row=$result->fetch_assoc()){
                                                  
                $comment= new comments();
                $comment->tweetId = $row['tweet_id'];
                $comment->userId = $row['user_id'];
                $comment->creationDate = $row['comm_date'];
                $comment->text = $row['comm'];
                $comments[] = $comment;
            }
        }
         
        return $comments;
     
     }

       public function displayCommentsOnPage($tabOrObj,$conn){
    
         if  (is_array($tabOrObj)){
          foreach ($tabOrObj as $obj){
             print'<div style="margin-top : 5px">';
             Print 'komentarz z dnia'.$obj->creationDate.'<br>';
             Print 'o treści<br>'.$obj->text.'<br>';
             $safeId=$conn->real_escape_string($obj->userId);
             $sql= "SELECT username from users WHERE id =".$safeId;
             $result=$conn->query($sql);
             if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "skomentowane przez ".$row['username'];              
                }
          
             print"</div>"; 
            }
         
         }
      }  
// 
     }   
     
      public function createNewComment($newComment, $userId, $tweetId){
            
       
             $this->text = $newComment;
             $this->userid = $userId;
             $this->tweetId= $tweetId;
             return $this ;
            
     }


     public function saveCommentToDB($conn){
         
         
       $safeText=$conn->real_escape_string($this->getText());
       $safeTweet=$conn->real_escape_string($this->getTweetId());
       $sql='INSERT INTO comments ( comm, user_id, tweet_id) '
             . 'VALUES("'.$safeText.'", '.$_SESSION['userId'].','.$safeTweet.' )';
       
       $result= $conn->query($sql);
       if ($result){
           print'<div class="form" style="margin-top : 5px">';
             Print 'ostatnio dadany komentarz to  '.$this->getText().'<br>'; 
             print"</div>"; 
           
       }  else {
           print $conn->error;
       }
         
     }
     
}