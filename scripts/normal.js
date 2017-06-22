$(function() {

    var questions;



    $.ajax({
        type    : "GET",
        url     : './getQuestions.php',
        success : function(data) {
            appendQuestions(JSON.parse(data));
            $('.loader').hide();
        }
    });

    function appendQuestions(data) {
        questions = data;
        var html = '';
        for(var i = 0; i < data.length; i++) {
            var question = JSON.parse(data[i]);
            html += i % 3 === 0 ? "<div class='row'>" : "";
            html += "<div class='question col-md-4 question-" + question.id + "'>";
            html += "<div class='question-inside'>"
                 + "<label class='text-center'><b>" + question.id + ". " + question.name +  "</b></label>"
                 + " " + question.text
                 + "<div class='answers text-center'>"
                 +      "<label class='radio-inline'>"
                 +           "<input type='radio' name='q-" + question.id + "' id='q-" + question.id + "' value=1>TAK"
                 +      "</label>"
                 +      "<label class='radio-inline'>"
                 +           "<input type='radio' name='q-" + question.id + "' id='q-" + question.id + "' value=0>NIE"
                 +      "</label>"
                 + "</div></div></div>";
            html += i % 3 === 2 ? "</div>" : "";
        }
        $('.data-container').html(html);

    }


    function sendAnswers() {
        var questionsAndAnswers = {};
        var checked = $('input:radio:checked');
        for (var i = 0; i < checked.length; i++) {
            var checkbox = checked[i];
            var key = checkbox.id.substr(2);
            questionsAndAnswers[key.toString()] = checkbox.value;
        }

        $.ajax({
            type: "POST",
            url : './check.php',
            data: questionsAndAnswers,
            success: function (data) {
                showAnswers(questionsAndAnswers, data);
            }
        });
    }

    function showAnswers(myAnswers, data) {
        var answers     = JSON.parse(data);
        var score = 0;
        for (var i = 0; i < questions.length; i++) {
            var question    = JSON.parse(questions[i]);
            var id = question.id;
            var correctAnswer = answers[id];
            var $questionDOM = $(".question-"+id + " .question-inside");
            var clas = 'wrong';
            if (parseInt(correctAnswer)) {
                clas = "correct";
                score++;
            }
            $questionDOM.addClass(clas);
        }
        score = (score / (questions.length)) * 100;
        var $header = $('.header.text-center');
        var $h2 = $header.find('h2');
        var $h4 = $header.find('h4');

        var h4Message = score > 50 ? "I tak nie zdasz WRP" : "To mówiłeś coś o wakacjach we wrześniu?";

        $h2.html(score + "%");
        $h4.html(h4Message);

        $('html, body').animate({scrollTop:0}, 'slow');

        getPrompts();

    }

    function getPrompts() {
        $.ajax({
            type: "GET",
            url : './prompts.php',
            success: function (data) {
                appendPrompts(data);
            }
        });
    }

    function appendPrompts(data) {
        data = JSON.parse(data);
        for (var i = 0; i<data.length;i++) {
            var prompt = JSON.parse(data[i]);
            var $pl = $('.question-'+prompt.question_id+' .question-inside');
            console.log(prompt.question_id);
            $pl.after("<div class='prompt-sign'>?</div>");
            $pl.after("<div class='prompt'>"+prompt.text+"</div>");
            console.log(JSON.parse(data[i]));
        }
        assignHovers();

    }

    function assignHovers() {
        $('.prompt-sign').mouseenter(
            function() {
                $(this).parent().find('.prompt').show();
            }
        ).mouseleave(
            function() {
                $(this).parent().find('.prompt').hide();
            }
        )
    }

    $('.sendAnswers').click(function () {
        sendAnswers();
    })



});