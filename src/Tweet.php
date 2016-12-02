<?php

    include_once 'Comments.php';

    class Tweet {

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

        protected function setCreationDate() {
            return $this->creationDate = date('Y-m-d H:i:s', time());
        }

        public function loadTweets($conn, $id, $type) {

            $safeId = $conn->real_escape_string($id);
            if ($type == "my") {
                $query = "WHERE user_id = " . $safeId . " ORDER BY tweet_date DESC";
            } elseif ($type == "tweet") {
                $query = "WHERE id = " . $safeId . " ORDER BY tweet_date DESC";
            } elseif ($type == "all") {
                $query = "ORDER BY tweet_date DESC";
            }

            $sql = "SELECT * FROM tweets " . $query;
            $result = $conn->query($sql);
            $tweets = [];
            if ($result != FALSE && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $tweet = new Tweet();
                    $tweet->id = $row['id'];
                    $tweet->text = $row['tweet'];
                    $tweet->creationDate = $row['tweet_date'];
                    $tweet->userid = $row['user_id'];
                    $tweets[] = $tweet;
                }
            } elseif ($result != FALSE && $result->num_rows = 0) {
                $tweets = "Brak Tweetów";
            } else {
                $tweets = "wystąpił błąd " . $conn->errno;
            }

            return $tweets;
        }

        public function createNewTweet($newTweet, $userId) {
            $this->text = $newTweet;
            $this->creationDate = $this->setCreationDate();
            $this->userid = $userId;
            return $this;
        }

        public function saveToDB($conn) {
            $safeGetCreationDate = $conn->real_escape_string($this->getCreationDate());
            $safeGetText = $conn->real_escape_string($this->getText());
            $safeGetUseridt = $conn->real_escape_string($this->getUserid());

            $sql = 'INSERT INTO tweets (tweet_date, tweet, user_id) '
                    . 'VALUES("' . $safeGetCreationDate . '" , "' . $safeGetText . '", ' . $safeGetUseridt . ')';

            $result = $conn->query($sql);

            if ($result) {
                print'<div class="form" style="margin-top : 5px">';
                Print 'ostatnio dodane ćwierknięcie ' . $this->getText() . ' <br>';
                print"</div>";
                unset($_POST['tweet']);
            }
        }

        //// wyyświetla tweety z podstawowymi informacjami 
        public function displayTweetsOnPage($tweets, $conn) {
            if (is_array($tweets)) {
                foreach ($tweets as $tweet) {
                    Print'<div style="border:2px solid black">';
                    Print 'ćwierknięcie z dnia' . $tweet->creationDate . '<br>';
                    Print 'o treści<br>' . $tweet->text . '<br>';
                    $safeuserId = $conn->real_escape_string($tweet->userid);
                    $sql = "SELECT username from users WHERE id =" . $safeuserId;
                    $result = $conn->query($sql);
                    if ($result != FALSE && $result->num_rows == 1) {

                        while ($row = $result->fetch_assoc()) {
                            print "opublikowane przez " . $row['username'];
                        }

                        print '<form method="POST"><button type="submit" name="CheckTweet"
                        value="' . $tweet->id . '"action="#">szczegoly tweeta</button></form>';
                        $comments = comments:: loadCommentsByTweetId($conn, $tweet->id);
                        print "ilość komentarzy do tego tweeta to <br>" . count($comments) . "</div>";
                    }
                }
            } else {
                Print'<div style="border:2px solid black">';
                Print $messages;
                print "</div>";
            }
        }

        ////////////////////////////////wyświetla stronę tweeta z pełnymi informacjami
        public function displayTweetsOnTweetPage($tweets, $conn) {
            if (is_array($tweets)) {
                $tweet = $tweets[0];
                print'<div style="border:2px solid black">';
                Print 'ćwierknięcie z dnia' . $tweet->creationDate . '<br>';
                Print 'o treści<br>' . $tweet->text . '<br>';

                $safeuserid = $conn->real_escape_string($tweet->userid);
                $sql = "SELECT username from users WHERE id =" . $safeuserid;
                $result = $conn->query($sql);

                if ($result != FALSE && $result->num_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        print "opublikowane przez " . $row['username'] . '<br>';
                        print '   <form method="POST">
                <input type="hidden" name="TweetCreator" value="' . $tweet->id . '">
                <button type="submit" name="createMessage" value=""action="#">
                Wyślij wiadomość do właściciela</button></form>
                ';
                    }

                    $comments = comments:: loadCommentsByTweetId($conn, $tweet->id);
                    $comment = new comments();
                    $comment->displayCommentsOnPage($comments, $conn);
                    print'<form method="POST">
            <input type="text" name="comment" placeholder="Twój komentarz" maxlength="40"> 
            <input type="hidden" name="CheckTweet" value="' . $tweet->id . '"> 
            <button type="submit">Ćwerknij komentarz</button>
            </form></div>';
                }
            }else{
                 print'<div style="border:2px solid black">';
                 print "wystąpił błąd";
                 print'</div>';
            }
        }

    }

    // end of class Tweet
