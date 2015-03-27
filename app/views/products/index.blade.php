@extends('layouts.main')

@section('page-title')
<header id="page-title">
  <div class="container">
    <h1>Produits</h1>

    <ul class="breadcrumb">
      <li><a href="{{ URL::to('/') }}">Accueil</a></li>
      <li class="active">Produits</li>
    </ul>
  </div>
</header>
@stop

@section('text-center')
<section class="container text-center">
  <h1 class="text-center">
    <strong>Gestion</strong> des produits
  </h1>
</section>
@stop

@section('content')
<section class="container">
  <div class="row">
    <div class="col-md-12">
      <h2><strong>Liste </strong> des produits <a href="{{ URL::to('admin/products/create') }}" class="btn btn-success"><i class="fa fa-plus"></i></a></h2>
      <table id="products" class="table">
        <thead>
          <th>
            Photo
          </th>
          <th>
            Catégorie
          </th>
          <th>
            Nom et description du produit
          </th>
          <th>
            Prix
          </th>
          <th>
            Disponibilité
          </th>
          <th>
            Stock
          </th>
          <th>

          </th>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>
              {{ HTML::image($product->image, $product->title, array('width'=>'50')) }}
            </td>
            <td>
                <a href="#" data-type="select" id="category_id" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}" data-value="{{ $product->category->id }}"></a>
            </td>
            <td>
              <a href="#" data-type="text" id="title" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}">{{ $product->title }}</a><br/>
              <div class="white-row">
                <a href="#" data-type="textarea" id="description" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}">{{ $product->description }}</a>
              </div>
            </td>
            <td>
                <a href="#" data-type="text" id="price" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}">{{ $product->price }}</a>
            </td>
            <td>
                <a href="#" data-type="select" id="availability" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}" data-value="{{ $product->availability }}"></a>
            </td>
            <td>
                <a href="#" data-type="number" id="stock" data-pk="{{ $product->id }}" data-url="{{ URL::to('api/products/update') }}">{{ $product->stock }}</a>
            </td>
            <td>
              {{ Form::open(array('url'=>'admin/products/destroy', 'class'=>'form-inline')) }}
                  {{ Form::hidden('id', $product->id) }}
                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                  <a id="aEdit" class="btn btn-success" href="{{ Url::to('admin/products/edit/'.$product->id) }}"><i class="fa fa-pencil"></i></a>
              {{ Form::close() }}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

@stop

@section('javascripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#products a:not(#products a[id=availability], #products a[id=category_id], #products a[id=aEdit])').editable({
      success: function(response, newValue) {
        if(response.status == 'error')
          return response.msg;
        }
      });

    $("#products a[id=availability]").editable({
      value : $(this).attr('data-value'),
      source : [
        { value : 0, text : "Non disponible" },
        { value : 1, text : "Disponible"}
      ],
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $("#products a[id=category_id]").editable({
      value : $(this).attr('data-value'),
      source : [
      @foreach($categories as $index=>$category)
        { value : {{ $index }}, text : "{{ $category }}" },
      @endforeach
      ],
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    })
  });
  </script>
  @stop
