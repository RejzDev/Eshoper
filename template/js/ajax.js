
function addToCart(productId){
    console.log("js - addToCart()");
    console.log(productId);
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/add/"+productId,
        dataType : 'json',
        success: function (data) {
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);

            }

        }
    })
}

/**
 * Подсчет стоимости купленого товара
 *
 * @param integer itemId ID продукта
 */
function conversionPrice(itemId) {
    var newCnt = $('#quantity_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;

    $('#itemTotal_' + itemId).html('$' + itemRealPrice);

}

function plus(itemId) {
    var cnt = parseInt($('#quantity_' + itemId).val());
    var newCnt = cnt + 1;

    var itemPrice = parseInt($('#itemPrice_' + itemId).attr('value'));
    var itemRealPrice = newCnt * itemPrice;
    var totalPrice = parseInt($('#totalPrice').html());
    var totalRealPrice = totalPrice + itemPrice;


    $('#quantity_' + itemId).val(newCnt);
    $('#itemTotal_' + itemId).html(itemRealPrice);
    $('#totalPrice').html(totalRealPrice);

}

function minus(itemId) {
    var cnt = parseInt($('#quantity_' + itemId).val());
    var totalPrice = parseInt($('#totalPrice').html());

    var itemPrice = $('#itemPrice_' + itemId).attr('value');

    var newCnt = cnt - 1;
    if (newCnt < 0) {
        newCnt = 0;
        itemRealPrice = 0;
    } else {
        var itemRealPrice = newCnt * itemPrice;

        var totalRealPrice = totalPrice - itemPrice;
    }


    $('#quantity_' + itemId).val(newCnt);
    $('#itemTotal_' + itemId).html(itemRealPrice);
    $('#totalPrice').html(totalRealPrice);
}

function removeTCart(productId){
    console.log("js - addToCart()");
    console.log(productId);

    var totalPrice = parseInt($('#totalPrice').html());
    var itemTotalPrice = parseInt($('#itemTotal_' + productId).html());
    var totalRealPrice = totalPrice - itemTotalPrice;
    console.log(totalRealPrice);
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/remove/"+productId,
        dataType : 'json',
        success: function (data) {
            if(data['success']){


                $('#cartCntItems').html(data['cntItems']);
                $('#product_' + productId).remove();
                $('#totalPrice').html(totalRealPrice);

            }

        }
    })
}

