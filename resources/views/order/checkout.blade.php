@extends('layouts.default')

@section('content')
<form action="{{ action('OrderController@checkoutstore')   }}" method="POST">
{{ csrf_field() }}
{{ method_field('PUT') }}
    <table>
        <tr>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Korting</th>
            <th>Aantal</th>
        </tr>
        @foreach ($order->products as $product)
            <tr>
                <td><a>{{$product->name}}</a></td>
                <td><a>€{{$product->price}}</a></td>
                <td><a>{{$product->storage}}</a></td>
                <td><a>{{$product->discount}}</a></td>
                <td><a>{{$product->pivot->amount}}</a></td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="six columns">
        <p>Waar moet het worden bezorgt</p>
        <select required name="adress">

                @foreach ($addresses as $address)
                    <option value="{{$address->id}}">{{$address->street_name}} {{$address->house_number}} {{$address->zip_code}}</option>
                @endforeach
        </select></div>
        <div class="six columns">
            <span>Heeft u betaald:</span>
            <input id="checkBox" type="checkbox" name="checkbox">
        </div>
    </div>
    <div class="row  secondrow">
        <div class="six columns ">
        <br>
        </div>
        <div class="six columns ">
            <input class="button-primary" type="submit" value="Afrekennen">
        </div>
        </div>
    </form>
@endsection
