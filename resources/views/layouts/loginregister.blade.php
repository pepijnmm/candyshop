<html>
  <head>
      <link rel="stylesheet" type="text/css" href="/css/fontawesome-all.min.css">
      <link rel="stylesheet" type="text/css" href="/css/skeleton.css">
      <link rel="stylesheet" type="text/css" href="/css/removeDefaultBrowser.css">
      <link rel="stylesheet" type="text/css" href="/css/main.css">
      <script src="/javascript/jquery.min.js"></script>
      <script src="/javascript/main.js"></script>
      <title>Ye sweet shoppe</title>
  </head>
  <body>
  @if(!empty(Session::get('alert-success')))
            <div class="alert alert-success">{{Session::pull('alert-success')}}</div>
        @endif
        @if(!empty(Session::get('alert-info')))
            <div class="alert alert-info">{{Session::pull('alert-info')}}</div>
        @endif
        @if(!empty(Session::get('alert-warning')))
            <div class="alert alert-warning">{{Session::pull('alert-warning')}}</div>
        @endif
        @if(!empty(Session::get('alert-error')))
            <div class="alert alert-error">{{Session::pull('alert-error')}}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">Errors:
            <ul>
                @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
		@yield('content')
    </form>
    </div>
  </body>
</html>
