<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="src/style/style_main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="side">


            <form class="leftIn" method="POST">

                <button type="submit" name="logout" action="#">WYLOGUJ</button>
                <button type="submit" name="preferences">USTAWIENIA</button>
                <button type="submit" name="show_all">Wyświetl wszystkie Ćwięrknięcia</button>
                <button type="submit" name="show_my">Wyświetl moje Ćwięrknięcia</button>


            </form>  

            <form class="rightIn" method="POST">
                <button type="submit" name="showSendedMessages"  action="#">Zobacz wysłane wiadomośći</button>
                <button type="submit" name="showRecivedMessages">zobacz odebrane wiadomości </button>
                <button type="submit" name="createMessage">stwórz wiadomość </button>
                <button type="submit">Szukaj</button>

            </form>
        </div>


        <div class="login-page">
            <a href="src/preferences.php"></a>
            <div class="form">

                <form class="login-form" method="POST">
                    <textarea  name="tweet"  maxlength="160" rows="3" cols ="60">ćwierknijcoś
                    </textarea>
                    <button type="submit">Ćwerknij</button>
                </form>
            </div>


            <?php
            /////////////////////////sprawdza czy zalogowany jest użytkownik
            include_once 'src/Login.php';
            checkLoggedUser();

            ////////////////////////   wyświetla ustawiena 
            include_once 'src/Preferences.php';
            showPreferences();

            $conn = getDbConnection();

            /////////////////////////////////////////////////////tworzy komentarze

            include_once 'src/Comments.php';
            if (isset($_POST['comment']) && $_POST['comment'] != "" && isset($_POST['CheckTweet']) && $_POST['CheckTweet'] != "") {
                $temp = new comments();
                $temp->createNewComment($_POST['comment'], $_SESSION['userId'], $_POST['CheckTweet']);
                $temp->saveCommentToDB($conn);
            }
            //////////////////////////////////////////////Tweety
            include_once 'src/Tweet.php';
            $tweet = new Tweet;

            if (isset($_POST['tweet']) && $_POST['tweet'] != "") {
                $tweet->createNewTweet($_POST['tweet'], $_SESSION['userId']);
                $tweet->saveToDB($conn);
            }
            if (!isset($_POST) || isset($_POST['show_all']) || isset($_POST['comment'])) {
                $show = $tweet->loadAllTweets($conn);
            }
            if (isset($_POST['show_my'])) {
                $show = $tweet->loadTweetByUserId($conn, $_SESSION['userId']);
            }
            if (isset($show)) {
                $tweet->displayTweetsOnPage($show, $conn);
            }

            /////////////////////////////////////////////////////////////// Wiadomości  
            include_once 'src/Message.php';
            $message = new Message;
            if (isset($_POST['message']) && $_POST['message'] != "" && isset($_POST['reciverId'])) {
                $message->createNewMessage($_POST['message'], $_SESSION['userId'], $_POST['recieverId']);
                $message->saveToDB($conn);
            }
            if (isset($_POST['showSendedMessages'])) {
                $showM = $message->loadSendedMessages($conn, $_SESSION['userId']);
            }
            if (isset($_POST['showRecivedMessages'])) {
                $showM = $message->loadMessageByRecieverId($conn, $_SESSION['userId']);
            }
            if (isset($showM)) {
                $message->displayMessagesOnPage($showM, $conn);
            }
            if (isset($_POST['createMessage'])) {
                            print '
                       <div class="login-page">
                       <div class="form">
                       <form class="login-form" method="POST">
                       <textarea type="text" name="newMessage"placeholder="napisz nową wiadomość "  rows="3" cols ="60"> 
                       Wyślij
                       </textarea>';
                if (isset($_POST['createMessage']) && isset($_POST['TweetCreator'])) {
                    print '<input type="hidden" name="recieverId" value="' . $_POST["TweetCreator"] . '">';
                } else {
                    print'   <input type="text" name="recieverId" placeholder="odiorca" maxlength="5" >';
                }
                print'  <button type="submit">Ćwerknij</button> </form> </div>';
            }

            if (isset($_POST['newMessage']) && $_POST['newMessage'] != "" && isset($_POST['recieverId'])) {
                $message = new Message;
                $message->createNewMessage($_POST['newMessage'], $_SESSION['userId'], $_POST['recieverId']);
                $message->saveMessagetoDB($conn);
            }

            if (isset($_POST['displayessage']) && isset($_POST['displayessage']) && isset($_POST['displayessage']) != '') {
                $message = new Message;
                $mes = $message->loadMessagesByMessageId($conn, $_POST['displayessage']);
                $message->displayDetailsMessagesOnPage($mes[0], $conn);
            }



////////////////////////////////////////////////////////////////// wyświetlanie po użytkowniku 
            if (isset($_POST['search_users'])) {
                print' <div class="login-page">
                    <div class="form">
                    <form class="login-form" method="POST">
                    <input type="text" name="ChooseUser"placeholder="wyszukaj użytkownika po ID" >
                    <button type="submit">Wybierz</button></form></div>';
            }
            if (isset($_POST['ChooseUser']) && $_POST['ChooseUser'] != "") {

                $tweet = new Tweet;
                $showByUsr = $tweet->loadTweetByUserId($conn, $_POST['ChooseUser']);

                    if (isset($showByUsr)) {
                        $tweet->displayTweetsOnPage($showByUsr, $conn);
                }
            }
//////////////////////////////////////////////////// wyświetlanie strony tweeta 
            if (isset($_POST['CheckTweet']) && $_POST['CheckTweet'] != "") {

                $tweet = new Tweet;
                $showById = $tweet->loadTweetById($conn, ($_POST['CheckTweet']));

                if (isset($showById)) {
                    $tweet->displayTweetsOnTweetPage($showById, $conn);
                }
            }
            ?>


        </div>
    </body>
</html>
