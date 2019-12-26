<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li class="error"> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="signup-form"><!--sign up form-->
                    <h2>Вход на сайт</h2>
                    <br/>
                    <p class="error">* - обязательное поле</p>
                    <br/>
                    <form action="#" method="post">
                        <p>*E-mail:</p><input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                        <p>*Пароль(не менее 6 символов):</p><input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                        <input type="submit" name="submit" class="btn btn-default" value="Вход" />
                    </form>
                </div><!--/sign up form-->
                <div class="signup-form"><!--sign up form добавил для новой уч.записи:--> 
                    <h2>Регистрация</h2> 
                    <form action="/user/register/" method="post"> 
                        <button type="submit">Создать новую учетную запись</button> 
                    </form> 
                </div><!--/sign up form конец добавления-->﻿

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>