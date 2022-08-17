var pageNum = 1;

$(document).ready(function(){

    getOrders(1)

    /*  When form is submitted */
    $('.form_admin_orders').submit(function(){
        getOrders(pageNum)
        return false;
    })
    /**********************************************/

    /* When select tag of status is changed */
    $(document).on('change', '.order_status', function(){
        $(this).submit()
        return false;
    })
    /**********************************************/
    
    /* When select tag of status is changed */
    $(document).on('submit', '.order_status', function(){
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
        })
        return false;
    })
    /**********************************************/

    /* When select tag of order is changed */
    $('.form_admin_orders select').change(function(){
        $('.form_admin_orders').submit()
    })
    /**********************************************/

    
    /*  Pagination at footer    */
    pageNumHighlight(pageNum);

    $(document).on("click", ".pagination > a:not(.next_page)", function(){
        pageNum = $(this).text();

        getOrders(pageNum)
        pageNumHighlight(pageNum);
        return false;
    });
    
    $(document).on("click", ".next_page", function(){
        pageNum++;
        getOrders(pageNum)
        pageNumHighlight(pageNum);
        return false;
    });
    /**********************************************/

});


function getOrders(page = 1){
    $.get("/orders/index_html?page=" + page + '&' + $('.form_admin_orders').serialize(), function(res){
        $('#root').html(res)
        pageNumHighlight(page);
    })
}

/*  For pagination highlight    */
function pageNumHighlight(pageNum){
    $(".pagination > a").css("background-color", "rgb(33,37,41)").css("color", "rgb(161, 161, 255)");
    for(var i = 1; i <= document.querySelectorAll(".pagination > a").length; i++){
        if(pageNum == $(".pagination > a:nth-child(" + i + ")").text()){
            $(".pagination > a:nth-child(" + i + ")").css("background-color", "rgb(162, 123, 92)").css("color", "white");
        }
    }
}
/**********************************************/