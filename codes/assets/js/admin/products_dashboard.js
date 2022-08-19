var pageNum = 1;

$(document).ready(function(){
    $.get('/categories/index_html', function(res){
        $(".product_categories").html(res)
        resetCategoryDisplay()
    })

    /* Retrieving all the products when the page first loads */
    getProducts(1)

    hideDialogBox();

    /* Getting the products */
        $('.form_admin_products_search').submit(function(){
            pageNum = 1
            getProducts(pageNum)
            return false;
        })
    /**********************************************/

    /*  Pagination at footer    */
    var pageNum = 1;
    pageNumHighlight(pageNum);

    $(document).on("click", ".pagination > a:not(.next_page)", function(){
        pageNum = $(this).text();
        getProducts(pageNum);
        pageNumHighlight(pageNum);
        return false;
    });
    $(document).on("click", ".next_page", function(){
        pageNum++;
        pageNumHighlight(pageNum);
        return false;
    });

    /*  Open add new product dialog box    */
    $(document).on("click", ".btn_add_product", function(){
        $(".add_edit_product_header").text("Add a new product");
        $(".input_product_name").val("");
        $(".input_product_desc").val("");
        $(".dummy_select_tag span:first-child").text("");
        $(".input_product_price").val("");
        $(".input_product_qty").val("");
        $(".img_upload_container").html("");
        $(".btn_submit_products_add_edit").val("Add");
        $(".btn_submit_products_add_edit").removeClass("edit_product_submit");
        $(".btn_submit_products_add_edit").addClass("add_product_submit");
        $(".modal_bg").show();
        $("dialog.admin_products_add_edit").show();
    });
    /**********************************************/

    /*  Clicking add button will submit the form using ajax    */
    $(document).on("click", ".add_product_submit", function(){
        hideDialogBox();
    });
    /********************************************************************/

    /*  Open delete product dialog box    */
    $(document).on("click", ".product_delete_link", function(){
        var productID = $(this).attr('data-id');
        var productName = $(this).parent().siblings(".product_id + td").text();
        
        $(".admin_product_delete .product_id").val(productID);
        $(".delete_product_id").text(productID);
        $(".delete_product_name").text(productName);

        $(".modal_bg_delete_product").show();
        $(".admin_product_delete").show();
        return false
    });

    $(document).on("click", ".admin_product_delete > div > button, .modal_bg_delete_product", function(){
        $(".admin_product_delete").hide();
        $(".modal_bg_delete_product").hide();
    });

    // submit delete form using the general ajax. Not this!
    $(document).on("click", ".admin_product_delete input[type=submit]", function(){
        $(".product_id_" + $(this).siblings().val()).remove();
        // $(this).parent().submit(function(){ return false; });
        $(".admin_product_delete").hide();
        $(".modal_bg_delete_product").hide();
    });
    /**********************************************/

    /*  Open edit product dialog box    */
        $(document).on("click", ".product_edit_link", function(){
        var productID = $(this).attr('data-id');
        getProduct(productID);

        
        $(".img_upload_container").html("");
        $(".add_edit_product_header").text("Edit Product - ID " + productID);
        $(".products_add_edit_btn .product_id").val(productID);
        $(".btn_submit_products_add_edit").val("Update");
        $(".btn_submit_products_add_edit").removeClass("add_product_submit");
        $(".btn_submit_products_add_edit").addClass("edit_product_submit");
        $(".modal_bg").show();
        $("dialog.admin_products_add_edit").show();
        return false;
    });
    /**********************************************/

    /*  Clicking add button will submit the form using ajax    */
    $(document).on("click", ".edit_product_submit", function(){
        hideDialogBox();
    });
    /**********************************************/

    /*  Show the options/categories for the dummy select tag    */
    $(document).on("click", ".dummy_select_tag", function(){
        $(this).css("border", "2px solid black");
        $(".product_categories").toggle();
    });
    /**********************************************/

    /*  Show the edit/delete buttons on hover.    */
    $(document)
    .on("mouseenter", ".product_category_edit_delete_section",  function(){
        $(this).children(".product_category_btn").css("visibility", "visible");
        $(this).children("form").children().css("cursor", "default").css("background-color", "#00aff8");
        $(this).css("cursor", "default").css("background-color", "#00aff8");
        if($(this).children("form").children("input[type=text]").attr("readonly") == null){
            $(this).children("form").children("input[type=text]").css("cursor", "text");
        }
    })
    .on("mouseleave", ".product_category_edit_delete_section",  function(){
        $(this).children(".product_category_btn").css("visibility", "hidden");
        $(this).children("form").children().css("background-color", "white");
        $(this).css("background-color", "white");
    });
    /**********************************************/

    /*  Assign the value of selected option to the dummy select tag    */
    $(document).on("click", ".form_product_category_edit", function(){
        if($(this).children(".product_category_text_input").attr("readonly") != null){
            $(".dummy_select_tag span:first-child").text($(this).children(".product_category_text_input").val());
            $('.category_id').val($(this).children(".product_category_id").val())
            resetCategoryDisplay();
        }
    });
    /**********************************************/

    /*  Edit the value of the specific category    */
    $(document).on("click", ".btn_product_category_edit", function(){
        $(".product_category_text_input").attr("readonly", true).css("outline", "none");
        $(this).parent().siblings("form").children(".product_category_text_input").attr("readonly", false).css("outline", "2.5px solid black").css("cursor", "text");
    });

    // This should be on ajax
    $(document).on("mouseleave keypress", ".product_category_text_input", function(){
        if($(this).attr("readonly") != "readonly"){
            // display waiting icon before sending
            $(this).parent().siblings(".product_category_btn").children(".waiting_icon").css("visibility", "visible");
  
            // hide waiting icon after receiving ang changing all data.
            setTimeout(function(){
                $(".waiting_icon").css("visibility", "hidden");
            }, 500);
        }
    });
    /**********************************************/
    
    /*  Show the delete category confirmation box to confirm delete    */
    $(document).on("click", ".btn_product_category_delete", function(){
        resetCategoryDisplay();

        var categoryName = $(this).parent().siblings("form").children(".product_category_text_input").val();
        var categoryID = $(this).parent().siblings("form").children(".product_category_id").val();

        $(".category_name").text(categoryName);
        $(".category_id").val(categoryID);

        $(".bg_category_confirm_delete").show();
    });

    $(document).on("click", ".category_confirm_delete > div > button, .bg_category_confirm_delete", function(){
        $(".bg_category_confirm_delete").hide();
    });

    // submit delete form using the general ajax. Not this!
    $(document).on("click", ".category_confirm_delete input[type=submit]", function(){
        $("." + $(this).siblings().val()).remove();
        // $(this).parent().submit(function(){ return false; });
        resetCategoryDisplay();
    });
    /**********************************************/

    /*  Stop propagation of clicks on dummy select tag and the confirm date box. And reset display when click outside of these elements    */
    $(document).on("click", ".select_tag_container, .category_confirm_delete", function(e){
        e.stopPropagation();
    });

    $(document).on("click", "html", function(){
        resetCategoryDisplay();
    });
    /**********************************************/

    /*  DOCU: This function read the uploaded image files.
        This codes used the FileReader from JavaScript.
        This will render the preview of uploaded images.
    */
    function readURL(input) {
        if(!input.files || !input.files[0]){
            return false;
        }
        else if($(".img_upload_section").length + input.files.length > 5){
            alert("Only four (5) images in total are allowed to be upload.");
            return false;
        }

        var reader = new FileReader();
        var onLoadCounter = 0;
        reader.addEventListener('load', function(e){
        // reader.onload = function (e) {
            var htmlStr = "" +
                '<li class="img_upload_section">' +
                    '<figure>' +
                        '<img src="' + e.target.result + '" alt="' + input.files[onLoadCounter].name + '" />' +
                    '</figure>' +
                    '<p class="img_filename">' + input.files[onLoadCounter].name + '</p>' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash btn_img_upload_delete" viewBox="0 0 16 16">' +
                        '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
                        '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
                    '</svg>' +
                    // '<input type="checkbox" name="is_img_upload_main_id" value="filename" />' +
                    '<input type="checkbox" name="img_upload_main_id" value="filename" />' +
                    '<label>main</label>' +
                '</li>';
            
            onLoadCounter++;
            $(".img_upload_container").append(htmlStr);
        // }
        });
        reader.readAsDataURL(input.files[0]);

        var counter = 1;
        reader.onloadend = function(e){
            if(counter < input.files.length){
                reader.readAsDataURL(input.files[counter]); 
                counter++;
            }
        }
    }

    $(document).on("change", "#img_upload", function(){
        readURL(this); // javascript solution
    });

    /********************************************************************/
    

    /*  Disable other checkbox when a checkbox is checked    */
    $(document).on("click", ".img_upload_section input[type=checkbox]", function(){
        if($(".img_upload_section input[type=checkbox]").not(this).attr("disabled")){
            resetCheckbox();
        }
        else{
            $(".img_upload_section input[type=checkbox]").not(this).attr("disabled", true);
            $(".img_upload_section input[type=checkbox]").not(this).siblings("label").css("color", "gray");
        }
    });
    /********************************************************************/

    /*  Remove the uploaded photo and verify if checkbox is checked to reset the checkbox    */
    $(document)
        .on("mouseover", ".img_upload_section",  function(){
            $(this).children(".btn_img_upload_delete").css("visibility", "visible");
            $(this).children(".btn_img_upload_delete").css("cursor", "pointer");
            $(this).css("outline", "2px solid #1975ff");
        })
        .on("mouseleave", ".img_upload_section",  function(){
            $(this).children(".btn_img_upload_delete").css("visibility", "hidden");
            $(this).children(".btn_img_upload_delete").css("cursor", "default");
            $(this).css("outline", "none");
        });
        
    $(document).on("click", ".btn_img_upload_delete", function(){
        if(!$(this).siblings("input[type=checkbox]").attr("disabled")){
            resetCheckbox();
        }
        $(this).parent().remove();
    });
    /********************************************************************/

    /*  For sorting/arrangement of photo    */
    $(document)
        .on("mouseover", ".img_upload_section figure",  function(){
            $(this).parent().parent().sortable({
                start: function(e, ui){
                    ui.placeholder.height(ui.item.height());
                }
            });
            $(this).parent().parent().sortable("enable");
            $(this).css("cursor", "grab");
        })
        .on("mouseleave", ".img_upload_section figure",  function(){
            // $(this).parent().css("background-color", "white");
            $(this).parent().parent().sortable("disable");
        })
        .on("mousedown", ".img_upload_section figure",  function(){
            $(this).css("cursor", "grabbing");
        })
        .on("mouseup", ".img_upload_section figure",  function(){
            $(this).css("cursor", "grab");
        });
    /********************************************************************/

        /*  Clicking cancel or close will close the dialog box    */
    $(document).on("click", ".btn_cancel_products_add_edit, .btn_close", function(){
        hideDialogBox();
        return false;
    });
    /********************************************************************/

    /*  Clicking preview button will display a new tab of Preview page    */
    $(document).on("click", ".btn_preview_products_add_edit", function(){
        var prevProductName = $(".form_product_add_edit").children(".input_product_name").val();
        var prevProductDesc = $(".form_product_add_edit").children(".input_product_desc").val();
        var prevProductPrice = $(".form_product_add_edit").children(".input_product_price").val();

        var totalOptions = 3;
        var prevProductPriceOption = [];
        for(var i = 0; i < totalOptions; i++){
            prevProductPriceOption[i] = i + 1 + ' ($' + prevProductPrice * (i + 1) + ')';
        }

        var imgUpload = $(".img_upload_section > figure > img");
        var imgCheckbox = $(".img_upload_section > input[type=checkbox]");
        var prevProductImg = [];
        var mainIndexImg = 0;
        for(var i = 0; i < imgUpload.length; i++){
            prevProductImg[i] = imgUpload[i].currentSrc;
            if(imgCheckbox[i].checked){
                mainIndexImg = i;
            }
        }

        preview(prevProductName, prevProductDesc, prevProductPriceOption, prevProductImg, mainIndexImg);
    });
    /********************************************************************/
        /*  Function for Preview in new tab    */
        function preview(prevProductName, prevProductDesc, prevProductPriceOption, prevProductImg, mainIndexImg){
            var previewWindowHTML = '' +
                '<!DOCTYPE html>' +
                '<html lang="en">' +
                '<head>' +
                    '<meta charset="UTF-8">' +
                    '<meta http-equiv="X-UA-Compatible" content="IE=edge">' +
                    '<meta name="viewport" content="width=device-width, initial-scale=1.0">' +
                    '<title>(Product Page) '+ prevProductName +' | Lashopda</title>' +
                    
                    '<link rel="stylesheet" type="text/css" href="../../../application/views/assets/css/normalize.css" />' +
                    '<link rel="stylesheet" type="text/css" href="../../../application/views/assets/css/style.css" />' +
                    
                '</head>' +
                '<body>' +
                    '<header>' +
                        '<a href=""><h2>Lashopda</h2></a>' +
                        '<a class="nav_end" href=""><h3>Shopping Cart (<span class="cart_quantity">0</span>)</h3></a>' +
                    '</header>' +
                    '<main>' +
                        '<section class="item_panel">' +
                            '<a class="go_back" href=""><p>Go Back</p></a>' +
                            '<div class="item_details">' +
                                '<aside class="img_section">' +
                                    '<img class="main_img" src="' + prevProductImg[mainIndexImg] + '" alt="img"/>' +
                                    '<section>';
            for(var i = 0; i < prevProductImg.length; i++){
                previewWindowHTML += '<img class="sub_img" src="' + prevProductImg[i] + '" alt="img"/>'
            }
                                        // '<img class="sub_img" src="' + prevProductImg + '" alt="img"/>' +
                                        // '<img class="sub_img default_main_img" src="' + '" alt="img"/>' +
                                        // '<img class="sub_img" src="' + '" alt="img"/>' +
                                        // '<img class="sub_img" src="' + '" alt="img"/>' +
            previewWindowHTML += '' +
                                    '</section>' +
                                '</aside>' +
                                '<aside class="desc_section">' +
                                    '<h2>' + prevProductName + '</h2>' +
                                    '<p>' + prevProductDesc + '</p>' +
                                    '<form action="" method="post">' +
                                        '<input type="hidden" name="product_id" value="product_id"/>' +
                                        '<select class="new_order_qty">' +
                                            '<option>' + prevProductPriceOption[0] + '</option>' +
                                            '<option>' + prevProductPriceOption[1] + '</option>' +
                                            '<option>' + prevProductPriceOption[2] + '</option>' +
                                        '</select>' +
                                        '\n<input type="submit" value="Buy"/>' +
                                        '<p class="item_added_confirm">Item added to the cart.</p>' +
                                    '</form>' +
                                '</aside>' +
                            '</div>' +
                        '</section>' +
                    '</main>';

            var previewWindow = window.open("", "Preview");
            previewWindow.document.write(previewWindowHTML);
        }
    
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
/**********************************************/

/*  Reset the UI/Display of product categories    */
function resetCategoryDisplay(){
    $(".product_categories").hide();
    $(".product_category_text_input").attr("readonly", true).css("outline", "none").css("cursor", "default");
    $(".dummy_select_tag").css("border", "0.3px solid rgb(118, 118, 118)");
    $(".bg_category_confirm_delete").hide();
    $(".waiting_icon").css("visibility", "hidden");
}
/**********************************************/

/*  Reset the attributes of checkbox    */
function resetCheckbox(){
    $(".img_upload_section input[type=checkbox]").attr("disabled", false);
    $(".img_upload_section input[type=checkbox]").siblings("label").css("color", "black");
}
/**********************************************/

/*  Reset the attributes of checkbox    */
function hideDialogBox(){
    $("dialog.admin_products_add_edit").hide();
    $(".admin_product_delete").hide();
    $(".modal_bg").hide();
}
/**********************************************/


/* Request for the products, 
    render the list on html 
    and hightlight the page number on pagination.
*/
function getProducts(page = 1){
    $.get("/products/index_html?page=" + page + '&' + $('.form_admin_products_search').serialize() + '&item_per_page=5', function(res){
        $('#root').html(res)
        pageNumHighlight(page);
    })
}
/**********************************************/

/*
    It will return a single product and populate the
    add edit form.
*/
function getProduct(product_id){
    $.get("/products/ajax_show/" + product_id, function(res){
        $('.form_product_add_edit .input_product_name').val(res.product['name'])
        $('.form_product_add_edit .input_product_desc').val(res.product['description'])
        $('.form_product_add_edit .category_id').val(res.product['category_id'])
        $('.form_product_add_edit .input_product_price').val(res.product['price'])
        $('.form_product_add_edit .input_product_qty').val(res.product['inventory'])

        $('.form_product_category_edit .product_category_id').each(function(){
            if($(this).val() == res.product['category_id']){
                $('.dummy_select_tag span:first-child').text($(this).siblings('.product_category_text_input').val());
            }
        })

        $('.csrf').val(res.csrf['hash'])
        $('.csrf').attr('name', res.csrf['name'])
    })
}
/**********************************************/

