/*Ajax query for add products in cart*/
$(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
                alert('Добавлено в корзину.');

            });
            return false;
        });
    });

