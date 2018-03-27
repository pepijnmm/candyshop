@extends('layouts.default')

@section('content')
<div class="nine columns" id="oneproduct">
    
	<a href="{{ (!empty($products[0]))?action('ProductController@show',$products[0]->id):''   }}" class="row">
        <div class="six columns">
			<h2 id="producttitle">{{ (!empty($products[0]))?$products[0]->name:'' }}</h2>
			    <hr>
            <img src="images/{{ (!empty($products[0]))?$products[0]->image_location:''}}" alt="product plaatje"/>
            <hr>
            <p id="producttitle">{{ (!empty($products[0]))?$products[0]->small_description:'' }}</p>
        </div>
	</a>
</div>
@endsection