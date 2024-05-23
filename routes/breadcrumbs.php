<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::resource('user', 'User');
Breadcrumbs::resource('product', 'Product', null, 'product_name');
Breadcrumbs::resource('category', 'Category', null, 'category_name');
Breadcrumbs::resource('subcategory', 'Subcategory', null, 'category_name');
Breadcrumbs::resource('brand', 'Brand', null, 'brand_name');

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});