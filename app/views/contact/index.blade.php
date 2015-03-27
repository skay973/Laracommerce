@extends('layouts.main')

@section('page-title')
<header id="page-title" class="nopadding">
    <div id="gmap"><!-- google map --></div>
    <script type="text/javascript">
        var	$googlemap_latitude 	= 4.885382,
        $googlemap_longitude	= -52.2806588,
        $googlemap_zoom			= 15;
    </script>
</header>
@stop

@section('content')
<section id="contact" class="container">
    <div class="row">
        <div class="col-md-7">
            <h2>Contactez-<strong><em>moi !</em></strong></h2>
            {{ Form::open(array('url'=>'contact/contact-form', 'method'=>'post', 'class' => 'white-row')) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            {{ Form::label('title', 'Nom / Prénom / Raison sociale *') }}
                            {{ Form::text('fullname', null, array('class' => 'form-control', 'data-msg-required' => 'Veuillez saisir un nom ou une raison sociale.', 'maxlength' => '100', 'id' => 'fullname')) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('email', 'Adresse email *') }}
                            {{ Form::email('email', null, array('class' => 'form-control', 'data-msg-required' => 'Veuillez saisir une adresse email.', 'data-msg-email' => 'L\'adresse email saisie n\'est pas valide.', 'maxlength' => '100', 'id' => 'email')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            {{ Form::label('subject', 'Objet du message *') }}
                            {{ Form::text('subject', null, array('class' => 'form-control', 'data-msg-required' => 'Veuillez saisir l\'objet du message.', 'maxlength' => '100', 'id' => 'subject')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            {{ Form::label('message', 'Message *') }}
                            {{ Form::textarea('message', null, array('class' => 'form-control', 'data-msg-required' => 'Veuillez saisir un message.', 'maxlength' => '5000', 'rows' => '10', 'id' => 'message')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Envoyer le message" class="btn btn-primary btn-lg" data-loading-text="Envoi...">
                    </div>
                </div>
            {{ Form::close() }}
        </div>

        <div class="col-md-5">
            <h2>Petite présentation</h2>

            <p>
                Bonjour, je m'appelle Christiane et je suis passionnée de crochet. <br/><br/>Vous trouverez sur mon site mes dernières créations mais vous pourrez également acheter en ligne certaines de mes réalisations. Il s'agit toujours de créations uniques donc la règle est simple : premier arrivé, premier servi ! <br/><br/>Vous pourrez également me passer des commandes sur une selection de modèles disponibles sur le site. <br/><br/>Pour plus d'informations, n'hésitez pas à utiliser le formulaire de contact juste à gauche et je vous répondrais dès que possible ! <br/><br/>Bonne visite. Christiane
            </p>

            <div class="divider half-margins"><!-- divider -->
                <i class="fa fa-star"></i>
            </div>

            <p>
                <span class="block"><strong><i class="fa fa-map-marker"></i> Adresse :</strong> 13, rue Raoul Dinga - 97354 Rémire-Montjoly</span>
                <span class="block"><strong><i class="fa fa-phone"></i> Téléphone :</strong> +594 594 38 37 87
                <span class="block"><strong><i class="fa fa-mobile-phone"></i> Mobile :</strong> +594 694 38 09 94
                <span class="block"><strong><i class="fa fa-envelope"></i> Email :</strong> <a href="mailto:christianeberic@gmail.com">christianeberic@gmail.com</a></span>
            </p>
        </div>
    </div>
</section>
@stop
