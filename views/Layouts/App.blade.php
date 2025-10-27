<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Мой сайт')</title>
	 @yield('styles')
	  @yield('scripts')
</head>
<body>
    <header>
        <h1>Шапка сайта</h1>
        <nav>
            <a href="/">Home</a> |
            <a href="/about">About</a>
        </nav>
    </header>
    <main>
		123312312
        @yield('content')
    </main>

    <footer>
        <p>© 2025 MySite</p>
    </footer>
</body>
</html>
