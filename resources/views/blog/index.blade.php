@extends('layouts.main')

@section('title', 'Lista de entradas')
@section('description', 'Lista de entradas del blog')

@section('content')
    <h1>Lista de entradas</h1>
    <ul class="list-disc list-inside mt-8">
         @foreach ($entries as $entry)
        <li class="block mt-4">
            <a href="{{ route('blog.show', ['slug' => $entry['slug']]) }}" alt="{{ $entry['title'] }}">{{ $entry['title'] }}</a>
        </li>
        @endforeach
    </ul>
@endsection
