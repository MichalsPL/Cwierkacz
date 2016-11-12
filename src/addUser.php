<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

            include_once 'user.php';
            include_once 'connect.php';
            
            
            /////////////dodawanie użytkownika 
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
              $newError= "użytkownik już istnieje"; 
              
               } 
             else{
                   $newError=  "użytkownik został utworzony zaloguj się ";        
                   $user= new User;
                   $user->setUsername($_POST['login']);
                   $user->setEmail($_POST['email']);
                   $user->setHashedPassword($_POST['password']);
                   $user->saveToDB($conn);}
                   closeConnection($conn);
               }else{
               $newError= "wypełnij wsystkie pola";
              
               }
               
//////////////////// sprawdzenie logowania 
               if(isset($_POST['userMail'])&& $_POST['userMail']!=''&&
               isset($_POST['password'])&& $_POST['password']!=''&&
               filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)!=null){
         
               $conn=  getDbConnection();
               $userInputMail=$conn->real_escape_string($_POST['userMail']);
               $sql='SELECT * FROM `users` where email="'.$userInputMail.'"';
               $result=$conn->query($sql);
               $usr=$result->fetch_assoc();
               $userInputPass=$_POST['password'];
                    if(password_verify (  $userInputPass ,  $usr['hashedPassword'] )){
                       $_SESSION['hash']=$usr['hashedPassword'];
                       $_SESSION['userInputMail']=$_POST['userMail'];
                       $_SESSION['userId']=$usr['id'];
                }else{
                  $error="nieprawidłowe dane";
                }
                   }else{
                  $error="wypełnij wszystkie pola";
                }

            
          