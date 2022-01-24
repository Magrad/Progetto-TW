$(document).ready(function() {
    let title = $(document).find("title").text();
    let txt = document.getElementById("search").value;

    $.ajax({
        url: 'search.php',
        type: 'post',
        data: {search: txt},
        success: function(result) {
            $("#result").html(result);
        }
    })

    $("#search").keyup(function() {
        $.ajax({
            url: 'search.php',
            type: 'post',
            data: {
                search: $(this).val(),
                title: title,
                text: $(this).val()},
            success: function(result) {
                $("#result").html(result);
            }
        })
    })

    $(".aside").click(function() {
        let out = this.textContent;
        $.ajax({
            url: 'search.php',
            type: 'post',
            data: {
                search: this.textContent,
                title: title,
                text: this.textContent},
            success: function(result) {
                $("#result").html(result);
                $("#search").val(out);
            }
        })
    })

    $("#search-btn").click(function() {
        let txt = document.getElementById("search").value;
        
        $.ajax({
            url: 'search.php',
            type: 'post',
            data: {
                search: txt,
                title: title,
                text: txt},
            success: function(result) {
                $("#result").html(result);
            }
        })
    })
})