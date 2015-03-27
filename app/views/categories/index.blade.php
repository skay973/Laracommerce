@extends('layouts.main')

@section('page-title')
	<header id="page-title">
		<div class="container">
			<h1>Catégories</h1>
			<ul class="breadcrumb">
				<li><a href="{{ URL::to('/') }}">Accueil</a></li>
				<li><a href="active">Catégories</a></li>
			</ul>
		</div>
	</header>
@stop

@section('text-center')
    <section class="container text-center">
        <h1 class="text-center">
            <strong>Gestion</strong> des catégories
            <span class="subtitle">BEST PRODUCTS YOU EVER SEEN!</span>
        </h1>
    </section>
@stop

@section('content')
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<h2><strong>Liste</strong> des catégories</h2>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<table class="table" id="categories">
						<thead>
							<th>
								Nom de la catégorie
							</th>
							<th>

							</th>
						</thead>
						<tbody>
						@foreach($categories as $category)
							<tr>
								<td>
										<a href="#" data-type="text" id="name" data-pk="{{ $category->id }}" data-url="{{ URL::to('api/categories/update') }}">{{ $category->name }}</a>
								</td>
								<td>
									{{ Form::open(array('url'=>'admin/categories/destroy', 'style'=>'display: inline;')) }}
										{{ Form::hidden('id', $category->id) }}
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
			<h2><strong>Ajouter</strong> une catégorie</h2>
			<div class="col-md-4">
				{{ Form::open(array('url'=>'admin/categories/create')) }}
				<div class="input-group">
					{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nom')) }}
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add</button>
					</span>
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
		$('#categories a').editable({
			success: function(response, newValue) {
				if(response.status == 'error')
					return response.msg;
				}
			});
	});
	</script>
	@stop
