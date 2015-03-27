<?php

class CheckoutController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');
	}

	public function getOrder($id) {
		$order = Order::find($id);
		$user = Auth::user();
		if($order->user == $user) {
			return View::make('checkout.order')->with('order', Order::with('user')->with('products')->find($id));
		} else {
			App::abort(403, 'Unauthorized action.');
		}

	}

	public function postOrder() {
		//init inputs
		$inputs = array();
		// set date
		$inputs['date'] = New DateTime();
		// set user
		$inputs['user_id'] = Auth::user()->id;

		// set items and calcul total amount
		$total_amount = 0;
		$cart_items = Cart::contents();
		$order_products = array();

		foreach($cart_items as $item) {
			$product = Product::find($item->id);
			$total_amount += $product->price * $item->quantity;

			$order_products[] = array($product->id, $item->quantity);
		}

		//set total amount
		$inputs['total_amount'] = $total_amount;
		// set status
		$inputs['status'] = Config::get('constants.WAIT_FOR_PAYMENT');
		// set shipping
		$inputs['shipping_number'] = '';

		// validator
		$order_validator = Validator::make($inputs, Order::$rules);

		// insert
		if ($order_validator->passes()) {
			$order = new Order;
			$order->date = $inputs['date'];
			$order->user_id = $inputs['user_id'];
			$order->total_amount = $inputs['total_amount'];
			$order->status = $inputs['status'];
			$order_shipping_number = $inputs['shipping_number'];

			$order->save();

			foreach ($order_products as $product) {
				$order->products()->attach($product[0], array('quantity' => $product[1]));
			}

			Cart::destroy();

			return Redirect::to('store/checkout/order/'.$order->id);
		}

		return Redirect::to('store/cart')
			->with('error', 'Un problème est survenu lors de la création de votre commande, veuillez vérifier le contenu de votre panier puis réessayer');
	}

	// Method that handle payment create
	public function postPayment() {
		// Use the config for the stripe secret key
		Stripe::setApiKey(Config::get('stripe.stripe.secret'));

		// Get the credit card details submitted by the form
		$token = Input::get('stripeToken');

		// Create the charge on Stripe's servers - this will charge the user's card
		try {
			$charge = Stripe_Charge::create(array(
				'amount' => Input::get('total_amount'), // amount in cents
				'currency' => "eur",
				'card'  => $token,
				'description' => Input::get('description'),
				'statement_description' => 'DOUDOU CRICRI '.Input::get('order_id'),
				'receipt_email' => Auth::user()->email)
			);

		} catch(Stripe_CardError $e) {
			$e_json = $e->getJsonBody();
			$error = $e_json['error'];
			// The card has been declined
			// redirect back to checkout page
			return Redirect::to('store/checkout/order/'.Input::get('order_id'))
				->withInput()->with('error',$error['message']);
		}

		$order = Order::find(Input::get('order_id'));
		$order->status = Config::get('constants.PAID');
		$order->save();

		// Maybe add an entry to your DB that the charge was successful, or at least Log the charge or errors
		// Stripe charge was successfull, continue by redirecting to a page with a thank you message
		return Redirect::to('store/checkout/confirm-page')->with('order_id', Input::get('order_id'));
	}

	public function getConfirmPage() {
		return View::make('checkout.confirm')->with('order_id', Session::get('order_id'));
	}

}
