@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Mon compte</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li class="active">Mon compte</li>
        </ul>
    </div>
</header>
@stop

@section('content')
<section class="container">
    <div class="row container">
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md-12" id="profile-box">
                    <div class="white-row">
                        <h3>Mes<strong> Données </strong>personnelles</h3>
                        <ul class="list-icon angle-right">
                            <li>Prénom : <a href="#" data-type="text" id="firstname" data-pk="{{ Auth::user()->id }}" data-url="{{ URL::to('api/users/update-profile') }}">{{ Auth::user()->firstname }}</a></li>
                            <li>Nom : <a href="#" data-type="text" id="lastname" data-pk="{{ Auth::user()->id }}" data-url="{{ URL::to('api/users/update-profile') }}">{{ Auth::user()->lastname }}</a></li>
                            <li>Téléphone: <a href="#" data-type="text" id="phone" data-pk="{{ Auth::user()->id }}" data-url="{{ URL::to('api/users/update-profile') }}">{{ Auth::user()->phone }}</a></li>
                            <li>Mobile : <a href="#" data-type="text" id="mobile" data-pk="{{ Auth::user()->id }}" data-url="{{ URL::to('api/users/update-profile') }}">{{ Auth::user()->mobile }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-row">
                        <h3>Mon<strong> Compte</strong></h3>
                        {{ Form::open(array('url'=>'user/change-password')) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Adresse email') }}
                                    {{ Form::email('email', Auth::user()->email, array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('old_password', 'Ancien mot de passe') }}
                                    {{ Form::password('old_password', array('class' => 'form-control')) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('password', 'Nouveau mot de passe') }}
                                    {{ Form::password('password', array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('password_confirmation', 'Confirmer le mot de passe') }}
                                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row" id="addresses-box">
                <div class="col-md-12">
                    <div class="white-row">
                        <h3>Adresse de<strong> Facturation</strong></h3>
                        @if(isset(Auth::user()->billing_address_id))
                            <ul class="list-icon dot-circle">
                                <li>Numéro, rue : <a href="#" data-type="text" id="number" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->number }}</a>, <a href="#" data-type="text" id="street_line1" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->street_line1 }}</a> </li>
                                <li>Complément d'adresse : <a href="#" data-type="text" id="street_line2" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->street_line2 }}</a></li>
                                <li>Code postal - Ville : <a href="#" data-type="text" id="postal_code" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->postal_code }}</a> - <a href="#" data-type="text" id="city" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->city }}</a></li>
                                <li>Pays : <a href="#" data-type="text" id="country" data-pk="{{ Auth::user()->billing_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->billing_address()->first()->country }}</a></li>
                            </ul>
                        @else
                            Aucune adresse de facturation renseignée. <span><a href="#" class="btn btn-default">Ajout</a></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-row">
                        <h3>Adresse de<strong> Livraison</strong></h3>
                        @if(isset(Auth::user()->shipping_address_id))
                            @if((isset(Auth::user()->billing_address_id) && Auth::user()->billing_address_id != Auth::user()->shipping_address_id) || !isset(Auth::user()->billing_address_id))
                                <ul class="list-icon dot-circle">
                                    <li>Numéro, rue : <a href="#" data-type="text" id="number" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->number }}</a>, <a href="#" data-type="text" id="street_line1" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->street_line1 }}</a> </li>
                                    <li>Complément d'adresse : <a href="#" data-type="text" id="street_line2" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->street_line2 }}</a></li>
                                    <li>Code postal - Ville : <a href="#" data-type="text" id="postal_code" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->postal_code }}</a> - <a href="#" data-type="text" id="city" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->city }}</a></li>
                                    <li>Pays : <a href="#" data-type="text" id="country" data-pk="{{ Auth::user()->shipping_address()->first()->id }}" data-url="{{ URL::to('api/users/update-address') }}">{{ Auth::user()->shipping_address()->first()->country }}</a></li>
                                </ul>
                            @else
                                <input type="checkbox" name="same_address" id="same_address" checked value="1"> Adresse de livraison identique à l'adresse de facturation. <br/><span style="display: none" id="add_button"><a href="#" class="btn btn-default">Ajout</a></span>
                            @endif
                        @else
                            Aucune adresse de livraison renseignée.<span><a href="#" class="btn btn-default">Ajout</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#profile-box a').editable({
        emptytext: 'Non renseigné !',
        placement: 'right',
        success: function(response, newValue) {
            if(response.status == 'error')
                return response.msg;
        }
    });

    $('#addresses-box a:not(a.btn)').editable({
        emptytext: 'Non renseigné !',
        placement: 'left',
        success: function(response, newValue) {
            if(response.status == 'error')
                return response.msg;
            }
        });

    $('#same_address').change(function() {
        $('#add_button').toggle();
    });

});
</script>
@stop
