  <?php
            include_once 'Connect.php';

            function CheckUser(){
                session_start();
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
                       $page = "main.php";
                       $sec = "1";
                       header("Refresh: $sec; url=$page");
                       Print "Dziękujemy za zalogowanie";
                       return TRUE;
        
                }else{
                  Print "Nie ma takiego użytkownika lub hasło niepoprawne";
                  return false;
                }
                   }else{
                  if(isset($_POST['userMail']) &&
               !filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)!=null){
                      print "Podaj prawidłowy email";
                      return FALSE;
                  }
        
                  return FALSE;
                }
            }
            
    function checkLoggedUser(){
                        session_start();
      
               if(isset($_SESSION['hash'])&& $_SESSION['hash']!=''&&
               isset($_SESSION['userInputMail'])&& $_SESSION['userInputMail']!=''&&
               isset($_SESSION['userId'])&& $_SESSION['userId']!=''){

                    $conn=  getDbConnection();
                    $userInputMail=$conn->real_escape_string($_SESSION['userInputMail']);
                    $sql='SELECT * FROM `users` where email="'.$userInputMail.'"';
                    $result=$conn->query($sql);
                    $usr=$result->fetch_assoc();
                    $userInputHash=$_SESSION['hash'];
                         if(  $userInputHash ==  $usr['hashedPassword'] ){


                            return TRUE;

                         }else{
                            $page = "index.php";
                            $sec = "0.1";
                            header("Refresh: $sec; url=$page");
                            return false;
                }
              }else{
                       $page = "index.php";
                       $sec = "0.1";
                       header("Refresh: $sec; url=$page");
                       return false;
                }
    }