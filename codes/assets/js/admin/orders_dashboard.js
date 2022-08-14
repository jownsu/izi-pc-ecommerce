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

    /*  Submitting of forms will redirect to specified page based on action attribute    */
    $(document).on("submit", "form", function(){
        window.location = $(this).attr("action");
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

});