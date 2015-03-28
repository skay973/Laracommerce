<?php

namespace Repositories\Category;

use Category;

class EloquentCategoryRepository implements ICategoryRepository {

  // Interface methods
  public function all() {
    return Category::all();
  }

  public function find($id) {
    return Category::find($id);
  }

  public function create($input) {
    $category = new Category;
    $category->name = $input['name'];
    $category->save();
  }

  public function update($id, $input) {

  }

  public function delete($id) {
    $category = Category::find($id);

    if(!$category) {
      return false;
    }

    $category->delete();

    return true;
  }

  // Custom methods
  public function allCategoriesToArray() {
    $categories = array();

    foreach(Category::all() as $category) {
			$categories[$category->id] = $category->name;
		}

    return $categories;
  }

  public function getRules() {
    return Category::$rules;
  }

  public function getMessages() {
    return Category::$messages;
  }
}
