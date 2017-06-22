<?php
function endOfTime() {
    global $db_host, $db_user, $db_pass, $db_name;
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception("Brak dostępu do bazy");
        $conn->set_charset("utf8");
        $query = "INSERT INTO scores VALUES (NULL, " . $_SESSION['user'] . ", " . (2*$_SESSION['qnr']) .")";

        if (!$result = $conn->query($query)) {
            throw new Exception("Wrong query");
        }
        $conn->close();

    } catch (Exception $e) {
        echo $e;
    }
    $_SESSION = [];
}