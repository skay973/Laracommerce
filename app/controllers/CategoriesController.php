<?php

use Gateways\CategoryGateway as Category;

class CategoriesController extends BaseController {

	protected $category;

	public function __construct(Category $category) {
		parent::__construct();

		$this->category = $category;

		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {

		$categories = $this->category->getAllCategories(false);

		return View::make('categories.index')
			->with('categories', $categories);
	}

	public function postCreate() {
		$data = $this->category->createCategory(Input::all());

		if(!$data['success']) {
			return Redirect::to('admin/categories/index')
				->withErrors($data['message'])
				->withInput();
		}

		return Redirect::to('admin/categories/index')
			->with('success', 'Categorie crée');
	}

	public function postDestroy() {
		$data = $this->category->deleteCategory(Input::get('id'));

		if(!$data['success']) {
			return Redirect::to('admin/categories/index')
				->with('error', 'Une erreur s\'est produite, veuillez réessayer');
		}

		return Redirect::to('admin/categories/index')
			->with('success', 'Catégorie supprimée');

	}
}
