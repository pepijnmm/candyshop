@extends('layouts.usertemplate')

@section('content')
<form method="POST" action="{{action('AddressController@store')}}" method="POST">
            {{ method_field('POST') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="street_name">Straat naam</label>
		  <input required class="u-full-width" name="street_name" type="text" value="{{old('street_name')}}">
		</div>
		<div class="six columns">
		  <label for="house_number">Huisnummer</label>
		  <input required class="u-full-width" name="house_number" type="number" value="{{old('house_number')}}">
		</div>
		<div class="six columns">
		  <label for="zip_code">postcode</label>
		  <input required class="u-full-width" name="zip_code" type="text" value="{{old('zip_code')}}">
		</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
@endsection