<!DOCTYPE html>
<!--
    Hyperspace by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generic - Hyperspace by HTML5 UP</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}">
    </noscript>
</head>
<body class="is-preload">
    <!-- Header -->
    <header id="header">
        <a href="{{ route('home') }}" class="title">Hyperspace</a>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('generic') }}" class="{{ Request::is('generic') ? 'active' : '' }}">Generic</a></li>
                <li><a href="{{ route('elements') }}" class="{{ Request::is('elements') ? 'active' : '' }}">Elements</a></li>
            </ul>
        </nav>
    </header>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <section id="main" class="wrapper">
            <div class="inner">
                <h1 class="major">A Generic Page</h1>
                <span class="image fit"><img src="{{ asset('images/pic04.jpg') }}" alt=""></span>
                <p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in purus ac, pretium pulvinar mauris. Curabitur sapien risus, commodo eget turpis at, elementum convallis elit. Pellentesque enim turpis, hendrerit tristique.</p>
                <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fersapien risus, commodo eget turpis at, elementum convallis elit. Pellentesque enim turpis, hendrerit tristique lorem ipsum dolor.</p>
            </div>
        </section>
    </div>
    <!-- Footer -->
    <footer id="footer" class="wrapper alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; Untitled. All rights reserved.</li>
                <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollex.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrolly.min.js') }}"></script>
    <script src="{{ asset('assets/js/browser.min.js') }}"></script>
    <script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/util.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>