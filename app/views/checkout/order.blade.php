@extends('layouts.main')

@section('page-title')
    <header id="page-title">
        <div class="container">
            <h1>Invoice Payment</h1>

            <ul class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Accueil</a></li>
                <li>Paiement</li>
                <li class="active">Récapitulatif de la commande</li>
            </ul>
        </div>
    </header>
@stop

@section('content')
    <section class="container printable">
        <div class="white-row">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive" src="{{ asset('assets/images/logo.png') }}" alt="" />
                </div>

                <div class="col-sm-6 text-right">
                    <p>
                        #0123456789 &bull; <strong>29 June 2014</strong>
                        <br />
                        Lid est laborum dolo rumes fugats untras.
                    </p>
                </div>
            </div>

            <hr class="margin-top10 margin-bottom10" />

            <div class="row">
                <div class="col-sm-6">
                    <h4><strong>Client</strong> Details</h4>
                    <ul class="list-unstyled">
                        <li><strong>First Name:</strong> John</li>
                        <li><strong>Last Name:</strong> Doe</li>
                        <li><strong>Country:</strong> U.S.A.</li>
                        <li><strong>DOB:</strong> YYYY/MM/DD</li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <h4><strong>Payment</strong> Details</h4>
                    <ul class="list-unstyled">
                        <li><strong>Bank Name:</strong> 012345678901</li>
                        <li><strong>Account Number:</strong> 012345678901</li>
                        <li><strong>SWIFT Code:</strong> SWITCH012345678CODE</li>
                        <li><strong>V.A.T Reg #:</strong> VAT5678901CODE</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Payment <strong>Invoice</strong></h3>
            </div>

            <div class="panel-body">
                <p>Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets.</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order->products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->price }} €</td>
                            <td>{{ $product->price * $product->pivot->quantity }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="half-margins invisible" />

        <div class="row">
            <div class="col-sm-6">
                <h4><strong>Contact</strong> Details</h4>

                <p class="nomargin nopadding">
                    <strong>Note:</strong>
                    Like other components, easily make a panel more meaningful to a particular context by adding any of the contextual state classes.
                </p><br /><!-- no P margin for printing - use <br> instead -->

                <address>
                    PO Box 21132 <br>
                    Vivas 2355 Australia<br>
                    Phone: 1-800-565-2390 <br>
                    Fax: 1-800-565-2390 <br>
                    Email:support@yourname.com
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <ul class="list-unstyled invoice-total-info">
                    <li><strong>Total :</strong> {{ $order->total_amount }} €</li>
                </ul>

                @if($order->status == Config::get('constants.WAIT_FOR_PAYMENT'))
                    {{ Form::open(array('id' => 'stripe-checkout-form', 'url' => 'store/checkout/payment')) }}
                        <input type="hidden" name="total_amount" value="@get_cents($order->total_amount)" />
                        <input type="hidden" name="description" value="" />
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <input type="hidden" name="stripeToken" value="" />
                        <div class="padding20">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimer</button>
                            <button class="btn btn-primary" id="stripe-checkout-btn"><i class="fa fa-credit-card"></i> Payer</button>
                        </div>
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </section>
@stop

@section('javascripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        var description = "";
        @foreach($order->products as $product)
            if (description.length > 0) {
                description += ",";
            }

            description += "{{ $product->pivot->quantity }} {{ $product->title }}";

        @endforeach

        var handler = StripeCheckout.configure({
            key: '{{ Config::get("stripe.stripe.public") }}',
            currency: 'eur',
            name: 'Les doudous de Cricri',
            image: '/square-image.png',
            panelLabel: 'Payer',
            allowRememberMe: false,
            token: function(token) {
                var $input = $('input[name=stripeToken]').val(token.id);
                $('#stripe-checkout-form').submit();
            }
        });

        $('#stripe-checkout-btn').on('click', function(e) {
            $('input[name=description]').val(description);
            handler.open({
                email: '{{ Auth::user()->email }}',
                amount: $('input[name=total_amount]').val(),
                description: $('input[name=description]').val()
            });
            e.preventDefault();
        });

        $(window).on('popstate', function() {
            handler.close();
        });
    </script>
@stop
