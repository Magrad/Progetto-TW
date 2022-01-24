$(document).ready(function() {
    let title = $('title').text();
    let quantity = $(this).closest(".product").find('.qty-input').val();
    let id = $(this).closest(".product").find('.product-id').val();
    let data = {
        'quantity': quantity,
        'product_id': id,
        'title': title,
    };
    $.ajax({
        url: 'order-total.php',
        type: 'post',
        data: data,
        success: function(result) {
            $("#cart").html(result);
        }
    })

    $(".qty-input").click(function() {
        let title = $('title').text();
        let quantity = $(this).closest(".product").find('.qty-input').val();
        let id = $(this).closest(".product").find('.product-id').val();
        var data = {
            'quantity': quantity,
            'product_id': id,
            'title': title,
        };

        $.ajax({
            url: 'order-total.php',
            type: 'post',
            data: data,
            success: function(result) {
                $("#cart").html(result);
            }
        })
    })
})