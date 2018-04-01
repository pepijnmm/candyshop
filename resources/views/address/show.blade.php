@extends('layouts.usertemplate')

@section('content')
<div class="row" id="category">
    <div class="two columns">
    </div>
	<div class="six columns" id="userinfo">
		<div id="leftinfo">
			<p>Straatnaam:</p>
			<p>Huisnummer:</p>
			<p>Postcode:</p>
			
		</div>
		<div id="rightinfo">
			<p>{{$address->street_name}}</p>
			<p>{{$address->house_number}}</p>
			<p>{{$address->zip_code}}</p>
		</div>
	</div>
	<div class="row">
		<div class="six columns">
				<button onclick="location.href='{{action('AddressController@edit',$address->id)}}'" type="button">Aanpassen</button>
		</div>
	</div>
</div>
@endsection