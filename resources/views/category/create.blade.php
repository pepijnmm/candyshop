@extends('layouts.app')

@section('content')
<form method="POST" action="{{action('CategoryController@store')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ method_field('POST') }}
            {{ csrf_field() }}
	<div class="row">
		<div class="six columns">
		  <label for="name">name</label>
		  <input required class="u-full-width" name="name" type="text" value="{{old('name')}}">
		</div>
		<div class="six columns">
			<label for="name">Kind van</label>
			<select name="child_from">
				<option value="0"></option>
		  		@foreach ($categories as $categori)
				<option value="{{$categori->id}}">{{$categori->name}}</option>
				@endforeach
			</select>
			</div>
		</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
@endsection