<?php
session_start();
function getQuestions() {
    global $db_host, $db_user, $db_pass, $db_name;
    $_SESSION['questions'] = [];
        require_once "./connect.php";
        try {
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
            if ($conn->connect_errno)
                throw new Exception("Brak dostępu do bazy");
            $conn->set_charset("utf8");
            $query = "SELECT q.id, q.text, q.answer, c.name FROM questions q
                      JOIN categories c
                      ON q.category_id = c.id
                      ORDER BY RAND() LIMIT 60";

            if (!$result = $conn->query($query)) {
                throw new Exception("Wrong query");
            }
            $conn->close();
            $toReturn = [];
            $ustr = array('\u0104','\u0106','\u0118','\u0141','\u0143','\u00d3','\u015a','\u0179','\u017b','\u0105','\u0107','\u0119','\u0142','\u0144','\u00f3','\u015b','\u017a','\u017c');
            $plstr = array('Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż','ą','ć','ę','ł','ń','ó','ś','ź','ż');
            while ($row = $result->fetch_assoc()) {
                $arr = [
                    'id'    => $row['id'],
                    'text'  => $row['text'],
                    'name'  => $row['name'],
                ];
                array_push($toReturn, str_replace($ustr, $plstr, json_encode($arr)));
                array_push($_SESSION['questions'], str_replace($ustr, $plstr, json_encode($row)));
            }
            return (str_replace($ustr, $plstr, json_encode($toReturn)));
        } catch (Exception $e) {
            return $e;
        }
}
print_r(getQuestions());

