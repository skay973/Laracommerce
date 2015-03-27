<?php

class Order extends Eloquent {

  protected $fillable = array('user_id', 'date', 'total_amount', 'status', 'shipping_number');

  public static $rules = array(
    'user_id'=>'required|integer',
    'date' => 'required|date',
    'total_amount' => 'required|numeric',
    'status' => 'required');

  public function products() {
      return $this->belongsToMany('Product')->withPivot('quantity');
  }

  public function user() {
    return $this->belongsTo('User');
  }
}
