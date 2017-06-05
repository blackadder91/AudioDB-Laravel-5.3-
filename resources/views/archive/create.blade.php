@extends('layouts.app')

@section('title', 'New archive disc')

@push('sidebar')
@endpush

@section('content')
<form class="archive-create-form" action="{{ route('archive.store') }}" name="archive-create-form entity-create-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ Request::old('title') }}" />
    </div>
    <div class="input-group with-label with-textarea">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes" rows="10">{{ Request::old('notes') }}</textarea>
    </div>
    <div class="input-group with-label">
        <label for="disc_brand">Disc brand</label>
        <input id="disc_brand" type="text" name="disc_brand" value="{{ Request::old('disc_brand') }}" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Create"/>
    </div>
</form>

@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'archive'))
@endpush
