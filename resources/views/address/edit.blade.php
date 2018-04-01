@extends('layouts.usertemplate')

@section('content')
<form action="{{ action('AddressController@update',$address->id)   }}" method="POST">
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	<div class="six columns">
		  <label for="street_name">Straat naam</label>
		  <input required class="u-full-width" name="street_name" type="text" value="{{(empty(old('street_name')))?$address->street_name:old('street_name')}}">
		</div>
		<div class="six columns">
		  <label for="house_number">Huisnummer</label>
		  <input required class="u-full-width" name="house_number" type="number" value="{{(empty(old('house_number')))?$address->house_number:old('house_number')}}">
		</div>
		<div class="six columns">
		  <label for="zip_code">postcode</label>
		  <input required class="u-full-width" name="zip_code" type="text" value="{{(empty(old('zip_code')))?$address->zip_code:old('zip_code')}}">
		</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
<form action="{{ action('AddressController@destroy',$address->id)   }}" method="POST">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	<input class="button-primary" type="submit" value="Verwijderen">
</form>
@endsection