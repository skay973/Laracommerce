<?php

class OrdersController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {
		return View::make('orders.index')->with('orders', Order::all());
	}

	public function getView($id) {
  		return View::make('orders.view')->with('order', Order::find($id));
	}

}
