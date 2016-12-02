<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div >


            <form method="POST">
                <button type="submit" name="logout" action="#">WYLOGUJ</button>
                <button type="submit" name="preferences">USTAWIENIA</button><br><br>
                <button type="submit" name="show_tweet" value="all">Wyświetl wszystkie Ćwięrknięcia</button>
                <button type="submit" name="show_tweet" value="my">Wyświetl moje Ćwięrknięcia</button><br><br>
            </form>  

            <form method="POST">
                <button type="submit" name="showMessages" value="sended"  >Zobacz wysłane wiadomośći</button>
                <button type="submit" name="showMessages" value="recieved">zobacz odebrane wiadomości </button>
                <button type="submit" name="createMessage">stwórz wiadomość </button>
            </form>
        </div>


        <div>
            <a href="src/preferences.php"></a>
            <div>

                <form method="POST">
                    <textarea  name="tweet"  maxlength="160" rows="3" cols ="60">
                        ćwierknijcoś
                    </textarea>
                    <button type="submit">Ćwerknij</button>
                </form>
            </div>

            <?php
                include_once 'src/display.php';
                include_once 'src/Login.php';
                include_once 'src/Preferences.php';
                include_once 'src/Comments.php';
                
                $conn = getDbConnection();
                checkLoggedUser();

                showPreferences();

                displayTweets($conn);

                displayMessages($conn);

                /////////////////////
                //tworzy komentarze//
                /////////////////////
                
                if (isset($_POST['comment']) && $_POST['comment'] != "" &&
                        isset($_POST['CheckTweet']) && $_POST['CheckTweet'] != ""
                ) {
                    $temp = new comments();
                    $temp->createNewComment($_POST['comment'], $_SESSION['userId'], $_POST['CheckTweet']);
                    $temp->saveCommentToDB($conn);
                }


                //////////////////////////////
                //wyświetlanie strony tweeta//
                /////////////////////////////
                if (isset($_POST['CheckTweet']) && $_POST['CheckTweet'] != "") {
                    $tweet = new Tweet;
                    $showById = $tweet->loadTweets($conn, ($_POST['CheckTweet']),"tweet");
                    
                        $tweet->displayTweetsOnTweetPage($showById, $conn);
                    
                }
            ?>


        </div>
    </body>
</html>
