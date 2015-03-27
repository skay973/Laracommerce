@extends('layouts.main')

@section('page-title')
<header id="page-title">
    <div class="container">
        <h1>Paramètres</h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Accueil</a></li>
            <li><a href="active">Paramètres</a></li>
        </ul>
    </div>
</header>
@stop

@section('text-center')
<section class="container text-center">
    <h1 class="text-center">
        <strong>Gestion</strong> des paramètres
        <span class="subtitle">BEST PRODUCTS YOU EVER SEEN!</span>
    </h1>
</section>
@stop

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><strong>Liste</strong> des paramètres</h2>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <table class="table" id="parameters">
                        <thead>
                            <th>
                                Nom du paramètre
                            </th>
                            <th>
                                Valeur du paramètre
                            </th>
                            <th>
                                
                            </th>
                        </thead>
                        <tbody>
                            @foreach($parameters as $parameter)
                            <tr>
                                <td>
                                    <a href="#" data-type="text" id="label" data-pk="{{ $parameter->id }}" data-url="{{ URL::to('api/parameters/update') }}">{{ $parameter->label }}</a>
                                </td>
                                <td>
                                    <a href="#" data-type="text" id="value" data-pk="{{ $parameter->id }}" data-url="{{ URL::to('api/parameters/update') }}">{{ $parameter->value }}</a>
                                </td>
                                <td>
                                    {{ Form::open(array('url'=>'admin/parameters/destroy', 'style'=>'display: inline;')) }}
                                    {{ Form::hidden('id', $parameter->id) }}
                                    <span class="col-md-6"><button type="submit" name="delete" id="delete" class="btn btn-primary"> <i class="fa fa-trash-o" style="padding-right: 0px;"></i></button></span>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="divider"><!-- divider --></div>
    <div class="row">
        <div class="col-md-12">
            <h2><strong>Ajouter</strong> un paramètre</h2>
            <div class="col-md-4">
                {{ Form::open(array('url'=>'admin/parameters/create')) }}
                <div class="form-group">
                    {{ Form::label('label', 'Libellé') }}
                    {{ Form::text('label', null, array('class' => 'form-control', 'placeholder' => 'Libellé')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('value', 'Valeur') }}
                    {{ Form::text('value', null, array('class' => 'form-control', 'placeholder' => 'Valeur')) }}
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop

@section('javascripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#parameters a').editable({
        success: function(response, newValue) {
            if(response.status == 'error')
                return response.msg;
            }
        });
    });
</script>
@stop
