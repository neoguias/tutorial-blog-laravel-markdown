@extends('layouts.blog')
@section('title', ($category?->name ?? $tag ?? 'Apuntes de desarrollo y escritura').' · Cuaderno')
@section('content')
<section class="intro">
    <p class="eyebrow">EL CUADERNO DE EDU</p>
    <h1>{{ $category?->name ?? $tag ?? 'Ideas, código y un poco de tinta.' }}</h1>
    <p class="intro-lead">{{ $category?->description ?? 'Apuntes sobre desarrollo web, proyectos pequeños y cosas que merece la pena escribir.' }}</p>
</section>
<nav class="category-nav" aria-label="Categorías">
    <a @class(['active' => !$category && !$tag]) href="{{ route('es.blog.index') }}">Todos los artículos</a>
    @foreach ($categories as $item)
        <a @class(['active' => $category?->key === $item->key]) href="{{ $item->url() }}">{{ $item->name }}</a>
    @endforeach
</nav>
<section class="post-grid" aria-label="Artículos">
    @forelse ($posts as $entry)
        <article class="post-card">
            <a class="cover-link" href="{{ $entry->url() }}"><img src="{{ $entry->imageUrl() }}" alt="Portada de {{ $entry->title }}" width="1200" height="630" loading="lazy"></a>
            <div class="card-content">
                <div class="post-meta"><span>{{ $entry->category()?->name }}</span><time datetime="{{ $entry->date->toDateString() }}">{{ $entry->date->translatedFormat('j M Y') }}</time></div>
                <h2><a href="{{ $entry->url() }}">{{ $entry->title }}</a></h2>
                <p>{{ $entry->description }}</p>
                <a class="read-link" href="{{ $entry->url() }}">Leer artículo <span aria-hidden="true">↗</span></a>
            </div>
        </article>
    @empty
        <p>Todavía no hay artículos en esta sección.</p>
    @endforelse
</section>
<div class="pagination">{{ $posts->links() }}</div>
@endsection
