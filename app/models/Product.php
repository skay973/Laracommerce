<?php

class Product extends Eloquent {

	protected $fillable = array('category_id', 'title', 'description', 'price', 'availability', 'stock', 'image');

	public static $rules = array(
		'category_id'=>'required|integer',
		'title'=>'required|min:2',
		'description'=>'required|min:20',
		'price'=>'required|numeric',
		'availability'=>'integer',
		'image'=>'required|image|mimes:jpeg,jpg,bmp,png,gif',
		'stock' => 'numeric'
	);

	public static $messages = array(
		'title.required' => 'Un produit doit avoir un titre',
		'title.min' => 'Le titre doit avoir une longueur minimum de 2 caractères',
		'description.required' => 'Un produit doit avoir une description',
		'description.min' => 'La description doit avoir une longueur minimum de 20 caractères',
		'price.required' => 'Un produit doit avoir un prix',
		'price.numeric' => 'Le prix doit avoir une forme numérique (12.00...)',
		'availability.integer' => 'La disponibilité doit être oui ou non',
		'image.required' => 'Un produit doit avoir une image',
		'image.image' => 'L\'image doit être une ressource valide',
		'image.mimes' => 'L\'image doit avoir un des formats suivants : .jpeg, .jpg, .bmp, .png, .gif',
		'stock.numeric' => 'Le stock doit est un nombre valide'
	);

	public function category() {
		return $this->belongsTo('Category');
	}

	public function orders() {
      return $this->belongsToMany('Order')->withPivot('quantity');
  }
}
