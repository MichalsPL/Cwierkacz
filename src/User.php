<?php

// ta klasa jest scisle powiazana z tabela user
/*     public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
 * CREATE TABLE users ( id int AUTO_INCREMENT, username varchar(255) NOT NULL, hashedPassword varchar(60) NOT NULL, email varchar(255) UNIQUE NOT NULL, PRIMARY KEY(id) )
 */

class User {  // wrzucic w setery real escape string
    private $id;
    private $username;
    private $hashedPassword;
    private $email;
    
    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function setHashedPassword($hashedPassword) {
        $newHashedPassword = password_hash($hashedPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
        return $this->hashedPassword;
    }
    
    public function checkHashedPassword($userInput, $email,$conn){
        $sql='SELECT hashedPassword FROM `users` where email="mailtset"';
        $result=$conn->query;
        password_verify (  $userInput ,  $hash );
    }

        public function saveToDB(mysqli $conn) {
        if ($this->id == -1) { // zastosowas prepare statements
            $statement = $conn->prepare("INSERT INTO users(username,
                hashedPassword, email) VALUES (?,?,?)");           
            $statement->bind_param('sss', $this->username, $this->
                    hashedPassword, $this->email);
            
            if ($statement->execute()) { //execute wysyla zapytanie do bazy
                $this->id = $statement->insert_id;
                return true;
                print "uzytkownik zostal utworzony ";
            }
            return false;
          print  'uzytkownik nie zostal utworzony';
        }
    }
    
    static public function loadUserById(mysqli $conn, $id){
        $sql="SELECT * FROM users WHERE id = $id";
        $result=$conn->query($sql);
        
        if($result !=FALSE &&$result->num_rows==1){
            $row=$result->fetch_assoc();
            
            $loadedUser=new User();
            $loadedUser->id =$row['id'];
            $loadedUser->email=$row['email'];
            $loadedUser=$row['hashedPassword'];
            $loadedUser=$username=$row['username'];
            
            return $loadedUser;
            
        }
        
        
   
    }
    
}





?>