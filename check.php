<?php
session_start();
    $answers = [];

    foreach($_REQUEST as $question => $answer) {
        $answers[substr($question,2)] = ["usersAnswer" => (int)$answer];
    }

    $_SESSION['answers'] = $answers;

    if (count($_REQUEST) < 60) {
        $_SESSION['message'] = "Zaznacz wszystkie odpowiedzi";
    } else {
        $_SESSION['message'] = null;
        $score = 0;
        foreach ($_SESSION['questions'] as $question) {
            $isCorrect = (int)$question['answer'] == $answers[$question['id']]["usersAnswer"];

            $answers[$question['id']]["isCorrect"] = $isCorrect;
            $score += $isCorrect ? 1 : 0;

        }
        $_SESSION['answers']    = $answers;
        $_SESSION['score']      = $score/60*100;
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);



