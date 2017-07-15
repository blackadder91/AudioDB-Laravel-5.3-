@extends('layouts.app')

@section('title', 'Recordings')

@push('sidebar')
@include('recordings.sidebar.filter')
@endpush

@section('content')
    <article class="entities recordings">
        @if($recordings->count() > 0)
            @include('partials/recordings/list', ['type' => 'index'])
        @else
        <p class="note">No data</p>
        @endif
    </article>
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'recordings'))
@endpush
