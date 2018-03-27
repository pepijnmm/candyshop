@extends('layouts.default')

@section('content')
<div class="row" id="product">
    <div class="two columns">
    </div>

	<div class="six columns" id="userinfo">
			<div id="leftinfo">
				<p>Voornaam:</p>
				<p>Tussenvoegsel en achternaam:</p>
				<p>E-mail:</p>
				<p>Telefoonnummer:</p>
				@if($user->role>0)<p>Admin:</p>@endif
				
			</div>
			<div id="rightinfo">
				<p>{{$user->first_name}}</p>
				<p>{{$user->second_name}} </p>
				<p>{{$user->email}} </p>
				<p>{{$user->phone_number}} &nbsp;</p>
				@if(Auth::user()->role>0)<p>{{($user->role>0)?'ja':'nee'}}</p>@endif
			</div>
	</div>
	<div class="six columns">
		<br/>
	</div>
	<div class="row">
		<div class="six columns">
			<button onclick="location.href='{{action('UserController@passwordchange')}}'" type="button">Wachtwoord aanpassen</button>
			<button onclick="location.href='{{action('UserController@useredit')}}'" type="button">Aanpassen</button>
		</div>
	</div>
</div>
@endsection