<?php

return array(
    // Product:
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    // Catalog:
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    // Product category:
    'category/([0-9]+)/page-([1-9][0-9]?)' => 'catalog/category/$1/$2', // actionCategory in CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1',
    // Cart:
    'cart/checkout' => 'cart/checkout', // actionCheckout in CartController    
    'cart/delete/([0-9]+)' => 'cart/delete/$1',   
    'cart/add/([0-9]+)' => 'cart/add/$1',  
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', 
    'cart' => 'cart/index', 
    // User:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    // Cabinet:
    'cabinet/view/([0-9]+)' => 'cabinet/view/$1', 
    'cabinet/history' => 'cabinet/history', 
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    // Adminpanel, managing products:    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Adminpanel, managing categories:    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Adminpanel, managing orders:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Adminpanel, main:
    'admin' => 'admin/index',
    // Contacts:
    'contacts' => 'site/contact',
    //About:
    'about' => 'site/about',
    // Main page, redirection:
    'index' => 'site/index', // actionIndex in SiteController
    '.+' => 'site/index', 
    '' => 'site/index', 
);
