$(document).ready(function(){

    /*  For submitting forms, redirect to page    */
    $(document).on("submit", "form", function(){
        window.location = $(this).attr("action");
        return false;
    });
    /**********************************************/

    /*  Delete product when clicked    */
    $(document).on("click", ".btn_delete_product", function(){
        $(this).parent().parent().parent().remove();
        return false;
    });
    /**********************************************/
});