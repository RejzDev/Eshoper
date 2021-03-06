<?php include ROOT . '/views/site/layouts/header.php' ?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                    
                    <?php if (isset($errors) && is_array($errors)) { ?>
                        <ul>
                            <?php foreach ($errors as $error) { ?>
                                <li> - <?php echo $error; ?> </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    
                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайт</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Войти"/>
                        </form>
                    </div><!--/sign up form-->
                
               
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section><!--/form-->

<?php include ROOT . '/views/site/layouts/footer.php' ?>
