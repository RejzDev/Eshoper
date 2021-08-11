<?php include ROOT . '/views/site/layouts/header.php' ?>
    
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-sm-offset-4 padding-right">
                    
                    <?php if ($result) { ?>
                        <p>Даные отредактировани</p>
                    <?php } else { ?>
                        
                        <?php if (isset($errors) && is_array($errors)) { ?>
                            <ul>
                                <?php foreach ($errors as $error) { ?>
                                    <li> - <?php echo $error; ?> </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        
                        <div class="signup-form"><!--sign up form-->
                            <h2>Редактирование даних</h2>
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                                <input type="password" name="password" placeholder="Пароль"
                                       value="<?php echo $password; ?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Редактировать"/>
                            </form>
                        </div><!--/sign up form-->
                    
                    <?php } ?>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section><!--/form-->

<?php include ROOT . '/views/site/layouts/footer.php' ?>