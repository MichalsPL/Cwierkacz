<?php

    include_once 'Connect.php';

/// strona wyświetla panel do zmiany preferencji użytkownika pozwala na ich edycje
    function showPreferences() {
        if (
                isset($_POST['preferences']) || isset($_POST['DelUser']) ||
                isset($_POST['ChangePassword']) || isset($_POST['NewPassword']) ||
                isset($_POST['newUserName']) || isset($_POST['ChangeUserName']) ||
                isset($_POST['logout'])
        ) {
            print' <div class="form">';
            print "<h1>USTAWIENIA</H1>";

            //////////////////////////////////////////////zmiana nazwy
            if (!isset($_POST['ChangeUserName'])) {
                print '   <form method="POST"><button type="submit" name="ChangeUserName" action="#" >
                Zmień nazwę użytkowinika</button></form>';
            }

            if (isset($_POST['ChangeUserName'])) {
                print'<form class="register-form" style="display: block" method="POST">
                    <input type="text" name="newUserName" placeholder="Podaj nową nazwę użytkownika"/>
                    <button type="submit">zmień nazwę użytkownika</button>
                    </form>';
            }

            if (isset($_POST['newUserName']) && $_POST['newUserName'] != '') {
                $conn = getDbConnection();
                $safeNewUserName = $conn->real_escape_string($_POST['newUserName']);
                $sql = 'UPDATE `users` SET `username` = "' . $safeNewUserName .
                        '" WHERE `users`.`id` = ' . ($_SESSION['userId']);
                $result = $conn->query($sql);

                if ($result) {
                    Print "nazwa zmieniona";
                } else {
                    print "wystąpił błąd" . $conn->error;
                }
            }

            /////////////////////////////////////////////////////////////////////zmieniamy hasło użytkownika  
            if (!isset($_POST['ChangePassword'])) {
                Print
                        '<form method="POST">
                <button type="submit" name="ChangePassword" action="#" >Zmień Hasło
                </button></form>';
            }

            if (isset($_POST['ChangePassword'])) {
                Print'
                <form class="register-form" style="display: block" method="POST">
                <input type="text" name="NewPassword" placeholder="Podaj nowe Hasło"/>
                <button type="submit">Zmień hasło</button>
                </form>';
            }

            if (isset($_POST['NewPassword']) && $_POST['NewPassword'] != '') {
                include_once 'src/User.php';
                $user = new User;
                $conn = getDbConnection();
                $sql = 'UPDATE `users` SET `hashedPassword` = "' . ($user->setHashedPassword($_POST['NewPassword'])) .
                        '" WHERE `id` = ' . ($_SESSION['userId']);
                $result = $conn->query($sql);

                if ($result) {
                    Print "hasło  zmienione ";
                } else {
                    print $conn->error;
                }
            }

            //////////////////////USUWANIE UŻYTKOWNIKA
            if (!isset($_POST['DelUser'])) {
                print
                        '<form method="POST">
                    <button type="submit" name="DelUser" action="#">USUŃ UŻYTKOWNIKA
                    </button>
                </form>';
            }
            if (isset($_POST['DelUser'])) {
                $conn = getDbConnection();
                $sql = 'DELETE FROM `users` WHERE `email` ="' . ($_SESSION['userInputMail']) . '"';
                $result = $conn->query($sql);
                if ($result) {
                    session_destroy();
                    unset($_POST);
                    $page = $_SERVER['PHP_SELF'];
                    $sec = "1";
                    header("Refresh: $sec; url=$page");
                } else {
                    print
                            '<p class="message" style="font-size: 16px; color:red">
                    Nie udało się usunąć użytkowinka</p>';
                }
            }
            print'</div>';

            ////////////////////////Wylogowyanie
            if (isset($_POST['logout'])) {
                session_destroy();
                $page = "index.php";
                $sec = "1";
                header("Refresh: $sec; url=$page");
            }
        }
    }
    