<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/skeleton.css">
    <link rel="stylesheet" type="text/css" href="css/removeDefaultBrowser.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/main.js"></script>
    <title>Ye sweet shoppe</title>
</head>
<body>
<div id="empty"></div>
<header class="row">
    <div class="twelf columns">
        <div id="topheader">
            <div id="logo" class="one column">
                <a href=""><img src="images/YSS.jpg" alt="Logo" height="30px" width="auto"></a>
            </div>
            <div id="searchbox" class="four columns">
                <form>
                    <input type="text" name="search" placeholder="Zoeken">
                    <button type="submit" id="searchId" class="btn btn-success">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <menu id="leftbuttons" class="five columns">
                <menuitem><a href="">Home</a></menuitem>
                <menuitem><a href="">About</a></menuitem>
                <menuitem><a href="">Blog</a></menuitem>
            </menu>
            <div id="rightbuttons" class="two columns">
                <a href=""><i class="fas fa-user"></i></a>
                <a href=""><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
        <nav>
            <menu>
                <menuitem><a href="">Chocola</a></menuitem>
                <menuitem><a href="">Wereld snoep</a></menuitem>
            </menu>
        </nav>
    </div>
</header>
<div class="row" id="main">
    <div class="two columns">&nbsp;</div>
    <div class="eight columns">
        <main id="body" class="row">
                <?php
                if(!empty($_GET["page"])&&file_exists($_GET["page"].".php")){
                    require_once $_GET["page"].".php";
                } ?>
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
        <p>Copyright 2017</p>
    </div>
</footer>
</body>
</html>