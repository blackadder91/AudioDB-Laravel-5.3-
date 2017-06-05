<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'AudioDB') }}</title>
    <script src="/js/jquery-3.2.0.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="/css/select2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="page">
        <nav id="side-panel">
            <ul>
                <li class="random"><a href="#">Artist</a><a href="#">Release</a></li>
                <li class="stats"><a href="#"></a></li>
                <li class="log-out"><a href="{{ url('/logout') }}"></a></li>
            </ul>
        </nav>
        <header id="page-header">
            <div class="page-header-inner">
                <div class="site-title"><a href="{{ url('/') }}">AudioDB</a></div>
                <nav class="page-nav">
                    <ul>
                        <li><a href="{{ url('/archive') }}">Archive</a></li>
                        <li><a href="{{ url('/artists') }}">Artists</a></li>
                        <li><a href="{{ url('/recordings') }}">Recordings</a></li>
                        <li><a href="{{ url('/releases') }}">Releases</a></li>
                        <li><a href="#">Other</a>
                            <ul class="sub-menu">
                                <li><a href="{{ url('/countries') }}">Countries</a></li>
                                <li><a href="{{ url('/genres') }}">Genres</a></li>
                                <li><a href="{{ url('/labels') }}">Labels</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <form action="{{ url('/search') }}">
                        <input type="text" placeholder="SEARCH">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                        <defs>
                        </defs>
                        <g>
                            <g>
                                <path fill="#A1A1A1" d="M5.8,11.7c-1.6,0-3-0.6-4.1-1.7S0,7.4,0,5.8s0.6-3,1.7-4.1C2.8,0.6,4.3,0,5.8,0s3,0.6,4.1,1.7    c2.3,2.3,2.3,6,0,8.3C8.9,11.1,7.4,11.7,5.8,11.7z M5.8,1C4.5,1,3.3,1.5,2.4,2.4C1.5,3.3,1,4.5,1,5.8s0.5,2.5,1.4,3.4    c0.9,0.9,2.1,1.4,3.4,1.4s2.5-0.5,3.4-1.4c1.9-1.9,1.9-5,0-6.9C8.4,1.5,7.1,1,5.8,1z" />
                            </g>
                            <g>
                                <path fill="#A1A1A1" d="M15.5,16c-0.1,0-0.3,0-0.3-0.1L9.3,10c-0.2-0.2-0.2-0.5,0-0.7s0.5-0.2,0.7,0l5.9,5.9    c0.2,0.2,0.2,0.5,0,0.7C15.8,16,15.6,16,15.5,16z" />
                            </g>
                        </g>
                        </svg>
                    </form>
                </div>
            </div>
        </header>
        <div class="page-bg"></div>
        <main id="page-main" class="page-container">
