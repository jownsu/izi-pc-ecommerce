var category_id = '';
var pageNum = 1;

$(document).ready(function(){

    /* Retrieving all the products when the page first loads */
    getProducts(1)

    /*  Product categories selection */
    $(document).on("click", ".products_categories > a", function(){
        category_id = $(this).attr('data-id')
        categoryName = $(this).text().split(" (")[0];
        $(".category_name").text(categoryName);

        getProducts(1, category_id)
        pageNumHighlight(1);
        $(".page_number").text(1);
        return false;
    });
    /**********************************************/

    /*  Pagination at footer */
    $(".page_number").text(pageNum);
    pageNumHighlight(pageNum);

    $(document).on("click", ".pagination a", function(){

        pageNum = $(this).text();
        getProducts(pageNum, category_id)

        $(".page_number").text(pageNum);
        return false;
    });
    $(document).on("click", ".next_page", function(){
        if((pageNum + 1) >= document.querySelectorAll(".pagination > a").length + 1){
            return false
        }
        pageNum++;

        $(".page_number").text(pageNum);
        getProducts(pageNum, category_id)

        pageNumHighlight(pageNum);
        return false;
    });
    /**********************************************/

    /*  Pagination at catalog header */
    $(document).on("click", ".first_page", function(){
        pageNum = 1;
        $(".page_number").text(pageNum);
        getProducts(pageNum, category_id)

        pageNumHighlight(pageNum);
        return false;
    });
    $(document).on("click", ".prev_page", function(){
        if(pageNum > 1){
            pageNum--;
        }
        $(".page_number").text(pageNum);
        getProducts(pageNum, category_id)

        pageNumHighlight(pageNum);
        return false;
    });
    /**********************************************/

    /*  For submission of forms    */
    $(document).on("submit", "#search_form", function(){
        pageNum = 1
        getProducts(pageNum, category_id)
        $(".page_number").text(pageNum);

        return false;
    });
    /**********************************************/

    $('#select_order').change(function(){
        $('#search_form').submit()
    })
});


/*  For pagination highlight    */
function pageNumHighlight(pageNum){
    $(".pagination > a").css("background-color", "rgb(33,37,41)").css("color", "rgb(161, 161, 255)");
    for(var i = 1; i <= document.querySelectorAll(".pagination > a").length; i++){
        if(pageNum == $(".pagination > a:nth-child(" + i + ")").text()){
            $(".pagination > a:nth-child(" + i + ")").css("background-color", "rgb(162, 123, 92)").css("color", "white");
        }
    }
}

/* Request for the products, 
    render the list on html 
    and hightlight the page number on pagination.
*/
function getProducts(page = 1, category = ''){
    $.get("products/index_html?page=" + page + '&category=' + category + '&' + $('#search_form').serialize() + '&' + $('#order_form').serialize(), function(res){
        $('.products_container').html(res)
        pageNumHighlight(page);
    })
}
/**********************************************/