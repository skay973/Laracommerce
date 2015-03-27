@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Commande</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li>Commande</li>
            <li class="active">Confirmation de votre commande</li>
        </ul>
    </div>
</header>
@stop

@section('text-center')
<section class="container text-center">
    <h1 class="text-center">
        Confirmation de la <strong>commande n°{{ $order_id }}</strong>
        <span class="subtitle">Auto Racing vous remercie pour votre confiance.</span>
    </h1>
</section>
@stop

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <p style="text-align: center">
                Vous recevrez un email de confirmation d'ici quelques instants à l'adresse {{ Auth::user()->email }}.
            </p>
        </div>
    </div>
@stop
