<?php
session_start();
require_once "../connect.php";
function check() {
//    print_r($_SESSION['questions'][$_SESSION['qnr']]);
//    print_r($_REQUEST);

    $curQuestion = $_SESSION['questions'][$_SESSION['qnr']];
    $usersAnswer = $_REQUEST['answer'];

    if ((int)$usersAnswer == (int)$curQuestion['answer']) {
        $_SESSION['last_correct'] = $_SESSION['qnr'];
        $arr = ['correct' => 1];
        return json_encode($arr);
    } else {
        theEnd();
        $arr = [
            'correct' => 0
        ];
        return json_encode($arr);
    }


}

function theEnd() {
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

print_r(check());