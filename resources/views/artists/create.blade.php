@extends('layouts.app')

@section('title', 'New artist')

@push('sidebar')
@endpush

@section('content')
<form class="artist-create-form" action="{{ route('artists.store') }}" name="artist-create-form entity-create-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ Request::old('title') }}" />
    </div>
    <div class="input-group checkbox">
        <label for="is_band">Is band?</label>
        <input id="is_band" type="checkbox" name="is_band"/>
    </div>
    <div class="input-group with-label">
        <label for="dob">Date of birth</label>
        <input id="dob" type="date" name="dob"/ value="{{ Request::old('dob') }}" >
    </div>
    <div class="input-group with-label">
        <label for="dob">Date of birth (text)</label>
        <input id="dob_text" type="text" name="dob_text"/ value="{{ Request::old('dob_text') }}" >
    </div>
    <div class="input-group with-label with-textarea">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="10">{{ Request::old('description') }}</textarea>
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
        <input class="btn" type="submit" name="submit" value="Create"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'artists'))
@endpush
