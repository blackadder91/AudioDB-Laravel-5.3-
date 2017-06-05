@extends('layouts.app')

@section('title', $genre->title)

@push('sidebar')
@endpush

@section('content')
    <article class="entities recordings">
        <h1>Recordings</h1>
        @if($recordings->count() > 0)
            @include('partials/recordings/list', ['type' => 'general'])
        @else
        <p class="note">No data</p>
        @endif
    </article>
@endsection
@push('actions')
@include('partials.actions.show', array('entity_id' => $genre->id, 'entity_type' => 'genres'))
@endpush
