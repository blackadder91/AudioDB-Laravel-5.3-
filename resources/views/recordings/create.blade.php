@extends('layouts.app')

@section('title', 'New recording')

@push('sidebar')
@endpush

@section('content')
<form class="recording-create-form" action="{{ route('recordings.update', Request::old('id')) }}" name="recording-create-form entity-create-form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ Request::old('title') }}" />
    </div>
    <div class="input-group with-label">
        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ Request::old('slug') }}" />
    </div>
    <div class="input-group with-label">
        <label for="year">Year</label>
        <input id="year" type="text" name="year"/ value="{{ Request::old('year') }}" >
    </div>
    <div class="input-group with-label">
        <label for="artist">Artist</label>
        <select id="artist" name="artist">
            @foreach($artists as $artist)
                <option
                    data-slug="{{ $artist->slug }}" {{ $artist->id == Request::old('artist_id') || $artist->id == $artistRefId ? 'selected' : '' }}
                    value="{{ $artist->id }}">{{ $artist->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="album_type">Format</label>
        <select id="album_type" name="album_type">
            @foreach($albumTypes as $albumType)
                <option {{ $albumType->id == Request::old('album_type_id') ? 'selected' : '' }} value="{{ $albumType->id }}">{{ $albumType->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="genre">Genre</label>
        <select id="genre" name="genre">
            @foreach($genres as $genre)
                <option {{ $genre->id == Request::old('genre_id') ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="tracklist">Tracklist</label>
        <textarea id="tracklist" name="tracklist" rows="10">{{ Request::old('tracklist') }}</textarea>
    </div>
    <div class="input-group with-label">
        <label for="image_url">Image url</label>
        <input id="image_url" type="text" name="image_url" value="{{ Request::old('image_url') }}" />
    </div>
    <div class="input-group with-label">
        <label for="image">Image</label>
        <input id="image" type="file" name="image" value="{{ Request::old('image') }}" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
<script>
    jQuery(document).ready(function($) {
        var entityCreateForm = $('.recording-create-form');
        var slugEl = entityCreateForm.find('input[name="slug"]');
        var detEl = entityCreateForm.find('input[name="title"], select[name="artist"]');
        detEl.change(function() {
            var detStr1 = entityCreateForm.find('input[name="title"]').val().toLowerCase().replace(/ /g, '-');
            var detStr2 = entityCreateForm.find('select[name="artist"] option:selected').data('slug');
            slugEl.val(detStr2 + '-' + detStr1);
        });
    });
</script>
@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'recordings'))
@endpush
