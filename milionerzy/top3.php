<?php
require_once "../connect.php";

function getTop3() {
    global $db_host,$db_user,$db_name,$db_pass;

    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception(mysqli_connect_error());
        $conn->set_charset('utf8');

        //create tables
        if (!$result = $conn->query("SELECT u.name, s.score 
                                  FROM users u
                                  JOIN scores s
                                  ON u.id=s.user_id
                                  ORDER BY s.score DESC
                                  LIMIT 3 ")) {
            throw new Exception("Drop scores");
        }
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            array_push($arr, json_encode($row));
        }
        return json_encode($arr);
    } catch (Exception $e) {
        return $e;
    }
}

print_r(getTop3());