<?php

class Address extends Eloquent {

    protected $fillable = array('user_id', 'number', 'street_line1', 'street_line2', 'city', 'postal_code', 'country');

    public static $rules = array(
        'user_id' => 'required|integer',
        'street_line1' => 'required',
        'city' => 'required',
        'postal_code' => 'required|max:5',
        'country' => 'required'
    );

    public static $messages = array(
        'user_id.required' => 'Une adresse doit être liée à un utilisateur',
        'user_id.integer' => 'L\'utilisateur saisi est incorrect',
        'street_line1.required' => 'La première ligne d\'adresse doit être renseignée',
        'city.required' => 'La ville doit être renseignée',
        'postal_code.required' => 'le code postal doit être renseigné',
        'postal_code.max' => 'La longueur du code postal ne doit pas dépasser 5 caractères',
        'country.required' => 'Le pays ou la région doit être renseigné'
    );

    public function user_billing_address() {
        return $this->hasOne('User');
    }

    public function user_shipping_address() {
        return $this->hasOne('User');
    }
}
