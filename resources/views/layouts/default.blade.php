<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="/css/skeleton.css">
    <link rel="stylesheet" type="text/css" href="/css/removeDefaultBrowser.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/navigationMenu.css">
    <script src="/javascript/jquery.min.js"></script>
    <script src="/javascript/main.js"></script>
    <title>Ye sweet shoppe</title>
</head>
<body>
<div id="empty"></div>
<header class="row">
    <div class="twelf columns">
        <div id="topheader">
            <div id="logo" class="one column">
                <a href="/"><img src="/images/YSS.jpg" alt="Logo"></a>
            </div>
            <div id="searchbox" class="two columns">
                <form>
                    <input type="text" name="search" placeholder="Zoeken">
                    <button type="submit" id="searchId" class="btn btn-success">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <menu id="leftbuttons" class="six columns">
                <menuitem><a href="?page=home">Home</a></menuitem>
                <menuitem><a href="?page=about">About</a></menuitem>
                <menuitem><a href="?page=blog">Blog</a></menuitem>
            </menu>
            <div id="rightbuttons" class="three columns">
                <div id="userhover">
                @if(Auth::guest()) 
                <a href="{{ route('login') }}">
                @endif
                    <i class="fas fa-user" ></i>
                    @if (Auth::guest())
                    </a>
                    @else
                    <div id="usermenu">
                        <ul>
                            <li><a href="#" >instellingen</a></li>
                            <li><a href="#" >orders</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >uitloggen</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            @if(Auth::user()->role == 1)
                                <li><a href="/admin" >adminpanel</a></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
                <a href="{{ action('OrderController@cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
        <nav>
            @foreach(\App\Category::where('child_from', null)->get() as $parent)
            <div class="dropdown">
                <button class="dropbtn">{{$parent->name}}</button>
                <div class="dropdown-content">
                @foreach(\App\Category::where('child_from', $parent->id)->get() as $child)
                    <a href="#">{{$child->name}}</a>
                @endforeach
                </div>
            </div>
            @endforeach
        </nav>
    </div>
</header>
<div class="row" id="main">
    <div class="two columns">&nbsp;</div>
    <div class="eight columns">
        <main id="body" class="row">
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
        </main>
    </div>
    <div class="two columns">&nbsp;</div>
</div>
<footer>
    <div  class="row">
        <div class="two columns">&nbsp;</div>
        <div class="two columns">
            <menu>
                <menuitem><a href="">Chocola</a></menuitem>
                <menuitem><a href="">Wereld snoep</a></menuitem>
            </menu>
        </div>
        <div class="two columns">
            <menu>
                <menuitem><a href="">Chocola</a></menuitem>
                <menuitem><a href="">Wereld snoep</a></menuitem>
            </menu>
        </div>
        <div class="two columns">
            <menu>
                <menuitem><a href="">Chocola</a></menuitem>
                <menuitem><a href="">Wereld snoep</a></menuitem>
            </menu>
        </div>
        <div class="two columns">
            <menu>
                <menuitem><a href="">Chocola</a></menuitem>
                <menuitem><a href="">Wereld snoep</a></menuitem>
            </menu>
        </div>
        <div class="two columns">&nbsp;</div>
    </div>
    <div class="row" id="copyright">
        <p>Copyright 2018</p>
    </div>
</footer>
</body>
</html>