@extends('layouts.app')

@section('content')
<div class="row" id="product">
    <div class="one columns">
        <br>
    </div>
	<div class="nine columns" id="oneproduct">
			<H2 id="producttitle">{{$product->name}}</H2>
			<hr>
		<div class="row">

			<div class="six columns">
				<img src="/images/{{$product->image_location}}" alt="product plaatje"/>
			</div>
			<div class="six columns" id="productinfo">
				{{ method_field('POST') }}
				{{ csrf_field() }}
					<div id="leftinfo">
						<p>Gram:</p>
						<p>Perstuk:</p>
						<p>Voorraad:</p>
						<p>Korting:</p>
					</div>
					<div id="rightinfo">
						<p>{{$product->weight}}</p>
						<p>€{{$product->price}} </p>
						<p>{{$product->storage}}</p>
						<p>{{$product->discount}}</p>
						
					</div>
			</div>
			<div class="six columns">
			<p>Kortebeschrijving:</p>
			<div class="twelf columns" id="productbeschrijving">
			{{$product->small_description}}
			</div>
			</div>
			<div class="six columns">
			<p>Beschrijving:</p>
			<div class="twelf columns" id="productbeschrijving">
			{{$product->description}}
			</div>
			</div>
		</div>
		<div class="row">
			<div class="six columns">
					<button onclick="location.href='{{action('ProductController@edit',$product->id)}}'" type="button">Aanpassen</button>
			</div>
		</div>
	</div>
	</div>
</div>
@endsection