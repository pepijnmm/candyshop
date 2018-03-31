@extends('layouts.app')

@section('content')
<form action="{{ action('ProductController@update',$product->id)   }}" enctype="multipart/form-data" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="name">Naam</label>
		  <input required class="u-full-width" name="name" type="text" value="{{(empty(old('name')))?$product->name:old('name')}}">
		</div>
		<div class="six columns">
			  <label for="image_location">Plaatje(upload of vul naam in)</label>
			  <input name="image" type="file" value="{{(empty(old('image')))?$product->image:old('image')}}">
			  <label for="image_location">locatie(leeg laten bij uploaden)</label>
			  <input class="u-full-width" name="image_location" type="text" value="{{(empty(old('image_location')))?$product->image_location:old('image_location')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="price">Prijs</label>
		  <input required class="u-full-width" name="price" type="text" onchange="this.value = this.value.replace(/,/g, '.')" value="{{(empty(old('price')))?$product->price:old('price')}}">
		</div>
		<div class="six columns">
		  <label for="weight">Gewicht</label>
		  <input required class="u-full-width" name="weight" type="number" value="{{(empty(old('weight')))?$product->weight:old('weight')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="storage">Voorraad</label>
		  <input required class="u-full-width" name="storage" type="number" value="{{(empty(old('storage')))?$product->storage:old('storage')}}">
		  <label for="discount">Korting</label>
		<input class="u-full-width" name="discount" type="number" value="{{(empty(old('discount')))?$product->discount:old('discount')}}">
		</div>
		<div class="six columns">
		  <label for="description">Beschrijving</label>
		  <textarea required rows="4" cols="50" class="u-full-width" name="description">{{(empty(old('description')))?$product->description:old('description')}}</textarea>
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="small_description">Korte beschrijving</label>
		  <textarea required maxlength="200" rows="2" cols="25" class="u-full-width" name="small_description">{{(empty(old('small_description')))?$product->small_description:old('small_description')}}</textarea>
		</div>
		<div class="six columns">
			<input class="button-primary" type="submit" value="Opslaan">
		</div>
	</div>
</form>
<form action="{{ action('ProductController@destroy',$product->id)   }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
			<input class="button-primary" type="submit" value="Verwijderen">
</form>
@endsection