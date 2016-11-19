<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

            include_once 'User.php';
            include_once 'Connect.php';
            
            
function addUser(){
              if(isset($_POST['login'])&& $_POST['login']!=''&&
               isset($_POST['email'])&& $_POST['email']!=''&& 
                filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)!=null &&
               isset($_POST['password'])&& $_POST['password']!=''
                    && !isset($_SESSION['hash'])){
            $conn=  getDbConnection();
            $safemail=$conn->real_escape_string($_POST['email']);
            $sql='SELECT * FROM `users` WHERE `email` ="'.$safemail.'"';
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
           
              if($row['email']==$_POST['email']){
              print"użytkownik już istnieje"; 
              return false;
               } 
             else{
                         
                   $user= new User;
                   $user->setUsername($_POST['login']);
                   $user->setEmail($_POST['email']);
                   $user->setHashedPassword($_POST['password']);
                   $user->saveToDB($conn);}
                   closeConnection($conn);
                  print "użytkownik został utworzony przenosimy cię do strony logowanie "; 
                  $page = "index.php";
                       $sec = "4";
                       header("Refresh: $sec; url=$page");
                       return TRUE;
               }else{
                 print "Wprowadziłeś niepoprawe dane (wymagane wszystkie pola)";
              
               }
}              


            
          