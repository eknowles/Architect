<html>
<head>
    <title>Architect - @yield('title')</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/app.css">

@section('head')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.css">--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.js"></script>--}}
@show

</head>
<body>
    <header id="header">
        <div class="container">
            <ul>
                @section('header')
                    <li class="brand">Your Name Here Architects</li>
                    <li><a href="/">Home</a></li>
                    <li><a href="/projects">Projects</a></li>
                    <li><a href="/practice">Practice</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                @show
            </ul>
        </div>
    </header>
    <section id="body">
@yield('content')
    </section>
    <footer id="footer">
        <div class="container">
            <hr>
            <small><p>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p></small>
        </div>
    </footer>
</body>
</html>