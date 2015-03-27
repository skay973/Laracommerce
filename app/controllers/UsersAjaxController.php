<?php

class UsersAjaxController extends BaseController {

	public function postUpdateProfile() {

		$inputs = Input::all();
		if (array_key_exists($inputs['name'], User::$rules)) {
			$validator = Validator::make(array($inputs['name'] => $inputs['value']), array($inputs['name'] => User::$rules[$inputs['name']]), User::$messages);

			if (isset($validator) && $validator->passes()) {
				$product = User::find($inputs['pk']);
				$product->$inputs['name'] = $inputs['value'];
				$product->save();
				return Response::json('', 200);
			}

			$messages = $validator->messages();

			return Response::json(array('status' => 'error', 'msg' => $messages->first($inputs['name'])), 200);

		} else {
			$product = User::find($inputs['pk']);
			$product->$inputs['name'] = $inputs['value'];
			$product->save();
			return Response::json('', 200);
		}

	}

	public function postUpdateAddress() {

		$inputs = Input::all();

		$validator = Validator::make(array($inputs['name'] => $inputs['value']), array($inputs['name'] => Address::$rules[$inputs['name']]), Address::$messages);

		if (isset($validator) && $validator->passes()) {
			$address = Address::find($inputs['pk']);
			$address->$inputs['name'] = $inputs['value'];
			$address->save();
			return Response::json('', 200);
		}

		$messages = $validator->messages();

		return Response::json(array('status' => 'error', 'msg' => $messages->first($inputs['name'])), 200);
	}

}
