$(document).ready(function(){

    /* For total price when quantity changes */

    var price = $('.cart_price .price').text()

    $('.cart_quantity').change(function(){
        if($(this).val() < 1 || isNaN($(this).val())){
            $(this).val(1)
        }
        $('.cart_price .price').text(price * $(this).val())
    })
    /**********************************************/

    /*  For going back from previous page */
    $(document).on("click", ".go_back", function(){
        history.back();
        return false;
    });
    /**********************************************/

    /*  For changing the big image    */
    $(".default_main_img").css("outline", "1px solid rgb(162, 123, 92)");
    $(document).on("mouseover", ".sub_img", function(){
        $(".sub_img").css("outline", "none");
        $(".main_img").attr("src", $(this).attr("src"));
        $(this).css("outline", "1px solid rgb(162, 123, 92)");
    });
    /**********************************************/

    /* for submitting the add to cart form */
    $('form').submit(function(){
        $.post($(this).attr('action'), $(this).serialize(), function(res){
            $('.csrf').val(res.csrf['hash'])
            $('.csrf').attr('name', res.csrf['name'])
            $.toast({
                heading: res.is_success ? 'Success' : 'Error',
                text: res.message,
                icon: res.is_success ? 'success' : 'error',
                showHideTransition: 'slide',
                position: 'top-right',
                hideAfter: 5000, 
            })
            if(res.add_count === true){
                $('.cart_count').html(parseInt($('.cart_count').html(), 10)+1)
            }
        })

        $('.cart_quantity').val(1)
        $('.cart_price .price').text(price)
        return false
    })
    /**********************************************/
});