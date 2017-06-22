<?php
require_once "../connect.php";

function createTables() {
    global $db_host,$db_user,$db_name,$db_pass;

    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');

        //create tables
        if (!$conn->query("DROP TABLE IF EXISTS scores")) {
            throw new Exception("Drop scores");
        }
        if (!$conn->query("DROP TABLE IF EXISTS users")) {
            throw new Exception("Drop users");
        }
        if (!$conn->query("CREATE TABLE users (
                                  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  name VARCHAR(20))")) {
            throw new Exception("create users");
        }

        if (!$conn->query("CREATE TABLE scores (
                                  id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  user_id int(3) UNSIGNED,
                                  score FLOAT(4,2),
                                  FOREIGN KEY (user_id) REFERENCES users(id))")) {
            throw new Exception("create scores");
        }

        //fill users & top3
        if (!$conn->query("INSERT INTO users VALUES
                                  (NULL, 'noname1'),
                                  (NULL, 'noname2'),
                                  (NULL, 'noname3')
                                  ")) {
            throw new Exception("fill users");
        }
        if (!$conn->query("INSERT INTO scores VALUES
                                  (NULL, 1, 0),
                                  (NULL, 2, 0),
                                  (NULL, 3, 0)
                                  ")) {
            throw new Exception("fill scores");
        }


    } catch (Exception $e) {
        echo $e;
    }
}

createTables();