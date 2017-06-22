<?php
session_start();
require_once "../connect.php";


function addUser() {
    global $db_host,$db_user,$db_name,$db_pass;
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');

        $name = $_POST['name'];
        $name1 = $conn->real_escape_string($name);

        if ($name != $name1) {
            throw new Exception("Cfaniaczek");
        }

        $query = "INSERT INTO users VALUES (NULL, '$name')";

        if (!$conn->query($query))
            throw new Exception("Wrong query " . $query);

        $_SESSION['user'] = $conn->insert_id;
        $conn->close();
        header("Location: ./game.html");
    } catch(Exception $e) {
        echo $e;
    }

}

addUser();