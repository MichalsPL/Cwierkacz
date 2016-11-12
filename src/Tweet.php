<?php
include_once 'commens.php';

 class Tweet{
     private $id;
     protected $userid;
     protected $text;
     protected $creationDate;
     
     public function __construct() {
     $this->id = -1;
     $this->userid = null;
     $this->text = "";
     $this->creationDate = null;
     
     }
     public function getId() {
         return $this->id;
     }

     public function getUserid() {
         return $this->userid;
     }

     public function getText() {
         return $this->text;
     }

     public function getCreationDate() {
         return $this->creationDate;
     }


     protected function setText($text) {
         $this->text = $text;
     }
     private function  setId($id){ /// wiem że miało nie być ale mi to do koncepcji nie paswowało
         $this->id=$id;
     }

     protected function setCreationDate() {
         return $this->creationDate = date('Y-m-d H:i:s', time() );
         
     }
     
     public function loadTweetById($conn, $id){
        $sql="SELECT * FROM tweets WHERE id = $id";
        $result=$conn->query($sql);
        
        if($result !=FALSE &&$result->num_rows==1){
            while ( $row=$result->fetch_assoc()){
                                                          
             $tweet = new Tweet();
             $tweet->setId($row['id']);
             $tweet->text = $row['tweet'];
             $tweet->creationDate = $row['tweet_date'];
             $tweet->userid = $row['user_id'];
            }
            return $tweet;
        }
         
     
     }

     public function loadTweetByUserId($conn, $id){
         $safeId=$conn->real_escape_string($id);
         $sql="SELECT * FROM tweets WHERE user_id = ".$safeId." ORDER BY tweet_date DESC";
         $result=$conn->query($sql);
         $tweets=[];
        if($result !=FALSE &&$result->num_rows>0){
            while ( $row=$result->fetch_assoc()){
                                                     
             $tweet = new Tweet();
             $tweet->id = $row['id'];
             $tweet->text = $row['tweet'];
             $tweet->creationDate = $row['tweet_date'];
             $tweet->userid = $row['user_id'];
            
            $tweets[] = $tweet;
            }
        }
         
        return $tweets;
     
     }
     
     
     public static function loadAllTweets($conn){
              $sql="SELECT * FROM tweets ORDER BY tweet_date DESC ";
        $result=$conn->query($sql);
        if($result !=FALSE &&$result->num_rows>0){
            $tweets=[];
            while ( $row=$result->fetch_assoc()){
                                                              
             $tweet = new Tweet();
             $tweet->id = $row['id'];
             $tweet->text = $row['tweet'];
             $tweet->creationDate = $row['tweet_date'];
             $tweet->userid = $row['user_id'];
             $tweets[] = $tweet;
            }
        }
         
        return $tweets;
     
     }
     
     public function createNewTweet($newTweet, $userId){

             
             $this->text = $newTweet;
             $this->creationDate = $this->setCreationDate();
             $this->userid = $userId;
             return $this ;
            
     }


     public function saveToDB($conn){
       $safeGetCreationDate=$conn->real_escape_string($this->getCreationDate());
       $safeGetText=$conn->real_escape_string($this->getText());
       $safeGetUseridt=$conn->real_escape_string($this->getUserid());
        $sql='INSERT INTO tweets (tweet_date, tweet, user_id) '
           . 'VALUES("'.$safeGetCreationDate.'" , "'.$safeGetText.'", '.$safeGetUseridt.')';
  
       $result= $conn->query($sql);
       if ($result){
           print'<div class="form" style="margin-top : 5px">';
             Print 'ćwierknięcie '.$this->getText().' zostalo dodane <br>';
             
             print"</div>"; 
           
       }
         
     }
     //// wyyświetla tweety z podstawowymi informacjami 
     public function displayTweetsOnPage($tabOrObj,$conn){
         if (is_object($tabOrObj)){
             foreach ($tabOrObj as $obj){
             print'<div class="form" style="margin-top : 5px">';
             Print 'ćwierknięcie z dnia'.$obj->creationDate.'<br>';
             Print 'o treści<br>'.$obj->text.'<br>';
              $safeuserid=$conn->real_escape_string($obj->userid);
             $sql= "SELECT username from users WHERE id =".$safeuserid;
            $result=$conn->query($sql);
            
             if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "opublikowane przez ".$row['username'];              
                }
                print '   <form method="POST"><button type="submit" name="CheckTweet" '
                . 'value="'.$obj->id.'"action="#">szczegoly tweeta</button></form>'; 
                $comm = comments:: loadCommentsByTweetId($conn, $obj->id);
                print "ilość komentarzy do tego tweeta to <br>". count($comm);
                print"</div>"; 
         }
       }
     }
         if  (is_array($tabOrObj)){
          foreach ($tabOrObj as $obj){
             print'<div class="form" style="margin-top : 5px">';
             Print 'ćwierknięcie z dnia'.$obj->creationDate.'<br>';
             Print 'o treści<br>'.$obj->text.'<br>';
             $safeuserid=$conn->real_escape_string($obj->userid);
             $sql= "SELECT username from users WHERE id =".$safeuserid;
            $result=$conn->query($sql);
             if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
              print "opublikowane przez ".$row['username'];              
                }
             print '   <form method="POST"><button type="submit" name="CheckTweet" '
                . 'value="'.$obj->id.'"action="#">szczegoly tweeta</button></form>'; 
            $comm = comments:: loadCommentsByTweetId($conn, $obj->id);
            print "ilość komentarzy do tego tweeta to <br>" . count($comm);
            print"</div>"; 
            }
         
         }
     }  

  }
     


 
 
 
 ////////////////////////////////wyświetla stronę tweeta z pełnymi informacjami
      public function displayTweetsOnTweetPage($tabOrObj,$conn){
         if (is_object($tabOrObj)){
             print'<div class="form" style="margin-top : 5px">';
             Print 'ćwierknięcie z dnia'.$tabOrObj->creationDate.'<br>';
             Print 'o treści<br>'.$tabOrObj->text.'<br>';
             $safeuserid=$conn->real_escape_string($tabOrObj->userid);
             $sql= "SELECT username from users WHERE id =".$safeuserid;
            $result=$conn->query($sql);
            if($result !=FALSE &&$result->num_rows==1){
                while ( $row=$result->fetch_assoc()){
             print "opublikowane przez ".$row['username'].'<br>';
             print '   <form method="POST"><input type="hidden" '
             . 'name="TweetCreator" value="'.$tabOrObj->userid.'"><button type="submit" name="createMessage" '
                . 'action="#">Wyślij wiadomość do właściciela</button></form>'; 
              print'        
      <form class="login-formComment" method="POST">
      <input type="text" name="comment" placeholder="Twój komentarz" maxlength="40"> 
      <input type="hidden" name="CheckTweet" style="display: none" value="'.$tabOrObj->id.'"> 
      <button type="submit">Ćwerknij komentarz</button>
    </form>
 ';
               }
        $comm = comments:: loadCommentsByTweetId($conn, $tabOrObj->id);
       $temp= new comments();
      $temp->displayCommentsOnPage($comm, $conn);    
     
    
   if (isset($_POST['comment'])&& $_POST['comment']!=""
           && isset($_POST['postId'])&& $_POST['postId']!=""){
    $temp->createNewComment($_POST['comment'], $_SESSION['userId'], $obj->id);
    $temp->saveCommentToDB($conn);
    }  
             print"</div>"; 
            }
    
         if  (is_array($tabOrObj)){
          foreach ($tabOrObj as $obj){
                 print'<div class="form" style="margin-top : 5px">';
             Print 'ćwierknięcie z dnia'.$obj->creationDate.'<br>';
             Print 'o treści<br>'.$obj->text.'<br>';
             $safeuserid=$conn->real_escape_string($obj->userid);
             $sql= "SELECT username from users WHERE id =".$safeuserid;
            $result=$conn->query($sql);
             if($result !=FALSE &&$result->num_rows==1){
                   while ( $row=$result->fetch_assoc()){
             print "opublikowane przez ".$row['username'].'<br>';
             print '   <form method="POST"><input type="hidden" '
             . 'name="TweetCreator" value=".$tabOrObj->id."><button type="submit" name="CheckTweet" '
                . 'value="createMessage"action="#">Wyślij wiadomość do właściciela</button></form>'; 
              print'  
                 
      <form class="login-formComment" method="POST">
      <input type="text" name="comment" placeholder="Twój komentarz" maxlength="40"> 
      <input type="hidden" name="CheckTweet" style="display: none" value="'.$tabOrObj->id.'"> 
      <button type="submit">Ćwerknij komentarz</button>

    </form>';}
      $comm = comments:: loadCommentsByTweetId($conn, $obj->id);
   
      $temp= new comments();
      $temp->displayCommentsOnPage($comm, $conn);    
     
    
   if (isset($_POST['comment'])&& $_POST['comment']!=""
           && isset($_POST['postId'])&& $_POST['postId']!=""){
    $temp->createNewComment($_POST['comment'], $_SESSION['userId'], $obj->id);
    $temp->saveCommentToDB($conn);
   }
            
          print'  
                 
      <form class="login-formComment" method="POST">
      <input type="text" name="comment" placeholder="Twój komentarz" maxlength="40"> 
      <input type="hidden" name="CheckTweet" style="display: none" value="'.$obj->id.'"> 
      <button type="submit">Ćwerknij komentarz</button>

    </form>
 ';
            
             print"</div>"; 
            }
         
         }
         }  
// 
     }
 }
}
      