@extends('layouts.app')

@section('content')
<form action="{{ action('ProductController@store')   }}" method="POST">
            {{ method_field('POST') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="name">Naam</label>
		  <input required class="u-full-width" name="name" type="text" value="{{old('name')}}">
		</div>
		<div class="six columns">
		  <label for="image_location">Plaatje</label>
		  {!! Form::file('image', array('class' => 'image')) !!}
		  <input required class="u-full-width" name="image_location" type="text" value="{{old('image_location')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="price">Prijs</label>
		  <input required class="u-full-width" name="price" type="text" value="{{old('price')}}" onchange="this.value = this.value.replace(/,/g, '.')">
		</div>
		<div class="six columns">
		  <label for="weight">Gewicht</label>
		  <input required class="u-full-width" name="weight" type="number" value="{{old('weight')}}">
		</div>
	</div>
	<div class="row">
		<div class="six columns">
		  <label for="storage">Voorraad</label>
		  <input required class="u-full-width" name="storage" type="number" value="{{old('storage')}}">
		  <label for="discount">Korting</label>
		<input class="u-full-width" name="discount" type="number" value="{{old('discount')}}">
		</div>
		<div class="six columns">
		  <label for="description">Beschrijving</label>
		  <textarea required rows="4" cols="50" class="u-full-width" name="description">{{old('description')}}</textarea>
		</div>
	</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
	</row>
</form>
@endsection