<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

class BreadcrumbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Breadcrumbs::macro('resource', function ($name, $title, $parentId = null, $titleAttribute = 'name') {
            Breadcrumbs::for($name . '.index', function (BreadcrumbTrail $trail) use ($name, $title, $parentId) {
                if ($parentId) {
                    $trail->parent($parentId);
                }
                $trail->push('Manage ' . $title . 's', route($name . '.index'));
            });
        
            Breadcrumbs::for($name . '.create', function (BreadcrumbTrail $trail) use ($name, $title) {
                $trail->parent($name . '.index');
                $trail->push('New ' . $title, route($name . '.create'));
            });
        
            Breadcrumbs::for($name . '.edit', function (BreadcrumbTrail $trail, $model) use ($name, $title, $titleAttribute) {
                $trail->parent($name . '.index');
                $trail->push('Edit ' . $title . ': ' . $model->$titleAttribute, route($name . '.edit', $model));
            });
        
            Breadcrumbs::for($name . '.deactivated', function (BreadcrumbTrail $trail) use ($name, $title) {
                $trail->parent($name . '.index');
                $trail->push('Deactivated ' . $title . 's', route($name . '.deactivated'));
            });
        });
    }
}
