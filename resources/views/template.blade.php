<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titre')</title>
    {{ Html::style('css/app.css') }}
    {{  Html::script('js/app.js') }}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{url('/')}}">Translator</a>
                    </div>
                    <li><a href="{{url('/')}}">Translation</a></li>
                    <li><a href="{{url('admin')}}">Administration</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="content">
        @yield('contenu')
    </div>

    <footer>

    </footer>

    @yield('script')
</body>
</html>