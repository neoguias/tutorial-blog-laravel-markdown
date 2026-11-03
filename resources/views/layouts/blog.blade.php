<!doctype html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Apuntes sobre desarrollo y escritura. Un lugar para guardar lo aprendido.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" type="application/rss+xml" title="Cuaderno" href="{{ route('es.blog.feed') }}">
    @foreach ($alternates as $language => $alternate)
        <link rel="alternate" hreflang="{{ $language }}" href="{{ $alternate }}">
    @endforeach
    <meta property="og:type" content="{{ isset($post) ? 'article' : 'website' }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'Apuntes sobre desarrollo y escritura.')">
    <meta property="og:url" content="{{ url()->current() }}">
    @isset($post)
        @if($post->imageUrl())<meta property="og:image" content="{{ url($post->imageUrl()) }}">@endif
        <meta property="article:published_time" content="{{ $post->date->toAtomString() }}">
        <meta property="article:modified_time" content="{{ ($post->updated ?? $post->date)->toAtomString() }}">
    @endisset
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('es.blog.index') }}"><span class="brand-mark">c.</span> Cuaderno</a>
        <nav aria-label="Principal"><a href="{{ route('es.blog.index') }}">Artículos</a><a href="{{ route('es.blog.feed') }}">RSS <span aria-hidden="true">↗</span></a></nav>
    </header>
    <main>@yield('content')</main>
    <footer class="site-footer"><a class="brand" href="{{ route('es.blog.index') }}">Cuaderno</a><p>Un lugar para guardar lo aprendido.</p><a href="{{ route('sitemap') }}">Mapa del sitio</a></footer>
</body>
</html>
