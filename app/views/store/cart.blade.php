@extends('layouts.main')

@section('page-title')
    <header id="page-title">
        <div class="container">
            <h1>Atropos Shop</h1>

            <ul class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Accueil</a></li>
                <li class="active">Panier</li>
            </ul>
        </div>
    </header>
@stop

@section('content')
    <section class="container">
        <h2>Shop Cart</h2>
        {{ Form::open(array('url' => 'store/checkout/order', 'class' => 'white-row')) }}
            <div id="cartContent">
                <div class="item head">
                    <span class="cart_img"></span>
                    <span class="product_name fsize13 bold">PRODUCT NAME</span>
                    <span class="remove_item fsize13 bold"></span>
                    <span class="total_price fsize13 bold">UNIT PRICE</span>
                    <span class="qty fsize13 bold">QUANTITY</span>
                    <div class="clearfix"></div>
                </div>

                @foreach($products as $product)
                <div class="item">
                    <div class="cart_img"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="60" /></div>
                    <a href="{{ URL::to('store/view') }}/{{ $product->id }}" class="product_name">{{ $product->name }}</a><span>{{ $product->desc }}</span>
                    <a href="/store/removeitem/{{ $product->identifier }}" class="remove_item">
                        X
                    </a>
                    <div class="total_price"><span>{{ $product->price }}</span>€</div>
                    <div class="qty">{{ $product->quantity }}</div>
                    <div class="clearfix"></div>
                </div>
                @endforeach

                <div class="total pull-right">
                    <span class="totalToPay styleSecondColor">
                        TOTAL: {{ Cart::total() }} €
                    </span>
                </div>

                <div class="divider"><!-- divider --></div>

                <input type="submit" value="Confirm order" class="btn_update btn btn-primary btn-md pull-right" style="margin-left: 5px;">
                {{ HTML::link('/', 'Continue Shopping', array('class'=>'btn_update btn btn-primary btn-md pull-right', 'style' => 'margin-right: 5px')) }}

                <div class="clearfix"></div>
            </div>
        {{ Form::close() }}
    </section>
@stop
