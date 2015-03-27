<?php

class UsersController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getNewaccount() {
		return View::make('user.newaccount');
	}

	public function getAccount() {
		return View::make('user.account');
	}

	public function getOrders() {
		return View::make('user.orders');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->phone = Input::get('phone');

			$user->save();

			return Redirect::to('user/signin')
				->with('success', 'Merci pour votre inscription, veuillez maintenant vous identifier.');
		}

		return Redirect::to('user/signin')
			->with('error', 'Erreur lors de la création du compte')
			->withErrors($validator)
			->withInput();
	}

	public function getSignin() {
		return View::make('user.signin');
	}

	public function postSignin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('/')->with('success', 'Thanks for signing in');
		}

		return Redirect::to('user/signin')->with('error', 'Your email/password combo was incorrect');
	}

	public function postChangePassword() {
		if (Input::get('password') != '') {
			if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('old_password')))) {
				$validator = Validator::make(array('password' => Input::get('password'), 'password_confirmation' => Input::get('password_confirmation')), array('password' => User::$rules['password'], 'password_confirmation' => User::$rules['password_confirmation']), User::$messages);

				if ($validator->passes()) {
					$user = User::find(Auth::user()->id);
					$user->password = Hash::make(Input::get('password'));
					$user->save();

					return Redirect::to('user/account')
					->with('success', 'Vos données personnelles ont été mise à jour avec succès');
				}

				return Redirect::to('user/account')
				->withErrors($validator);
			} else {
				return Redirect::to('user/account')->with('error', 'La combinaison identifiant / mot de passe est incorrecte');
			}
		} else {
			if (Auth::attempt(array('email'=>Auth::user()->email, 'password'=>Input::get('old_password')))) {
				$validator = Validator::make(array('email' => Input::get('email')), array('email' => User::$rules['email']), User::$messages);

				if ($validator->passes()) {
					$user = User::find(Auth::user()->id);
					$user->email = Input::get('email');
					$user->save();

					return Redirect::to('user/account')
					->with('success', 'Vos données personnelles ont été mise à jour avec succès');
				}

				return Redirect::to('user/account')
				->withErrors($validator);
			} else {
				return Redirect::to('user/account')->with('error', 'La combinaison identifiant / mot de passe est incorrecte');
			}
		}
	}

	public function getSignout() {
		Auth::logout();
		return Redirect::to('user/signin')->with('message', 'You have been signed out');
	}
}
