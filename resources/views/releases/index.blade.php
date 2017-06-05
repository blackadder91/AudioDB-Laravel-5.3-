@extends('layouts.app')

@section('title', 'Releases')

@push('sidebar')
@include('releases.sidebar.filter')
@endpush

@section('content')
    <article class="entities releases">
        @if($releases->count() > 0)
            @include('partials/releases/list', ['type' => 'index'])
        @else
        <p class="note">No data</p>
        @endif
    </article>
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'releases'))
@endpush
