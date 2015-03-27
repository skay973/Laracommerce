<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = array('firstname', 'lastname', 'email', 'phone', 'mobile');

	public static $rules = array(
		'firstname'=>'required|min:2|alpha',
		'lastname'=>'required|min:2|alpha',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:8,12|confirmed',
		'password_confirmation'=>'required|alpha_num|between:8,12',
		'phone'=>'required',
		'admin'=>'integer'
	);

	public static $messages = array(
		'firstname.required'=>'Vous devez saisir un prénom',
		'firstname.min'=>'Le prénom doit avoir une longueur minimum de 2 caractères',
		'firstname.alpha'=>'Le prénom ne doit pas contenir de caractères spéciaux',
		'lastname.required'=>'Vous devez saisir un nom',
		'lastname.min'=>'Le nom doit avoir une longueur minimum de 2 caractères',
		'lastname.alpha'=>'Le nom ne doit pas contenir de caractères spéciaux',
		'email.required'=>'Vous devez saisir une adresse email',
		'email.email'=>'Vous devez saisir une adresse email valide',
		'email.unique'=>'Un compte associé à cette adresse email existe déjà, veuillez vous identifier avec votre compte existant',
		'password.required'=>'Vous devez saisir un mot de passe',
		'password.alpha_num'=>'Le mot de passe ne doit pas contenir de caractères spéciaux, uniquement des chiffres ou des lettres',
		'password.between'=>'Le mot de passe doit avoir une longueur d\'au moins 8 caractères et ne doit pas dépasser 12 caractères',
		'password.confirmed'=>'Les mots de passe ne ccorespondent pas',
		'password_confirmation.required'=>'Vous devez confirmer votre mot de passe',
		'password_confirmation.alpha_num'=>'Le mot de passe de confirmation ne doit pas contenir de caractères spéciaux, uniquement des chiffres ou des lettres',
		'password_confirmation.between'=>'Le mot de passe de confirmation doit avoir une longueur d\'au moins 8 caractères et ne doit pas dépasser 12 caractères',
		'phone.required'=>'Vous devez saisir un téléphone',
		'admin.integer'=>'Le champs admin n\'est pas correctement saisi'
	);

	public function orders() {
		return $this->hasMany('Order');
	}

	public function billing_address()
    {
        return $this->belongsTo('Address', 'billing_address_id');
    }

	public function shipping_address()
	{
		return $this->belongsTo('Address', 'shipping_address_id');
	}

	public function getFullname()
	{
		return $this->firstname.' '.$this->lastname;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

}
