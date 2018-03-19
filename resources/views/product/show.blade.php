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
						<p>Aantal:</p>
					</div>
					<div id="rightinfo">
						<p>{{$product->weight}}</p>
						<p>€{{$product->price}}</p>
						<select id="aantalproducten">
						@for ($i = 1; $i <= $product->storage; $i++)
							<option>{{$i}}</option>
						@endfor
						</select>
					</div>
					<button type="submit" id="buybutton" class="btn btn-success">Kopen</button>
				</form>
			</div>
			<div class="twelf columns" id="productbeschrijving">
			{{$product->description}}
			</div>
		</div>
	</div>
</div>
@endsection