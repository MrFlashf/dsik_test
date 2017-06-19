$(function() {
    $.ajax({
        type    : "GET",
        url     : './getQuestions.php',
        success : function(data) {
            appendQuestions(JSON.parse(data))
        }
    });

    function appendQuestions(data) {
        console.log(data);

        var html = '';
        for(var i = 0; i < data.length; i++) {
            var question = JSON.parse(data[i]);
            html += i % 3 === 0 ? "<div class='row'>" : "";
            html += "<div class='question col-md-4'>";
            html += "<div class='question-inside'>"
                 + "<label class='text-center'><b>" + question.id + ". " + question.name +  "</b></label>"
                 + question.text
                 + "<div class='answers text-center'>"
                 +      "<label class='radio-inline'>"
                 +           "<input type='radio' name='q-" + question.id + "'value=1>TAK"
                 +      "</label>"
                 +      "<label class='radio-inline'>"
                 +           "<input type='radio' name='q-" + question.id + "'value=1>NIE"
                 +      "</label>"
                 + "</div></div></div>";
            html += i % 3 === 2 ? "</div>" : "";
        }
        $('.data-container').html(html);


    }


    function sendAnswers() {
        var questionsAndAnswers = {};
        var checked = $('input:radio:checked');
        console.log(checked);
        for (var i = 0; i < checked.length; i++) {
            var checkbox = checked[i];
            var key = checkbox.id.substr(2);
            // questionsAndAnswers.key = checkbox.value;
            questionsAndAnswers[key.toString()] = checkbox.value;
        }
        // questionsAndAnswers = questionsAndAnswers.filter(Boolean);

        console.log(questionsAndAnswers);
        $.ajax({
            type: "POST",
            url : './test.php',
            data: questionsAndAnswers,
            success: function (data) {
                console.log(data)
            }
        });
    }

    $('.sendAnswers').click(function () {
        sendAnswers();
    })

})