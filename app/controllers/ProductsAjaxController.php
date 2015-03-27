<?php

class ProductsAjaxController extends BaseController {

	public function postUpdate() {

		$inputs = Input::all();

		$validator = Validator::make(array($inputs['name'] => $inputs['value']), array($inputs['name'] => Product::$rules[$inputs['name']]), Product::$messages);

		if ($validator->passes()) {
			$product = Product::find($inputs['pk']);
			$product->$inputs['name'] = $inputs['value'];
			$product->save();
			return Response::json('', 200);
		}

		$messages = $validator->messages();
		return Response::json(array('status' => 'error', 'msg' => $messages->first($inputs['name'])), 200);

	}

}
