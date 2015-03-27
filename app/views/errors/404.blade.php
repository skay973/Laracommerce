@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Page non trouvée</h1>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li class="active">Page non trouvée</li>
        </ul>
    </div>
</header>
@stop

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-9">
            <h2>
                <strong>Oops</strong>, La page demandée n'a pas été trouvée !!
                <span class="subtitle">Nous sommes désolé mais la page que vous recherchez n'existe pas.</span>
            </h2>
            <div class="e404">404</div>
        </div>

        <aside class="col-md-3">
            <h3>RECHERCHER !</h3>
            <div class="row">
                <div class="col-md-12">
                    <form method="get" action="#" class="input-group">
                        <input type="text" class="form-control" name="s" id="s" value="" placeholder="recherche..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </form>
                </div>
            </div>

            <h4>LIENS UTILES</h4>
            <ul class="nav nav-list">
                <li><a href="#"><i class="fa fa-circle-o"></i> Accueil</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> A propos</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Contact</a></li>
            </ul>
        </aside>
    </div>
</section>
@stop
