/*  For pagination highlight    */
function pageNumHighlight(pageNum){
    $(".pagination > a").css("background-color", "rgb(33,37,41)").css("color", "rgb(161, 161, 255)");
    for(var i = 0; i < document.querySelectorAll(".pagination > a").length; i++){
        if(pageNum == $(".pagination > a:nth-child(" + i + ")").text()){
            $(".pagination > a:nth-child(" + i + ")").css("background-color", "rgb(162, 123, 92)").css("color", "white");
        }
    }
}
/**********************************************/

$(document).ready(function(){

    /*  For submission of forms & updating of cart quantity    */
    var cart_quantity = 4;
    $(".cart_quantity").text(cart_quantity);
    
    $(document).on("submit", "form", function(){
        $(".item_added_confirm").show().fadeOut(3000);
        pageNumHighlight(pageNum);

        cart_quantity += parseInt($(".new_order_qty").val().split(" ")[0]);
        $(".cart_quantity").text(cart_quantity);
        
        return false;
    });
    /**********************************************/

    /*  Pagination at footer    */
    var pageNum = 1;
    pageNumHighlight(pageNum);

    $(document).on("click", ".pagination > a:not(.next_page)", function(){
        pageNum = $(this).text();
        pageNumHighlight(pageNum);
        return false;
    });
    $(document).on("click", ".next_page", function(){
        pageNum++;
        pageNumHighlight(pageNum);
        return false;
    });
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