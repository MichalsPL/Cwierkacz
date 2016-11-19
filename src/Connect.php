<?php

function getDbConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "coderslab";
    $baseName = "twitter";
    
    $conn = new mysqli ($servername,
            $username,
            $password,
            $baseName        
    );
    
    if ($conn->connect_error) {
        die("Nieudane połączenie, błąd $conn->error, numer błędu $conn->errno ");
    }
    
    $setEncodingSql = "SET CHARSET utf8";
    $conn->query($setEncodingSql);
    
    return $conn;
}

function closeConnection($conn){
    if(isset($conn)){
    
    $conn=null;
    }
}
