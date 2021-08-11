<?php include ROOT . '/views/site/layouts/header.php' ?>
    
    <section id="cart_items">
        <div class="container">
            <?php if(isset($products) && $products !== false) {?>
            <div class="table-responsive cart_info">
                <form action="/cart/checkout/" method="POST">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Товар</td>
                        <td class="description"></td>
                        <td class="price">Цена</td>
                        <td class="quantity">Количество</td>
                        <td class="total">Стоимость</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) {?>
                    <tr id="product_<?php echo $product['id']; ?>">
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""><?php echo $product['name']; ?></a></h4>
                            <p>Код товара: <?php echo $product['code']; ?></p>
                        </td>
                        <td class="cart_price">
                            <span name="itemPrice_<?php echo $product['id']; ?>" id="itemPrice_<?php echo $product['id']; ?>" value="<?php echo $product['price']; ?>">$<?php echo $product['price']; ?></span>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a  class="cart_quantity_up" href="#" id="add_<?php echo $product['id']; ?>" onclick="plus(<?php echo $product['id']; ?>); return false;">+</a>
                                <input class="cart_quantity_input" type="text" name="quantity_<?php echo $product['id']; ?>" id="quantity_<?php echo $product['id']; ?>" value="1" autocomplete="off" size="2" onchange="conversionPrice(<?php echo $product['id']; ?>); return false;">
                                <a class="cart_quantity_down" href="#" id="downItem_<?php echo $product['id']; ?>" value="-" onclick="minus(<?php echo $product['id']; ?>); return false;">-</a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" >
                               $ <span  id="itemTotal_<?php echo $product['id']; ?>" value="<?php echo $product['price']; ?>"><?php echo $product['price']; ?></span>
                            </p>
                           
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" id="removeFromCart_<?php echo $product['id']; ?>" href="#" onclick="removeTCart(<?php echo $product['id']; ?>); return false;"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td>
                            <h4>Общая стоимость:</h4>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <p  class="cart_total_price">
                                $ <span  id="totalPrice" value="<?php echo $totalPrice; ?>">
                                <?php echo $totalPrice; ?>
                            </span>
                            </p>
                            
                        </td>
                    </tr>
                    </tbody>
                </table>
                    <input type="submit" class="btn btn-default checkout" value="Оформить заказ">
                </form>
            </div>
            <?php } else {?>
                <h4>Корзина пуста</h4>
            <?php }?>
        </div>
    </section> <!--/#cart_items-->

<?php include ROOT . '/views/site/layouts/footer.php' ?>