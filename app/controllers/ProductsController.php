<?php

use Gateways\ProductGateway as Product;
use Gateways\CategoryGateway as Category;

class ProductsController extends BaseController {

	protected $product;
	protected $category;
	
	public function __construct(Product $product, Category $category) {

		parent::__construct();

		$this->product = $product;
		$this->category = $category;

		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {

		$categories = $this->category->getAllCategories();

		$products = $this->product->getAllProducts();

		return View::make('products.index')
			->with('products', $products)
			->with('categories', $categories);
	}

	public function getCreate() {

		$categories = $this->category->getAllCategories();

		return View::make('products.create')->with('categories', $categories);
	}

	public function getEdit($id) {

		$categories = $this->category->getAllCategories();

		$product = $this->product->getProductById($id);

		return View::make('products.edit')->with('product', $product)->with('categories', $categories);
	}

	public function postEdit() {
		$data = $this->product->updateProduct(Input::get('id'), Input::all());

		if($data['success']) {

			return Redirect::to('admin/products/edit/'.$data['productId'])
				->with('error', 'Erreur lors de la mise à jour du produit')
				->withErrors($data['message'])
				->withInput();

		}

		return Redirect::to('admin/products/index')
			->with('success', 'Produit mis à jour');


	}

	public function postCreate() {

		$data = $this->product->createProduct(Input::all());

		if(!$data['success']) {

			return Redirect::to('admin/products/create')
				->with('error', 'Erreur lors de la création du produit')
				->withErrors($validator)
				->withInput();

		}

		return Redirect::to('admin/products/index')
			->with('success', 'Produit crée');

	}

	public function postDestroy() {

		$data = $this->product->deleteProduct(Input::get('id'));

		if(!$data['success']) {
			return Redirect::to('admin/products/index')
				->with('error', 'Une erreur s\'est produite, veuillez réessayer');
		}

		return Redirect::to('admin/products/index')
			->with('success', 'Produit supprimé');
	}
}
