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

    /*  For going back from previous page    */
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
});