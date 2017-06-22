$(function() {
   function getScores() {
       $.ajax({
           type    : "GET",
           url     : './getScoreBoard.php',
           success : function(data) {
               appendScoreBoard(JSON.parse(data));
           }
       });
   }

   function appendScoreBoard(data) {
        console.log(data);
        var $box = $('.scoreBoard .scoreBoard-inner');
        var html = "<table class='table'><thead>"
                 + "<tr>"
                 + "<th>Position</th>"
                 + "<th>Username</th>"
                 + "<th>Score</th>"
                 + "</tr></thead><tbody>";
        for (var i = 0; i < data.length; i++) {
            var datai = JSON.parse(data[i]);
            html += "<tr>"
                 + "<td><b>" + (i+1) + "</b></td>"
                 + "<td>" + datai.name + "</td>"
                 + "<td>" + datai.score + "</td>"
                 + "</tr>";
        }
        html += "</tbody></table>";
        $box.html(html);
   }

   getScores();
});