@extends('layouts.app')

@section('title', 'Edit recording - ' . $entity->title)

@push('sidebar')
@endpush

@section('content')
<form class="recording-update-form" action="{{ route('recordings.update', $entity->id) }}" name="recording-create-form entity-create-form" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ $entity->title }}" />
    </div>
    <div class="input-group with-label">
        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ $entity->slug }}" disabled />
    </div>
    <div class="input-group with-label">
        <label for="release_date">Release date</label>
        <input id="release_date" type="date" name="release_date"/ value="{{ $entity->release_date }}" >
    </div>
    <div class="input-group with-label">
        <label for="artist">Artist</label>
        <select id="artist" name="artist">
            @foreach($artists as $artist)
                <option {{ $artist->id == $entity->artist_id ? 'selected' : '' }} value="{{ $artist->id }}">{{ $artist->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="label">Label</label>
        <select id="label" name="label">
            @foreach($labels as $label)
                <option {{ $label->id == $entity->label_id ? 'selected' : '' }} value="{{ $label->id }}">{{ $label->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="album_type">Format</label>
        <select id="album_type" name="album_type">
            @foreach($albumTypes as $albumType)
                <option {{ $albumType->id == $entity->album_type_id ? 'selected' : '' }} value="{{ $albumType->id }}">{{ $albumType->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="genre">Genre</label>
        <select id="genre" name="genre">
            @foreach($genres as $genre)
                <option {{ $genre->id == $entity->genre_id ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="tracklist">Tracklist</label>
        <textarea id="tracklist" name="tracklist" rows="10">{{ $entity->tracklist }}</textarea>
    </div>
    <div class="input-group with-label">
        <label for="image">Image</label>
        <input id="image" type="file" name="image" value="{{ Request::old('image') }}" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.edit', array('entity_id' => $entity->id, 'entity_type' => 'recordings'))
@endpush
