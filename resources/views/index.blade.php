@extends('layouts.default')

@section('content')
<div class="nine columns" id="oneproduct">
    
	<a href="{{ action('ProductController@show',$products[0]->id)   }}" class="row">
        <div class="six columns">
			<h2 id="producttitle">{{$products[0]->name}}</h2>
			    <hr>
            <img src="images/{{$products[0]->image_location}}" alt="product plaatje"/>
        </div>
	</a>
</div>
@endsection