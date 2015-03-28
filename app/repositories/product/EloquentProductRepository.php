<?php

namespace Repositories\Product;

use Product;

class EloquentProductRepository implements IProductRepository {

  // Interface methods
  public function all() {
    return Product::all();
  }

  public function find($id) {
    return Product::find($id);
  }

  public function create($input) {
    $product = new Product;
    $product->category_id = $input['category_id'];
    $product->title = $input['title'];
    $product->description = $input['description'];
    $product->price = $input['price'];

    $image = $input['image'];
    $filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
    \Image::make($image->getRealPath())->resize(468, 249)->save('assets/images/products/'.$filename);
    $product->image = 'assets/images/products/'.$filename;

    $product->save();
  }

  public function update($id, $input) {
    $product = Product::find($id);
		$product->category_id = $input['category_id'];
		$product->title = $input['title'];
		$product->description = $input['description'];
		$product->price = $input['price'];

		if(isset($input['image'])) {
			\File::delete('public/'.$product->image);
			$image = $input['image'];
			$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
			\Image::make($image->getRealPath())->resize(468, 249)->save('assets/images/products/'.$filename);
			$product->image = 'assets/images/products/'.$filename;
		}

		$product->save();
  }

  public function delete($id) {
    $product = Product::find($id);

    if(!$product) {
      return false;
    }

    \File::delete('public/'.$product->image);
    $product->delete();

    return true;
  }

  // Custom methods
  public function getRules() {
    return Product::$rules;
  }

  public function getMessages() {
    return Product::$messages;
  }
}
