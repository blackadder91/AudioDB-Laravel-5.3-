@extends('layouts.app')

@section('title', 'Edit label - ' . $label->title)

@push('sidebar')
@endpush

@section('content')
<form class="label-edit-form" action="{{ route('labels.update', $label->id ) }}" name="label-edit-form entity-edit-form" method="post" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ $label->title }}" />
    </div>
    <div class="input-group with-label">
        <label for="title_short">Title</label>
        <input id="title_short" type="text" name="title_short" value="{{ $label->title_short }}" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.edit', array('entity_id' => $label->id, 'entity_type' => 'labels'))
@endpush
