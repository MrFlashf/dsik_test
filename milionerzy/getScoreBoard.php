<?php
require_once "../connect.php";

$ustr = array('\u0104','\u0106','\u0118','\u0141','\u0143','\u00d3','\u015a','\u0179','\u017b','\u0105','\u0107','\u0119','\u0142','\u0144','\u00f3','\u015b','\u017a','\u017c');
$plstr = array('Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż','ą','ć','ę','ł','ń','ó','ś','ź','ż');

function getScoreBoard() {
    global $db_host, $db_user, $db_pass, $db_name, $ustr, $plstr;
    try {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno)
            throw new Exception("Brak dostępu do bazy");
        $conn->set_charset("utf8");
        $query = "SELECT s.score, u.name FROM scores s
                    JOIN users u
                    ON s.user_id = u.id
                    WHERE s.score > 30
                    ORDER BY s.score DESC 
                    ";
        if (!$result = $conn->query($query)) {
            throw new Exception("Wrong query");
        }
        $conn->close();

        $toReturn = [];

        while ($row = $result->fetch_assoc()) {
            array_push($toReturn, str_replace($ustr, $plstr, json_encode($row)));
        }

        return str_replace($ustr, $plstr, json_encode($toReturn));
    } catch (Exception $e) {
        return $e;
    }
}

print_r(getScoreBoard());
//print_r(["kupa"]);

