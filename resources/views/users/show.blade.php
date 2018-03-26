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
				<p>{{$user->phone_number}} </p>
				@if($user->role>0)<p>met {{$user->role}}</p>@endif
				<input type="number" id="aantalproducten" min="0" max="{{$user->storage}}" value="{{(empty(old('aantalproducten')))?(($user->storage>0)?1:0):old('aantalproducten')}}">
			</div>
	</div>
</div>
@endsection