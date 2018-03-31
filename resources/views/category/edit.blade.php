@extends('layouts.app')

@section('content')
<form action="{{ action('CategoryController@update',$category->id)   }}" method="POST">
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	<div class="six columns">
		<label for="name">Naam</label>
		<input required class="u-full-width" name="name" type="text" value="{{(empty(old('name')))?$category->name:old('name')}}">
	</div>
	<div class="six columns">
	<label for="name">Kind van</label>
		<select name="child_from">
			<option value="0"></option>
	  		@foreach ($categories as $categori)
				<option {{($categori->id == $category->id)?'selected':''}} value="{{$categori->id}}">{{$categori->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="row">
		<input class="button-primary" type="submit" value="Opslaan">
	</div>
</form>
<form action="{{ action('CategoryController@destroy',$category->id)   }}" method="POST">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	<input class="button-primary" type="submit" value="Verwijderen">
</form>
@endsection