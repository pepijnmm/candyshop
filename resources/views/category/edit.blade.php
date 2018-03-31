@extends('layouts.app')

@section('content')
<form action="{{ action('CategoryController@update',$category->id)   }}" enctype="multipart/form-data" method="POST">
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
				<option {{(!empty($category->parent->id)&&$categori->id == $category->parent->id)?'selected':''}} value="{{$categori->id}}">{{$categori->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="six columns">
	  <label for="image_location">Plaatje(upload of vul naam in)</label>
	  <input name="image" type="file" value="{{(empty(old('image')))?$category->image:old('image')}}">
	  <label for="image_location">locatie(leeg laten bij uploaden)</label>
	  <input class="u-full-width" name="image_location" type="text" value="{{(empty(old('image_location')))?$category->image_location:old('image_location')}}">
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