$(function () {

    var counter;

    function loadRightBar() {
        var $over1 = $('.rightBar .over3-1');
        var $over2 = $('.rightBar .over3-2');
        var $below1 = $('.rightBar .below3-1');
        var $below2 = $('.rightBar .below3-2');
        var over31html = '';
        var over32html = '';
        var below31html = '';
        var below32html = '';
        // var html = '<div class="box box-60">Nie dojdziesz tu</div>';
        for (var i = 0; i < 5; i++) {
            over31html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>Nie dojdziesz tu</b></div>";
        }
        for (var i = 5; i < 12; i++) {
            over31html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>4.5</b></div>";
        }
        for (var i = 12; i < 15; i++) {
            over31html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>4</b></div>";
        }
        for (var i = 15; i < 17; i++) {
            over32html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>4</b></div>";
        }
        for (var i = 17; i < 22; i++) {
            over32html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>3.5</b></div>";
        }
        for (var i = 22; i < 30; i++) {
            over32html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>3</b></div>";
        }
        for (var i = 30; i < 40; i++) {
            below31html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>Cały czas nic</b></div>";
        }
        for (var i = 40; i < 45; i++) {
            below31html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>Nadal nic</b></div>";
        }
        for (var i = 45; i < 50; i++) {
            below32html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>Nadal nic</b></div>";
        }
        for (var i = 50; i < 59; i++) {
            below32html += "<div class='box box-" + (60-i) + "' id='" + (60-i) + "'>" + (60-i) + ". <b>Nic</b></div>";
        }
        below32html += "<div class='box box-1' id='1'>1. <b>Nic</b></div>";

        $over1.html(over31html);
        $over2.html(over32html);
        $below1.html(below31html);
        $below2.html(below32html);
    }

    function getQuestion() {
        $.ajax({
            type    : "GET",
            url     : './getQuestion.php',
            success : function(data) {
                appendQuestion(JSON.parse(data));
                $('.loader').hide();
            }
        });
    }

    function appendQuestion(question) {
        var $box = $('.question .question-inside');
        var html = '';


        html+= "<label class='text-center'><b>" + question.id + ". " + question.name +  "</b></label>"
            + " " + question.text
            + "<div class='answers text-center'>"
            +      "<label class='radio-inline'>"
            +           "<input type='radio' name='q-" + question.id + "' id='q-" + question.id + "' value=1>TAK"
            +      "</label>"
            +      "<label class='radio-inline'>"
            +           "<input type='radio' name='q-" + question.id + "' id='q-" + question.id + "' value=0>NIE"
            +      "</label>"
            + "</div>";

        $box.html(html);
    }

    function sendAnswer() {
        manageInterval(false);
        var answer;
        if ($('input:radio:checked')[0] != null) {
            answer = $('input:radio:checked')[0].value;
            $.ajax({
                type    : "POST",
                url     : './check.php',
                data: { answer : answer },
                success : function(data) {
                    nextOrLose(data);
                }
            });
        } else {
            endOfTime();
        }
    }

    function nextOrLose(data) {
        if (JSON.parse(data).winner != null) {
            alert("Nie wiem czy oszukiwałeś czy ostatnie 4 miesiące spędziełeś w piwnicy, ale rozwaliłeś wszystkie pytania. Możesz się zabrać za WRP^^");
        }
        if (JSON.parse(data).correct === 1) {
            nextQuestion();
        } else {
            theEnd();
        }
    }

    function theEnd() {
        window.location.replace("./theend.html");
    }

    function start() {
        nextQuestion();
    }

    function nextQuestion() {
        getQuestion();
        var $active = $('.rightBar .active');
        if ($active.length <= 0) {
            $('.rightBar #1').addClass('active');
        } else {
            $active.addClass('done').removeClass('active');
            var activeNr = $active.attr('id');
            $('.rightBar #'+(parseInt(activeNr)+1)).addClass('active');
        }
        manageInterval(true);
    }

    function manageInterval(flag) {
        if (flag) {
            var timeLeft = 30;
            counter = setInterval(function () {
                timeLeft = timeLeft - 1;
                $('.time').html(timeLeft);
                if (timeLeft <= 0) {
                    clearInterval(counter);
                    endOfTime();
                    console.log("koniec");
                    return;
                }
            }, 1000);
        } else {
            clearInterval(counter);
        }
    }

    function endOfTime() {
        $.ajax({
            type    : "POST",
            url     : './endOfTime.php',
            success : function() {
                theEnd();
            }
        })
    }

    function loadTop3() {
        $.ajax({
            type    : "GET",
            url     : './top3.php',
            success : function(data) {
                appendTop3(data);
            }
        })
    }

    function appendTop3(data) {
        data = JSON.parse(data);
        var $top3Box = $('.top3 .row');
        for (var i = 0; i < 3; i++) {
            var tp = $top3Box.find('.top3-'+(i+1) + ' .who');
            var top = JSON.parse(data[i]);
            tp.html(top.name + " - " + top.score);

            console.log(top);
        }
    }

    loadTop3();
    loadRightBar();
    start();
    $('#send').click(function () {
        sendAnswer();
    })

});