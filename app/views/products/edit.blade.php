@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Produits</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li><a href="{{ URL::to('admin/products') }}">Produits</a></li>
            <li class="active">Modifier un produit</li>
        </ul>
    </div>
</header>
@stop

@section('text-center')
<section class="container text-center">
    <h1 class="text-center">
        <strong>Modification</strong> de {{ $product->title }}
    </h1>
</section>
@stop

@section('content')

<section class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url'=>'admin/products/edit', 'files'=>true)) }}
                {{ Form::hidden('id', $product->id) }}
                {{ Form::hidden('old_image', $product->image) }}
                <div class="form-group">
                    {{ Form::label('category_id', 'Categorie') }}
                    {{ Form::select('category_id', $categories, $product->category_id, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Nom de l\'article') }}
                    {{ Form::text('title', $product->title, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::textarea('description', $product->description, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('price', 'Prix') }}
                    {{ Form::text('price', $product->price, array('class'=>'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('image', 'Choisir une image') }}
                    {{ Form::file('image') }}
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Enregistrer</button>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop
