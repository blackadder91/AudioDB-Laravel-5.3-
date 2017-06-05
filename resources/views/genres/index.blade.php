@extends('layouts.app')

@section('title', 'Genres')

@push('sidebar')
@endpush

@section('content')
    @if(count($genres) > 0)
    <ul class="genre-list">
    @foreach($genres as $genre)
        <li>
            <a href="{{ url('genres', [$genre->id]) }}" title="{{ $genre->title }}">{{ $genre->title }}</a>
        </li>
    @endforeach
    </ul>
    @else
        <p class="note">No data</p>
    @endif
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'genres'))
@endpush
