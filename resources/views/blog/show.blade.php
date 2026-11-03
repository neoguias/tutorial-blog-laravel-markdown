@extends('layouts.blog')
@section('title', $post->title.' · Cuaderno')
@section('description', $post->description)
@section('content')
<article class="article-page">
    <header class="article-header">
        <a class="back-link" href="{{ route('es.blog.index') }}">← Todos los artículos</a>
        <div class="post-meta"><a href="{{ $post->category()?->url() }}">{{ $post->category()?->name }}</a><span>{{ $post->readingTime }} min de lectura</span></div>
        <h1>{{ $post->title }}</h1>
        <p class="article-lead">{{ $post->description }}</p>
        <p class="byline">{{ $post->author()?->name }} <span aria-hidden="true">·</span> <time datetime="{{ $post->date->toDateString() }}">{{ $post->date->translatedFormat('j \d\e F \d\e Y') }}</time></p>
        <img class="article-cover" src="{{ $post->imageUrl() }}" alt="Portada de {{ $post->title }}" width="1200" height="630">
    </header>
    <div class="article-content">{!! $post->html() !!}</div>
    <div class="tags" aria-label="Etiquetas">@foreach($post->tags as $label)<a href="{{ route('es.blog.tag', ['tag' => \Illuminate\Support\Str::slug($label)]) }}">#{{ $label }}</a>@endforeach</div>
    <aside class="author-box"><span class="author-initial">E</span><div><strong>{{ $post->author()?->name }}</strong><p>{{ $post->author()?->bio }}</p></div></aside>
    @if($related)
    <section class="related"><h2>Para seguir leyendo</h2>@foreach($related as $entry)<a href="{{ $entry->url() }}">{{ $entry->title }} <span aria-hidden="true">↗</span></a>@endforeach</section>
    @endif
</article>
@endsection
