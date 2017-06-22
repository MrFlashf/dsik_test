<?php
session_start();

function check() {
    $results = [];

    foreach (($_SESSION['questions']) as $question) {
        $q = json_decode($question);
        if (isset($_REQUEST[$q->id]) && (int)$_REQUEST[$q->id] == (int)$q->answer) {
            $results[$q->id] = 1;
        } else {
            $results[$q->id] = 0;
        }
    }
    return json_encode($results);
}

print_r(check());

