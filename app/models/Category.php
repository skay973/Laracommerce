<?php

class Category extends Eloquent {

	protected $fillable = array('name');

	public static $rules = array(
		'name' => 'required|min:3'
	);

	public static $messages = array(
		'name.required' => 'Une catégorie doit avoir un nom',
		'name.min' => 'Le nom de la catégorie doit faire plus de 3 caractères'
	);

	public function products() {
		return $this->hasMany('Product');
	}
}
