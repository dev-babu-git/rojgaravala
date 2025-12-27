@extends('front.layout.app')

@section('title', $result->name)

@section('content')
<div class="container py-5">
    
    <h1 class="mb-4 text-center">{{ $result->name }}</h1>

    <div>
        {!! $result->description !!}
    </div>
</div>
@endsection
