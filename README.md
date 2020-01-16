# E-shopix
This site was made on PHP 7.0 with using MVC pattern and OOP practice. 
It realizes Router and Front Controller components, that help to make user-friendly URLs.
All code is well documented (and self-documented :) ). 
It uses some Javascript (AJAX)to adding new product in cart and MySql database for storing 
products, orders, product categories and users data (using PDO with prepared statements). 
It requires Intervension and Phpmailer libraries (may look in composer.json file), 
to resize uploaded product images and post letters to admin and user respectively.
Site has Admin account (simple RBAC) that allows admin to manage some data 
(make create/read/update/delete (CRUD) operations with products, product categories, orders and users data). 
To see this, you can login as admin: use ... and ...(ask me: savelevi@mail.ru) for login/password respectively 
and add "/admin" in URL after "e-shopix.saviv.site". All passwords store in HASH only.
