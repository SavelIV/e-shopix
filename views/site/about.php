<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>Информация о магазине</h4>
                <br/>
                <p>This site was made on PHP with using MVC pattern and OOP practice.
                    All code is well documented (and self-documented :) ).
                    It uses Javascript technique (AJAX)to adding new product in cart 
                    and MySql database for storing products, orders, product categories 
                    and users data(using PDO with prepared statements). It is requires 
                    Intervension and Phpmailer libraries (may look in composer.json file),
                    to resize uploaded product images and post letters to admin and user 
                    respectively.</p>
                <p>This site has Admin account (simple RBAC) that allows admin to manage 
                    some data (make create/read/update/delete (CRUD) operations with products, 
                    product categories, orders and users data). To see this, login as admin - 
                    use ... and ... for login/password respectively and add "/admin" in URL 
                    after "www.e-shopix.com". </p>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>