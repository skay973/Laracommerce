@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Produits</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li><a href="{{ URL::to('admin/products') }}">Produits</a></li>
            <li class="active">Créer un produit</li>
        </ul>
    </div>
</header>
@stop

@section('text-center')
<section class="container text-center">
    <h1 class="text-center">
        <strong>Créer</strong> un produit
    </h1>
</section>
@stop

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url'=>'admin/products/create', 'files'=>true)) }}
            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                {{ Form::select('category_id', $categories, null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('price') }}
                {{ Form::text('price', null, array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('image', 'Choose an image') }}
                {{ Form::file('image') }}
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Enregistrer</button>
            {{ Form::close() }}
        </div>
    </div>
</section>
@stop
