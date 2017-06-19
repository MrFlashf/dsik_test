<?php
session_start();
//require_once "./getQuestions.php";
//$data = getQuestions();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>SIK egzamin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
    <script src="./scripts/normal.js"></script>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container-fluid">

        <div class="header text-center">
            <h2>Powtórka z SIK</h2>
            <h4>Sprawdź się przed piątkowym egzaminem</h4>
        </div>

        <div class="data-container"></div>

        <?php
//        if (isset($_SESSION['score'])) {
//            $score = $_SESSION['score'];
//        }
//
//        $html  = "<div class='header text-center ";
//        $html .= isset($score)
//            ? $score > 50 ? "success" : "total-fail"
//            : "";
//        $html .= "'>";
//        $html .= isset($score)
//            ? $score > 50
//                ? "<h2>Twój wynik to " . $_SESSION['score'] . "%</h2><h4>Kujon</h4>"
//                : "<h2>Twój wynik to " . $_SESSION['score'] . "%</h2><h4>To mówiłeś coś o wakacjach we wrześniu?</h4>"
//            : "<h2>Powtórka z SIK</h2><h4>Sprawdź się przed piątkowym egzaminem</h4>";
//        $html .= "</div>";
//        echo $html;
//        ?>

<?php //if(isset($_SESSION['message'])) { ?>
<!--            <div class="alert alert-danger">--><?php //echo $_SESSION['message']; ?><!--</div>-->
<?php //} ?>
<!---->
<?php
        //                $html = '';
//                $i = 0;
//                foreach($data as $question) {
//                    $html .= $i % 3 == 0 ? "<div class='row'>" : "";
//                    $html .= "<div class='question col-md-4 question-" . $i % 3 . " ";
//                    if (isset($_SESSION['score'])) {
//                        if ($_SESSION['answers'][$question['id']]['isCorrect']) {
//                            $html .=  "correct";
//                        } else {
//                            $html .=  "wrong";
//                        }
//                    }
//                    $html .= "'><div class='question-inside'>"
//                        . "<label class='text-center'><b>" . ($question['id']) . ". " . $question['name'] . "</b></label> "
//                        . $question['text']
//                        . "<div class='answers text-center'>"
//                        . "   <label class='radio-inline'>"
//                        . "       <input type='radio' name='q-" . $question['id'] . "' id='q-" . $question['id'] . "' value=1 ";
//                            if (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']]['usersAnswer'] == 1) { $html .= "checked"; }
//                    $html .= "> TAK"
//                        . "   </label>"
//                        . "   <label class='radio-inline'>"
//                        . "       <input type='radio' name='q-" . $question['id'] . "' id='q-" . $question['id'] . "' value=0 ";
//                            if (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']]['usersAnswer'] == 0) { $html .= "checked"; }
//
//                    $html .= "> NIE"
//                        . "   </label>"
//                        . "</div></div></div>";
//                    if ($i % 3 == 2) { $html .= "</div>"; }
//                    $i++;
//                }
//
////                $html .= isset($score)
////                    ? "<button id='restart'>Ale frajda! Chcę jeszcze raz!</button>"
////                    : "<button type='submit'>Sprawdź wynik!</button>";
//
//                echo $html;
//                ?>
    <button class="btn-default sendAnswers">Sprawdź!</button>

    </div>
</body>

</html>
