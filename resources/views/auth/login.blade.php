@extends('layouts.app')

@section('content')
<div class="container">
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
	{{ csrf_field() }}
  <div class="row">
    <div class="five columns">
      <label for="email">Email</label>
      <input class="u-full-width" type="text" placeholder="email" value="{{ old('email') }}" name="email" required autofocus>
    </div>
    <div class="five columns">
      <label for="password">Wachtwoord</label>
      <input class="u-full-width" type="password" placeholder="Password" name="password">
    </div>
    <div class="two columns">
      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Word onthouden
      <input class="button-primary" type="submit" value="Login">
    </div>
  </div>
</form>
</div>
@endsection
