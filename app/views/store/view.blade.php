@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Produits</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li>Produits</li>
            <li class="active">{{ $product->title }}</li>
        </ul>
    </div>
</header>
@stop

@section('styles')
{{ HTML::style('assets/css/plaque.css') }}
@stop

@section('content')
<section class="container">
    {{ Form::open(array('url'=>'store/addtocart', 'class' => 'form-inline productDescription noajax', 'role' => 'form')) }}
    {{ Form::hidden('id', $product->id) }}
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="owl-carousel controlls-over product-image" data-plugin-options='{"items": 1, "singleItem": true, "navigation": true, "pagination": true, "transitionStyle":"fadeUp"}'>
                <div>
                    <img alt="{{ $product->title }}" class="img-responsive" src="{{ asset($product->image) }}">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <h2 class="product-title">{{ $product->title}}</h2>
            <div class="productRowInfo">
                <span class="price styleSecondColor fsize20">{{ $product->price }} €</span>
            </div>

            <div class="desc">
                <h3 class="page-header">DESCRIPTION</h3>
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="row">
                <div class="col-md-7 col-md-offset-5">
                    <div class="addCartBtn">
                        <div class="input-group">
                            {{ Form::text('quantity', 1, array('maxlength'=>'2', 'class' => 'text-center form-control', 'placeholder' => 'Qty')) }}
                            <span class="input-group-btn">
                                <button id="addToCartBtn" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</section>
@stop
