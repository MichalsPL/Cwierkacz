<?php
///////////// obsługa przycisków po lewej stronie menu 
////////////////////////Wylogowyanie
     
            if (isset($_POST['logout'])){
              session_destroy();
              $page = $_SERVER['PHP_SELF'];
              $sec = "1";
              header("Refresh: $sec; url=$page");
         }
         
////////////////// wyświetlanie ustawień na środku 

if (isset($_POST['preferences'])||isset($_POST['DelUser'])||
        isset($_POST['ChangePassword'])|| isset($_POST['NewPassword'])|| 
        isset($_POST['newUserName']) || isset($_POST['ChangeUserName']) )
    include_once '../src/preferences.php';
