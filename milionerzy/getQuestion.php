<?php
session_start();
require_once "../connect.php";

$ustr = array('\u0104','\u0106','\u0118','\u0141','\u0143','\u00d3','\u015a','\u0179','\u017b','\u0105','\u0107','\u0119','\u0142','\u0144','\u00f3','\u015b','\u017a','\u017c');
$plstr = array('Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż','ą','ć','ę','ł','ń','ó','ś','ź','ż');

function getQuestions() {
    global $db_host, $db_user, $db_pass, $db_name, $ustr, $plstr;
    $_SESSION['questions'] = [];
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception("Brak dostępu do bazy");
        $conn->set_charset("utf8");
        $query = "SELECT q.id, q.text, q.answer, c.name FROM questions q
                      JOIN categories c
                      ON q.category_id = c.id";

        if (!$result = $conn->query($query)) {
            throw new Exception("Wrong query");
        }
        $conn->close();

        while ($row = $result->fetch_assoc()) {
            array_push($_SESSION['questions'], $row);
        }
        shuffle($_SESSION['questions']);
    } catch (Exception $e) {
        return $e;
    }
}

function toSend($question) {
    global $ustr, $plstr;


    $toSend = [
        'id'   => $question['id'],
        'name' => $question['name'],
        'text' => $question['text'],
    ];

    return str_replace($ustr, $plstr, json_encode($toSend));
}

function letsPlay() {
    if (!isset($_SESSION['questions']) || count($_SESSION['questions']) < 140) {
        getQuestions();
        $_SESSION['qnr'] = 0;
    } else if (isset($_SESSION['last_correct']) && $_SESSION['last_correct'] == $_SESSION['qnr']) {
        $_SESSION['qnr'] = $_SESSION['qnr'] + 1;
    }
    if (isset($_SESSION['questions'][$_SESSION['qnr']])) {
        print_r(toSend($_SESSION['questions'][$_SESSION['qnr']]));
    } else {
        print_r(json_encode(["winner" => 1]));
    }
}

letsPlay();


