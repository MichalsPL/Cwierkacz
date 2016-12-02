<?php

    class Message {

        private $message;
        private $senderId;
        private $reciverId;
        private $id;
        private $isReaded;
        private $sendDate;

        public function __construct() {
            $this->message = "";
            $this->senderId = NULL;
            $this->reciverId = NULL;
            $this->id = NULL;
            $this->isReaded = NULL;
            $this->sendDate = "";
        }

        public function getMessage() {
            return $this->message;
        }

        public function getSenderId() {
            return $this->senderId;
        }

        public function getReciverId() {
            return $this->reciverId;
        }

        public function getId() {
            return $this->id;
        }

        public function getIsReaded() {
            return $this->isReaded;
        }

        public function getSendDate() {
            return $this->sendDate;
        }

        public function setMessage($message) {
            $this->message = $message;
        }

        public function setSenderId($senderId) {
            $this->senderId = $senderId;
        }

        public function setReciverId($reciverId) {
            $this->reciverId = $reciverId;
        }

        public function setIsReaded($isReaded) {
            $this->isReaded = $isReaded;
        }

        public function setSendDate($sendDate) {
            $this->sendDate = $sendDate;
        }

        public function loadMessages($conn, $id, $type) {
            $safeid = $conn->real_escape_string($id);
            if ($type == 'sended') {
                $query = "WHERE sender_id =  " . $safeid;
            } elseif ($type == 'recieved') {
                $query = "WHERE reciver_id =  " . $safeid;
            } elseif ($type == 'id') {
                $query = "WHERE id =  " . $safeid;
            }

            $sql = "SELECT * FROM messages " . $query;
            $result = $conn->query($sql);
            $messages = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $message = new Message;
                    $message->message = $row['message'];
                    $message->senderId = $row['sender_id'];
                    $message->reciverId = $row['reciver_id'];
                    $message->id = $row['id'];
                    $message->isReaded = $row['is_readed'];
                    $message->sendDate = $row['send_time'];
                    $messages[] = $message;
                }
            } elseif ($result && $result->num_rows == 0) {
                $messages = "nie ma wiadomości";
            } else {
                $messages = "wystąpił bład " . $conn->errno;
            }
            return $messages;
        }

        public function createNewMessage($newMessage, $senderId, $reciverId) {
            if ($senderId != $reciverId) {
                $this->message = $newMessage;
                $this->senderId = $senderId;
                $this->reciverId = $reciverId;
                $this->isReaded = 0;
                return $this;
            } else {
                print 'nie możesz wysłać wiadomości do siebie';
            }
        }

        public function saveMessagetoDB($conn) {
            $safeIsReaded = $conn->real_escape_string($this->getIsReaded());
            $safeGetReciver = $conn->real_escape_string($this->getReciverId());
            $safeGetSenderId = $conn->real_escape_string($this->getSenderId());
            $safeGetMessage = $conn->real_escape_string($this->getMessage());
            $sql = 'INSERT INTO messages '
                    . '( is_readed, reciver_id, sender_id,  message) '
                    . 'VALUES(' . $safeIsReaded . ',' . $safeGetReciver . ', '
                    . $safeGetSenderId . ',"' . $safeGetMessage . '")';
            $result = $conn->query($sql);
            
            if ($result) {
                Print'<div class="form" style="margin-top : 5px">';
                Print 'Wiadomość o treści  ' . $this->getMessage() .
                        ' została dodana <br></div>';
            } else {
                Print "Błąd" . $conn->errno;
            }
        }

        public function displayMessagesOnPage($messages, $conn) {
            if (is_array($messages)) {
                foreach ($messages as $message) {
                    print'<div class="form">';
                    if ($message->isReaded == 0) {
                        print "<strong>";
                    }
                    $safeGetSenderId = $conn->real_escape_string
                            (($message->senderId));

                    Print 'Wiadomość z dnia' . $message->sendDate . '<br>';

                    $sql = "SELECT username from users WHERE id =" . $safeGetSenderId;
                    $result = $conn->query($sql);

                    if ($result != FALSE && $result->num_rows == 1) {
                        while ($row = $result->fetch_assoc()) {
                            Print "Od " . $row['username'] . '<br>';
                            Print 'o początku <br>' . substr($message->getMessage(), 0, 30) . '<br>';
                            Print' <form method="POST"><input type="hidden" name="displayessage" '
                                    . 'value="' . $message->getId() . '"><button type="submit" name="ShowOneMessage"'
                                    . ' action="#">zobacz całą wiadomość </button></form>';
                        }
                    }
                    if ($message->isReaded == 0) {
                        print "</strong>";
                    }
                    print"</div>";
                }
            } else {
                print'<div class="form">';
                print $messages;
                print"</div>";
            }
        }

        public function displayDetailsMessagesOnPage($message, $conn) {

            Print'<div class="form">';
            Print 'Wiadomość z dnia' . $message->sendDate . '<br>';

            $safeGetSenderId = $conn->real_escape_string($message->senderId);
            $sql = "SELECT username from users WHERE id =" . $safeGetSenderId;
            $result = $conn->query($sql);

            if ($result != false && $result->num_rows == 1) {

                while ($row = $result->fetch_assoc()) {
                    print "Od " . $row['username'] . '<br>';
                    Print 'o treści <br>' . $message->getMessage() . '<br>';
                }
                if ($message->isReaded == 0 && $_SESSION['userId'] == $message->getreciverId()) {
                    $safeId = $conn->real_escape_string($message->id);
                    $sql = "UPDATE `messages` SET is_readed=1 WHERE id = " . $safeId;
                    $result = $conn->query($sql);
                }
            }
            print"</div>";
        }

    }
    