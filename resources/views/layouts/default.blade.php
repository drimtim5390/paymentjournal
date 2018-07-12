<html>
<head>
    @include('includes.head')
</head>
<body>
<div>

    <header>
        @include('includes.header')
    </header>

    <div style="margin: 30px;">

        @yield('content')

    </div>

    <footer>
        @include('includes.footer')
    </footer>

</div>
    @include('includes.jss')
</body>
</html>