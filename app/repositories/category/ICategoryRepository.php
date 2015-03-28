<?php

namespace Repositories\Category;

use Repositories\IRepository;

interface ICategoryRepository extends IRepository {

  public function allCategoriesToArray();

}
