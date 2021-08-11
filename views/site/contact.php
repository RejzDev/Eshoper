<?php include ROOT . '/views/site/layouts/header.php' ?>
    
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-sm-offset-4 padding-right">
                    
                    <?php if ($result) { ?>
                        <p>Сообщение отправлено! Ми ответим вам на указаний email.</p>
                    <?php } else { ?>
                        
                        <?php if (isset($errors) && is_array($errors)) { ?>
                            <ul>
                                <?php foreach ($errors as $error) { ?>
                                    <li> - <?php echo $error; ?> </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        
                        <div class="signup-form"><!--sign up form-->
                            <h2>Обратная связь</h2>
                            <h5>Есть вопрос? Напишите нам?</h5>
                            <br/>
                            <form action="#" method="post">
                                <input type="email" name="userEmail" placeholder="Email" value="<?php echo $userEmail; ?>"/>
                                <input type="text" name="userText" placeholder="Сообщение" value="<?php echo $userText ?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>
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