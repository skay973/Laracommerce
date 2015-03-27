@extends('layouts.main')

@section('promo')
	<div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <li data-transition="slotzoom-horizontal" data-slotamount="15" data-masterspeed="300" data-delay="9400">
                    <img src="{{ URL::asset('assets/images/slides/slide1-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption lfr"
						data-x="left"
                        data-y="0"
                        data-speed="1200"
                        data-start="1100"
                        data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
                        <a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide1-texte1.png') }}" alt="Image 1"></a>
                    </div>

					<div class="tp-caption lfr"
						data-x="left"
						data-y="100"
						data-speed="1200"
						data-start="1600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide1-texte2.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfr"
						data-x="left"
						data-y="220"
						data-speed="1200"
						data-start="2100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide1-texte3.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfr"
						data-x="left"
						data-y="320"
						data-speed="1200"
						data-start="2600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide1-texte4.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfl"
						data-x="right"
						data-y="bottom"
						data-speed="1200"
						data-start="3100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide1-texte5.png') }}" alt="Image 1"></a>
					</div>
                </li>

                <li data-transition="slotzoom-horizontal" data-slotamount="5" data-masterspeed="700">
                    <img src="{{ URL::asset('assets/images/slides/slide2-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

					<div class="tp-caption lft"
						data-x="left"
						data-y="center"
						data-speed="1200"
						data-start="1100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-mat1.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfb"
						data-x="left" data-hoffset="80"
						data-y="center" data-voffset="100"
						data-speed="1200"
						data-start="1600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-logo1.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lft"
						data-x="center"
						data-y="center"
						data-speed="1200"
						data-start="2100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-mat2.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfb"
						data-x="center"
						data-y="center" data-voffset="100"
						data-speed="1200"
						data-start="2600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-logo2.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lft"
						data-x="right"
						data-y="center"
						data-speed="1200"
						data-start="3100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-mat3.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfb"
						data-x="right" data-hoffset="-40"
						data-y="center" data-voffset="100"
						data-speed="1200"
						data-start="3600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide2-logo3.png') }}" alt="Image 1"></a>
					</div>
				</li>
				<li data-transition="slotzoom-horizontal" data-slotamount="5" data-masterspeed="700">
					<img src="{{ URL::asset('assets/images/slides/slide3-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

					<div class="tp-caption lft"
						data-x="left"
						data-y="center"
						data-speed="1200"
						data-start="1100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide3-texte1.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfl"
						data-x="left"
						data-y="bottom" data-voffset="-50"
						data-speed="1200"
						data-start="1600"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide3-effect1.png') }}" alt="Image 1"></a>
					</div>

					<div class="tp-caption lfr"
						data-x="left"
						data-y="bottom" data-voffset="-50"
						data-speed="1200"
						data-start="2100"
						data-easing="easeInExpo" data-end="9400" data-endspeed="1200" data-endeasing="easeInSine">
						<a href="shop-product-full-width.html"><img src="{{ URL::asset('assets/images/slides/slide3-texte2.png') }}" alt="Image 1"></a>
					</div>
				</li>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
@stop

@section('text-center')
    <section class="container text-center">
        <h1 class="text-center">
            Les <strong>nouveaux</strong> produits
        </h1>
    </section>
@stop

@section('content')
    <section class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-3"><!-- item -->
                <div class="item-box fixed-box">
                    <figure>
                        <a class="item-hover" href="{{ URL::to('store/view') }}/{{ $product->id }}">
                            <span class="overlay color2"></span>
                            <span class="inner">
                                <span class="block fa fa-plus fsize20"></span>
                                <strong>DETAIL</strong> DU PRODUIT
                            </span>
                        </a>
                        {{ Form::open(array('url'=>'store/addtocart')) }}
                            {{ Form::hidden('quantity', 1) }}
                            {{ Form::hidden('id', $product->id) }}
                            <button type="submit" class="btn btn-primary add_to_cart">
                                <i class="fa fa-shopping-cart"></i>
                                AJOUTER AU PANIER
                            </button>
                        {{ Form::close() }}
                        <img class="img-responsive" src="{{ asset($product->image) }}" width="260" height="260" alt="{{ $product->title }}">
                    </figure>
                    <div class="item-box-desc">
                        <h4>{{ $product->title }}</h4>
                        <small class="styleColor">{{ $product->price}} </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@stop
