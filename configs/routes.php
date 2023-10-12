<?php
    $routes['default_controller'] = 'homeController';
    $routes['user/profile'] = 'homeController/profile';
    $routes['products'] = 'productsController';
    $routes['cart/details'] = 'cartController/orderDetail';
    $routes['contact'] = 'contactController';
    $routes['detailProduct-(.+?)'] = 'productsController/detailProduct/$1';
    $routes['admin/products'] = 'Admin/ProductsController';
    $routes['admin/brands'] = 'Admin/BrandsController';
    $routes['user'] = 'UsersController';
    $routes['user/login'] = 'UsersController/login';
    $routes['user/profile/edit/(.+?)'] = 'UsersController/editProfile/$1';
    $routes['adminHandle'] = 'Admin/AdminController';
    $routes['categories'] = 'CategoryController';
    $routes['cart'] = 'CartController';
    $routes['admin/categories'] = 'Admin/CategoriesController';
    $routes['payment'] = 'PaymentController';
    $routes['admin'] = 'Admin/DashboardController';