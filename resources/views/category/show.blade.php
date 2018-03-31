@extends('layouts.app')

@section('content')
<div class="row" id="product">
    <div class="two columns">
    </div>

	<div class="six columns" id="userinfo">
			<div id="leftinfo">
				<p>Naam:</p>
				<p>Kind van:</p>
				
			</div>
			<div id="rightinfo">
				<p>{{$category->name}}</p>
				<p>{{(empty($category->parent->name))?'--':$category->parent->name}} </p>
			</div>
	</div>
	<div class="six columns">
		<br/>
	</div>
	<div class="row">
		<div class="six columns">
				<button onclick="location.href='{{action('CategoryController@edit',$category->id)}}'" type="button">Aanpassen</button>
		</div>
	</div>
</div>
@endsection