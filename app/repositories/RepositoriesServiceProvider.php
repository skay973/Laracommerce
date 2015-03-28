<?php

namespace Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('Repositories\\Product\\IProductRepository', 'Repositories\\Product\\EloquentProductRepository');
    $this->app->bind('Repositories\\Category\\ICategoryRepository', 'Repositories\\Category\\EloquentCategoryRepository');
  }
}
