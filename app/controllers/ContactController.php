<?php

class ContactController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    public function getIndex() {
        return View::make('contact.index');
    }

    public function postContactForm() {
        $data = Input::all();

        $rules = array(
            'fullname' => 'required|alpha',
            'subject'=>'required',
            'email' => 'required|email',
            'message' => 'required|min:25|max:5000'
        );

        $messages = array(
            'fullname.required' => 'Vous devez saisir un nom ou une raison sociale',
            'fullname.alpha' => 'Le nom ou la raison sociale ne doit contenir que des caractères alpha numérique',
            'subject.required' => 'Vous devez précisez l\'objet de votre message',
            'email.required' => 'Vous devez saisir une adresse email',
            'email.email' => 'L\'adresse email saisie n\'est pas valide',
            'message.required' => 'Vous devez saisir un message',
            'message.min' => 'Votre message doit contenir au minimum 25 caractères',
            'message.max' => 'Votre message doit contenir au maximum 5000 caractères'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {

            Mail::send('emails.contact', $data, function($message) use ($data)
            {
                $message->from($data['email'] , $data['fullname']);
                $message->to('kevin.beric@develdesign.net', 'Auto Racing Guyane')->subject('Contact depuis votre formulaire sur Auto Racing Guyane');
            });

            return Redirect::to('contact')->with('success', 'Message envoyé, nous vous recontacterons dans les meilleurs délais.');
        }

        return Redirect::to('contact')->withErrors($validator)->withInput();
    }
}
