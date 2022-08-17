@extends('layouts.main')

@section('content')

<div class="prose max-w-none">
@include($viewName)
</div>

<div class="bg-sky-200 p-3 mt-4 mb-4">
    <strong>Important!</strong> Remember to subscribe to this fantastic blog!
</div>
@endsection
