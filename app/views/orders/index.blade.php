@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Commandes</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li class="active">Commandes</li>
        </ul>
    </div>
</header>
@stop

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date de la commande</th>
                        <th>Client</th>
                        <th>Montant total</th>
                        <th>Status</th>
                        <th>Numero d'envoi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            {{ $order->id }}
                        </td>
                        <td>
                            {{ $order->date }}
                        </td>
                        <td>
                            {{ $order->user->getFullname() }}
                        </td>
                        <td>
                            {{ $order->total_amount }}
                        </td>
                        <td>
                            {{ $order->status }}
                        </td>
                        <td>
                            {{ $order->shipping_number }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@stop
