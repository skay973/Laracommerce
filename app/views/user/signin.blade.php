@extends('layouts.main')

@section('page-title')
    <header id="page-title">
        <div class="container">
            <h1>Connexion</h1>

            <ul class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Accueil</a></li>
                <li class="active">Connexion</li>
            </ul>
        </div>
    </header>
@stop

@section('content')
    <section class="container">
        <div class="row">
            <!-- LOGIN -->
            <div class="col-md-6">
                <h2>Se <strong>connecter</strong></h2>
                {{ Form::open(array('url'=>'user/signin')) }}
                    <div class="white-row">
                        <div class="form-group">
                                {{ Form::label('email', 'Identifiant (adresse email)') }}
                                {{ Form::text('email', null, array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                                {{ Form::label('password', 'Mot de passe') }}
                                {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                        <button type="submit" class="btn btn-primary">Me connecter</button>
                    </div>
                {{ Form::close() }}

            </div>
            <!-- /LOGIN -->

            <!-- PASSWORD -->
            <div class="col-md-6">

                <h2>Créer un <strong>compte</strong></h2>
                {{ Form::open(array('url'=>'user/create')) }}
                <div class="white-row">

                    <div class="form-group">
                        {{ Form::label('firstname', 'Prénom') }}
                        {{ Form::text('firstname', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('lastname', 'Nom') }}
                        {{ Form::text('lastname', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('phone', 'Téléphone') }}
                        {{ Form::text('phone', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'Adresse email') }}
                        {{ Form::text('email', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Mot de passe') }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Confirmer le mot de passe') }}
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                    </div>

                    <button type="submit" class="btn btn-primary">Créer mon compte</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>

@stop
