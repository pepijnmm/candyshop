@extends('layouts.app')

@section('content')
<div id="gallery">
@foreach ($images as $image)
	<div class="two columns">
		<a href="/images/{{$image}}" target="_blank"><img src="/images/{{$image}}" alt="image"></a>
	</div>
@endforeach
</div>
@endsection