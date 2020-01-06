<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <p class="success">Вы зарегистрированы!</p>
                    <p class="success">Вы будете перенаправлены в личный кабинет через 5 сек.</p>
                    <meta http-equiv="refresh" content="4, url='/cabinet'">
                    <p class="success">Если этого не произошло, кликните сюда:</p>
                    <a href="/cabinet" class="btn btn-default"><i class="fa fa-user"></i> В кабинет</a>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li class="error"> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Регистрация на сайте</h2>
                        <br/>
                        <p class="error">* - обязательное поле</p>
                        <br/>
                        <form action="#" method="post">
                            <p>*Имя(не менее 2 символов):</p><input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                            <p>*E-mail:</p><input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <p>*Пароль(не менее 6 символов):</p><input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>