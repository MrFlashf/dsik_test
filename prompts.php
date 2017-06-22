<?php
session_start();
require_once "connect.php";
function getPrompts() {
    global $db_host, $db_user, $db_pass, $db_name;
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception("Brak dostępu do bazy");
        $conn->set_charset("utf8");
        $query = "SELECT question_id, text FROM explanations WHERE question_id in (";
        foreach ($_SESSION['questions'] as $question) {
            $q = json_decode($question);
            $query .= $q->id . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";

        if (!$result = $conn->query($query)) {
            throw new Exception("Wrong query");
        }
        $conn->close();

        $ustr = array('\u0104','\u0106','\u0118','\u0141','\u0143','\u00d3','\u015a','\u0179','\u017b','\u0105','\u0107','\u0119','\u0142','\u0144','\u00f3','\u015b','\u017a','\u017c');
        $plstr = array('Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż','ą','ć','ę','ł','ń','ó','ś','ź','ż');
        $toReturn = [];
        while ($row = $result->fetch_assoc()) {
            array_push($toReturn, str_replace($ustr, $plstr, json_encode($row)));
        }

        return str_replace($ustr, $plstr, json_encode($toReturn));

    } catch (Exception $e) {
        return $e;
    }
}

print_r(getPrompts());