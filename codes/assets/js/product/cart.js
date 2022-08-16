$(document).ready(function(){

    /*  For submitting forms, redirect to page    */
    $(document).on("submit", "form", function(){
        window.location = $(this).attr("action");
        return false;
    });
    /**********************************************/

    /*  When delete cart form is submitted   */
    $('form.remove_cart_form').submit(function(){
        var row = $(this).parent().parent()
        var row_total_price = $(this).parent().siblings('.total_price').children('span').text()

        $.post($(this).attr('action'), $(this).serialize(), function(res){
            $('.csrf').val(res.csrf['hash'])
            $('.csrf').attr('name', res.csrf['name'])

            if(res.is_success == true){
                $('.cart_count').text(parseInt($('.cart_count').text()) - 1)
                $(this).parent().parent().remove()
                row.remove()
                $('.cart_total_amount').text(parseFloat($('.cart_total_amount').text()) - parseFloat(row_total_price))
            }
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

    /* When quantity is clicked */
    $(document).on('change', '.update_cart_form .quantity_input', function(){
        // quantity_hold = $(this).val()
        $(this).addClass('active')
    })

    /**********************************************/

    /* WHen update cart form is submitted */
    $('form.update_cart_form').submit(function(){
        var quantity_input = $(this).children('.quantity_input')
        var price = $(this).parent().siblings('.price').children('span').text()
        var total_price_row = $(this).parent().siblings('.total_price').children('span')

        $.post($(this).attr('action'), $(this).serialize(), function(res){
            $('.csrf').val(res.csrf['hash'])
            $('.csrf').attr('name', res.csrf['name'])

            if(res.is_success == true){
                quantity_input.removeClass('active')
                var new_total_row = quantity_input.val() * parseFloat(price)
                total_price_row.text(new_total_row)

                var new_cart_total = 0
                $('.cart_table tbody tr .total_price span').each(function(){
                    new_cart_total += parseFloat($(this).text())
                });

                $('.cart_total_amount').text(new_cart_total)
            }

            $.toast({
                heading: res.is_success ? 'Success' : 'Error',
                text: res.message,
                icon: res.is_success ? 'success' : 'error',
                showHideTransition: 'slide',
                position: 'top-right',
                hideAfter: 5000, 
            })
        })
        

        return false
    })


    /**********************************************/
    
    $('.quantity_input').change(function(){
        if($(this).val() < 1 || isNaN($(this).val())){
            $(this).val(1)
        }
    })

});