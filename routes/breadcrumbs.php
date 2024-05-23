<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('user.index'));
});

Breadcrumbs::for('user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index');
    $trail->push('Create User', route('user.create'));
});

Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user.index');
    $trail->push('Edit User', route('user.edit', $user));
});

Breadcrumbs::for('user.deactivated', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index');
    $trail->push('Deactivated Users', route('user.deactivated'));
});