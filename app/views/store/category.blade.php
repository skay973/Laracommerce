@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Categories</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li>Categories</li>
            <li class="active">{{ $category->name }}</li>
        </ul>
    </div>
</header>
@stop

@section('text-center')
    <section class="container text-center">
        <h1 class="text-center">
            <strong>{{ $category->name }}</strong>
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
                                <strong>PRODUCT</strong> DETAIL
                            </span>
                        </a>
                        {{ Form::open(array('url'=>'store/addtocart')) }}
                            {{ Form::hidden('quantity', 1) }}
                            {{ Form::hidden('id', $product->id) }}
                            <button type="submit" class="btn btn-primary add_to_cart">
                                <i class="fa fa-shopping-cart"></i>
                                ADD TO CART
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

@section('pagination')

	<section id="pagination">
		{{ $products->links() }}
	</section><!-- end pagination -->

@stop
