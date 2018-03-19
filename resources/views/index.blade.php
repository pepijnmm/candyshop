@extends('layouts.default')

@section('content')
<div class="nine columns" id="oneproduct">
    {{Session::getId()}}
    
	@foreach ($products as $product)
	<a href="{{ action('ProductController@show',$product->id)   }}" class="row">
        <div class="six columns">
			<h2 id="producttitle">{{$product->name}}</h2>
			    <hr>
            <img src="images/{{$product->image_location}}" alt="product plaatje"/>
        </div>
	</a>
	@endforeach
</div>
@endsection