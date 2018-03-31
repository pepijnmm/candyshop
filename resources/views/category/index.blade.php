@extends('layouts.app')

@section('content')
<table>
  <tr>
    <th>Naam</th>
    <th>Kind van</th>
  </tr>
  @foreach ($categories as $category)
	<tr>
    <td><a href="{{action('CategoryController@show',$category->id)}}">{{$category->name}}</a></td>
    <td><a href="{{action('CategoryController@show',$category->id)}}">{{(empty($category->parent->name))?'--':$category->parent->name}}</a></td>
  </tr>
  @endforeach
 </table>
			<input class="button-primary" type="button" value="Toevoegen" onclick="location.href='{{ action('CategoryController@create')   }}'">
@endsection