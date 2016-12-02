<?php
   
    
    function displayTweets($conn){
        include_once 'src/Tweet.php';
        
        $tweet = new Tweet;

        if (isset($_POST['tweet']) && $_POST['tweet'] != "") {
            $tweet->createNewTweet($_POST['tweet'], $_SESSION['userId']);
            $tweet->saveToDB($conn);
        }
        if (isset($_POST['show_tweet'])){
            $show = $tweet->loadTweets($conn,$_SESSION['userId'], $_POST['show_tweet']);
            $tweet->displayTweetsOnPage($show, $conn);
        }


    }
    
    function displayMessages($conn){
        
        include_once 'src/Message.php';
        $message = new Message;
        if (isset($_POST['message']) && $_POST['message'] != "" && isset($_POST['reciverId'])
                ) {
            $message->createNewMessage($_POST['message'], $_SESSION['userId'], $_POST['recieverId']);
            $message->saveToDB($conn);
        }

        if (isset($_POST['showMessages'])) {
            $showM =$message->loadMessages($conn, $_SESSION['userId'], ($_POST['showMessages']));
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
            if (isset($_POST['TweetCreator'])) {
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

        if (isset($_POST['displayessage']) && isset($_POST['displayessage']) != '') {
            $message = new Message;
            $mes = $message->loadMessagesByMessageId($conn, $_POST['displayessage']);
            $message->displayDetailsMessagesOnPage($mes[0], $conn);
        }
    }