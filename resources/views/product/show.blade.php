@extends('layouts.default')

@section('content')
<div class="row" id="product">
    <div class="three columns">
        <menu>
            <menuitem>Chocola</menuitem>
            <menuitem class="sub1">->repen</menuitem>
            <menuitem class="sub2">->puur</menuitem>
            <menuitem class="sub2">->melk</menuitem>
            <menuitem class="sub2">->wit</menuitem>
        </menu>
    </div>
	<div class="nine columns" id="oneproduct">
			<H2 id="producttitle">{{$product->name}}</H2>
			<hr>
		<div class="row">
		<form action="{{ action('OrderController@add',$product->id)   }}" method="POST">
			<div class="six columns">
				<img src="/images/{{$product->image_location}}" alt="product plaatje"/>
			</div>
			<div class="six columns" id="productinfo">
				<form action="{{ action('ProductController@store')   }}" method="POST">
				{{ method_field('POST') }}
				{{ csrf_field() }}
					<div id="leftinfo">
						<p>Gram:</p>
						<p>Perstuk:</p>
						@if($product->discount>0)<p>Totaalprijs met korting:</p>@endif
						<p>Aantal:</p>
					</div>
					<div id="rightinfo">
						<p>{{$product->weight}}</p>
						<p>€{{$product->price}} </p>
						@if($product->discount>0)<p>met {{$product->discount}}% korting: €{{round($product->price-( $product->price/100*$product->discount),2)  }}</p>@endif
						<input type="number" name="amount" id="amount" min="0" max="{{$product->storage}}" value="{{(empty(old('aantalproducten')))?(($product->storage>0)?1:0):old('aantalproducten')}}">
					</div>
					<input class="button-primary" type="submit" value="Kopen">
				</form>
			</div>
			<div class="twelf columns" id="productbeschrijving">
			{{$product->description}}
			</div>
			</form>
		</div>
	</div>
</div>
@endsection