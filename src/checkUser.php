<?php
//////////// spradza czy jest zalogowany właściwy użytkownik
include_once 'addUser.php';
           if(isset($_SESSION['hash'])){
                $conn=getDbConnection();               
                $sql= 'SELECT hashedPassword FROM `users` WHERE `email`="'.
                        ($_SESSION['userInputMail']).'"';
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();
                     if($row['hashedPassword']==$_SESSION['hash']){
                         include_once '../src/main.php';
                         include_once '../src/menu_engine.php';
                     }else {
                         session_destroy();
                        include_once '../src/logIn.php';
                     }
                
            
            } else {
                
            include_once '../src/logIn.php';
            }