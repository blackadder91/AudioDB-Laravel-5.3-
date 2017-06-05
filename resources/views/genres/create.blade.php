@extends('layouts.app')

@section('title', 'New genre')

@push('sidebar')
@endpush

@section('content')
<form class="genre-create-form" action="{{ route('genres.store') }}" name="genre-create-form entity-create-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ Request::old('title') }}" />
    </div>
    <div class="input-group with-label">
        <label for="genre">Parent genre</label>
        <select id="genre" name="genre">
            <option value="0">None</option>
            @foreach($genres as $genre)
                <option {{ $genre->id == Request::old('genre_id') ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Create"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'genres'))
@endpush
