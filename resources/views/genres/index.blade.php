@extends('layouts.app')

@section('title', 'Genres')

@push('sidebar')
@endpush

@section('content')
    @if(count($genres) > 0)
    <div class="entity-add-form">
        <form action="{{ route('genres.store') }}" method="post">
            {{ csrf_field() }}
            <input type="text" id="title" name="title" placeholder="Title" />
            <select id="genre" name="genre">
                <option value="-" disabled selected>Select parent genre</option>
                <option value="0">None</option>
                @foreach($genres as $genre)
                    <option {{ $genre->id == Request::old('genre_id') ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->title }}</option>
                @endforeach
            </select>
            <input class="btn" type="submit" name="submit" value="Add" />
        </form>
    </div>
    <hr>
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
