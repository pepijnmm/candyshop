@extends('layouts.default')

@section('content')
    <table>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Korting</th>
        </tr>
        <?php
            $test = $order->load('products');
            var_dump($test);
            die();
            foreach (\App\Order::with('products()')->get() as &$test)
            {
                var_dump($test);
                die();
            }
        ?>
        @foreach ($test as $product)
            <tr>
                <td><a>{{$product->name}}</a></td>
                <td><a>€{{$product->price}}</a></td>
                <td><a>{{$product->storage}}</a></td>
                <td><a>{{$product->discount}}</a></td>
            </tr>
        @endforeach
    </table>
@endsection
