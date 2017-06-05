@extends('layouts.app')

@section('title', 'New country')

@push('sidebar')
@endpush

@section('content')
<form class="country-create-form" action="{{ route('countries.store') }}" name="country-create-form entity-create-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ Request::old('title') }}" />
    </div>
    <div class="input-group with-label">
        <label for="title_short">Title (short)</label>
        <input id="title_short" type="text" name="title_short" value="{{ Request::old('title_short') }}" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Create"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'countries'))
@endpush
