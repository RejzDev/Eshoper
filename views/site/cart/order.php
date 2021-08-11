<?php include ROOT . '/views/site/layouts/header.php'; ?>
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
        <?php if ($resData['success'] = 1) { ?>
            <h4><?php echo $resData['message']; ?></h4>
        <?php } else { ?>
            <h4><?php echo $resData['message']; ?></h4>
        <?php }?>
    </div>
        
    
    </div>

<?php include ROOT . '/views/site/layouts/footer.php'; ?>