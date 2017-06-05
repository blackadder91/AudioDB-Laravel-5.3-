@extends('layouts.app')

@section('title', 'Edit archive disc - ' . $entity->title)

@push('sidebar')
@endpush

@section('content')
<form class="archive-update-form" action="{{ route('archive.update', $entity->id) }}" name="archive-create-form entity-create-form" method="POST">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ $entity->title }}" />
    </div>
    <div class="input-group with-label with-textarea">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes" rows="10">{{ $entity->notes }}</textarea>
    </div>
    <div class="input-group with-label">
        <label for="disc_brand">Disc brand</label>
        <input id="disc_brand" type="text" name="disc_brand" value="{{ Request::old('disc_brand') }}" />
    </div>    
    <div class="input-group checkbox">
        <label for="is_complete">Is complete?</label>
        <input id="is_complete" type="checkbox" name="is_complete" {{ ($entity->is_complete) ? "checked" : "" }}/>
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.edit', array('entity_id' => $entity->id, 'entity_type' => 'archive'))
@endpush
