@extends('layouts.app')

@section('title', $artist->title)

@push('sidebar')
@endpush

@section('content')
    <div class="entity-featured" style="background-image: url({{ $artist->getMainImageUrl() }}); background-position: center 40%">
    </div>
    <article class="content">
        <h1>{{ $artist->title }}</h1>
        <ul class="inline sep entity-meta-list">
            @foreach($meta as $metaLabel => $metaValue)
                <li title="{{ $metaLabel }}">{{ $metaValue }}</li>
            @endforeach
        </ul>
        <p>{{ $artist->description }}</p>
        <a class="btn new-related-entity" href="{{ url("recordings/create/artist/{$artist->id}") }}">New recording</a>
    </article>
    <hr>
    <article class="entities recordings">
        <h2>Recordings</h2>
        @include('partials/recordings/list', ['type' => 'related'])
    </article>
@endsection
@push('actions')
@include('partials.actions.show', array('entity_id' => $artist->id, 'entity_type' => 'artists'))
@endpush
