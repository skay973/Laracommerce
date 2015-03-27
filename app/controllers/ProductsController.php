<?php

class ProductsController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {
		$categories = array();

		foreach(Category::all() as $category) {
			$categories[$category->id] = $category->name;
		}

		return View::make('products.index')
			->with('products', Product::all())
			->with('categories', $categories);
	}

	public function getCreate() {
		$categories = array();

		foreach(Category::all() as $category) {
			$categories[$category->id] = $category->name;
		}

		return View::make('products.create')->with('categories', $categories);
	}

	public function getEdit($id) {
		$categories = array();

		foreach(Category::all() as $category) {
			$categories[$category->id] = $category->name;
		}

		return View::make('products.edit')->with('product', Product::find($id))->with('categories', $categories);
	}

	public function postEdit() {
		// On enleve les restrictions pour l'image, pour ne pas être obligé de la remettre à chaque fois qu'on met un produit à jour
		$rules = Product::$rules;
		unset($rules['image']);
		$messages = Product::$messages;
		unset($messages['image.required']);
		unset($messages['image.image']);
		unset($messages['image.mimes']);

		$validator = Validator::make(Input::except('image'), $rules, $messages);

		$product = Product::find(Input::get('id'));

		if ($validator->passes()) {
			$product->category_id = Input::get('category_id');
			$product->title = Input::get('title');
			$product->description = Input::get('description');
			$product->price = Input::get('price');

			if(Input::hasFile('image')) {
				File::delete('public/'.$product->image);
				$image = Input::file('image');
				$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->resize(468, 249)->save('assets/images/products/'.$filename);
				$product->image = 'assets/images/products/'.$filename;
			}

			$product->save();

			return Redirect::to('admin/products/index')
			->with('success', 'Produit mis à jour');
		}

		return Redirect::to('admin/products/edit/'.$product->id)
		->with('error', 'Erreur lors de la mise à jour du produit')
		->withErrors($validator)
		->withInput();
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), Product::$rules, Product::$messages);

		if ($validator->passes()) {
			$product = new Product;
			$product->category_id = Input::get('category_id');
			$product->title = Input::get('title');
			$product->description = Input::get('description');
			$product->price = Input::get('price');

			$image = Input::file('image');
			$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
			Image::make($image->getRealPath())->resize(468, 249)->save('assets/images/products/'.$filename);
			$product->image = 'assets/images/products/'.$filename;
			$product->save();

			return Redirect::to('admin/products/index')
				->with('success', 'Produit crée');
		}

		return Redirect::to('admin/products/index')
			->with('error', 'erreur lors de la création du produit')
			->withErrors($validator)
			->withInput();
	}

	public function postDestroy() {
		$product = Product::find(Input::get('id'));

		if ($product) {
			File::delete('public/'.$product->image);
			$product->delete();
			return Redirect::to('admin/products/index')
				->with('success', 'Product Deleted');
		}

		return Redirect::to('admin/products/index')
			->with('error', 'Something went wrong, please try again');
	}
}
