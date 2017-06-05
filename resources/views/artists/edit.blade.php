@extends('layouts.app')

@section('title', 'Edit artist - ' . $entity->title)

@push('sidebar')
@endpush

@section('content')
<form class="artist-update-form" action="{{ route('artists.update', $entity->id) }}" name="artist-create-form entity-create-form" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ $entity->title }}" />
    </div>
    <div class="input-group checkbox">
        <label for="is_band">Is band?</label>
        <input id="is_band" type="checkbox" name="is_band" {{ ($entity->is_band) ? "checked" : "" }}/>
    </div>
    <div class="input-group with-label">
        <label for="dob">Date of birth</label>
        <input id="dob" type="date" name="dob"/ value="{{ $entity->dob }}" >
    </div>
    <div class="input-group with-label with-textarea">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="10">{{ $entity->description }}</textarea>
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
@include('partials.actions.edit', array('entity_id' => $entity->id, 'entity_type' => 'artists'))
@endpush
