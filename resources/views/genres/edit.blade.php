@extends('layouts.app')

@section('title', 'Edit genre - ' . $genre->title)

@push('sidebar')
@endpush

@section('content')
<form class="genre-edit-form" action="{{ route('genres.update', $genre->id ) }}" name="genre-edit-form entity-edit-form" method="post" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ $genre->title }}" />
    </div>
    <div class="input-group with-label">
        <label for="genre">Parent genre</label>
        <select id="genre" name="genre">
            <option value="0">None</option>
            @foreach($genres as $g)
                <option {{ $genre->parent_id == $g->id ? 'selected' : '' }} value="{{ $g->id }}">{{ $g->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.edit', array('entity_id' => $genre->id, 'entity_type' => 'genres'))
@endpush
