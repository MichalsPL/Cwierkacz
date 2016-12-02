<?php

    include_once 'User.php';
    include_once 'Connect.php';

    function addUser() {
        if (
                isset($_POST['login']) && $_POST['login'] != '' &&
                isset($_POST['email']) &&
                filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) != null &&
                isset($_POST['password']) && $_POST['password'] != '' && !isset($_SESSION['hash'])
        ) {
            $conn = getDbConnection();
            $safemail = $conn->real_escape_string($_POST['email']);
            $sql = 'SELECT email FROM `users` WHERE `email` ="' . $safemail . '"';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                print"użytkownik już istnieje";
                return false;
            } elseif (!$result) {
                print "błąd " . $conn->errno;
                return false;
            } else {
                $user = new User;
                $user->setUsername($_POST['login']);
                $user->setEmail($_POST['email']);
                $user->setHashedPassword($_POST['password']);
                $user->saveToDB($conn);
            }
            $conn->close();
            $conn = null;
            print "użytkownik został utworzony przenosimy cię do strony logowania ";
            $page = "index.php";
            $sec = "4";
            header("Refresh: $sec; url=$page");
            return TRUE;
        } else {
            print "Wprowadź dane";
        }
    }
    