
<?php include(ROOT . '/views/site/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        
                        <?php foreach ($categories as $categoryItem) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?php echo $categoryItem['id']; ?>">
                                            <?php echo $categoryItem['name']; ?></a></h4>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                
                </div>
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    
                    <?php foreach ($products as $productsItem) { ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/template/images/home/product1.jpg" alt=""/>
                                        <h2>$<?php echo $productsItem['price']; ?></h2>
                                        <p>
                                            <a href="/product/<?php echo $productsItem['id']; ?>"><?php echo $productsItem['name']; ?></a>
                                        </p>
                                        <a href="#" id="addCart_<?php echo $productsItem['id'];?>" class="btn btn-default add-to-cart" onclick="addToCart(<?php echo $productsItem['id'];?>); return false;"><i
                                                    class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($productsItem['is_new'] == 1) {?>
                                        <img src="/template/images/home/new.png" class="new" alt="">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div><!--features_items-->
                
                
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/site/layouts/footer.php'); ?>