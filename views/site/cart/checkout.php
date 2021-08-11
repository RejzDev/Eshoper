<?php include ROOT . '/views/site/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php foreach ($categories as $categoryItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?php echo $categoryItem['id']; ?>">
                                                <?php echo $categoryItem['name']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">Корзина</h2>


                       


                        <div class="col-sm-4">
                            
                            <?php if (isset($_SESSION['user'])) { ?>
                            <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>

                            <div class="login-form">
                                <form action="/cart/saveorder/" method="post">

                                    <table>
                                        <tr>
                                            <td>№</td>
                                            <td>Наименование</td>
                                            <td>Количество</td>
                                            <td>Цена</td>
                                            <td>Стоимость</td>
                                        </tr>
                                        
                                        <?php $i = 1;
                                            foreach ($productsInCart as $item) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <a href="/product/<?php echo $item['id']; ?>/"><?php echo $item['name']; ?></a>
                                                    </td>
                                                    <td><?php echo $item['cnt']; ?></td>
                                                    <td>
                    <span id="itemCnt_<?php echo $item['id']; ?>">
                        <input type="hidden" name="itemCnt_<?php echo $item['id']; ?>"
                               value="<?php echo $item['cnt']; ?>"/>
                       <?php echo $item['cnt']; ?>
                    </span>
                                                    </td>
                                                    <td>
                    <span id="itemPrice_{$item['id']}">
                        <input type="hidden" name="itemPrice_<?php echo $item['id']; ?>"
                               value="<?php echo $item['price']; ?>"/>
                        <?php echo $item['price']; ?>
                    </span>
                                                    </td>
                                                    <td>
                    <span id="itemRealPrice_{$item['id']}">
                        <input type="hidden" name="itemRealPrice_<?php echo $item['id']; ?>"
                               value="<?php echo $item['realPrice']; ?>"/>
                        <?php echo $item['realPrice']; ?>
                    </span>
                                                    </td>
                                                </tr>
                                                <?php $i++;
                                            } ?>
                                    </table>

                                    <p>Ваша имя</p>
                                    <input type="text" name="userName" placeholder="" value="<?php echo $userName; ?>"/>

                                    <p>Номер телефона</p>
                                    <input type="text" name="userPhone" placeholder=""
                                           value="<?php echo $userPhone; ?>"/>

                                    <p>Комментарий к заказу</p>
                                    <input type="text" name="userComment" placeholder="Сообщение"
                                           value="<?php echo $userComment; ?>"/>

                                    <br/>
                                    <br/>
                                    <input type="submit" name="submit" class="btn btn-default" value="Оформить"/>

                            </div>
                            </form>
                        </div>
                        <?php } else { ?>
                            <h4>Для оформления заказа войдите!</h4>
                        
                        <?php } ?>


                    </div>

                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/site/layouts/footer.php'; ?>