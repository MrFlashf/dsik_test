$(function () {


    function restart() {
        console.log("ekr");
        $.ajax({
            url: "./restart.php",
            success: function () {
                location.reload();
            }
        })
    }

    $('#restart').on('click', function() {
        restart()
    });

})

