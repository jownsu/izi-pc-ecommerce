$(document).ready(function(){

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
        $(this).addClass('active')
    })

    /**********************************************/

    /* When update cart form is submitted */
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
                new_cart_total += 50
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

    /* */
    $('#billing_checkbox').change(function(){
        if(this.checked == true){
            $("input[name='b_first_name']")
                .prop( "readonly", true)
                .val($("input[name='s_first_name']").val());

            $("input[name='b_last_name']")
                .prop( "readonly", true)
                .val($("input[name='s_last_name']").val());

            $("input[name='b_address1']")
                .prop( "readonly", true)
                .val($("input[name='s_address1']").val());

            $("input[name='b_address2']")
                .prop( "readonly", true)
                .val($("input[name='s_address2']").val());

            $("input[name='b_city']")
                .prop( "readonly", true)
                .val($("input[name='s_city']").val());

            $("input[name='b_state']")
                .prop( "readonly", true)
                .val($("input[name='s_state']").val());

            $("input[name='b_zipcode']")
                .prop( "readonly", true)
                .val($("input[name='s_zipcode']").val());
        }else{
            $("input[name='b_first_name']").prop( "readonly", false).val('');
            $("input[name='b_last_name']").prop( "readonly", false).val('');
            $("input[name='b_address1']").prop( "readonly", false).val('');
            $("input[name='b_address2']").prop( "readonly", false).val('');
            $("input[name='b_city']").prop( "readonly", false).val('');
            $("input[name='b_state']").prop( "readonly", false).val('');
            $("input[name='b_zipcode']").prop( "readonly", false).val('');
        }
    })
    /**********************************************/
    
    $('.quantity_input').change(function(){
        if($(this).val() < 1 || isNaN($(this).val())){
            $(this).val(1)
        }
    })

});