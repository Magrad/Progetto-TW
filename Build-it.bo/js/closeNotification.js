$(document).ready(function() {
    function refresh() {
        $.ajax({
            url: 'notifications.php',
            type: 'post',
            data: { },
            success: function(result) {
                $("#toast").html(result);
            }
        })
    }

    setInterval(function() {
        refresh()
    }, 1000); //1 seconds
})

function closeNotification(clicked_id) {
    console.log(clicked_id);
    let notification = document.getElementById("notification-" + clicked_id);

    

    notification.style.transform = "translateX(400px)";

    $.ajax({
        url: 'notifications.php',
        type: 'post',
        data: { clicked: clicked_id},
        success: function(result) {
            $("#toast").html(result);
        }
    })
}
