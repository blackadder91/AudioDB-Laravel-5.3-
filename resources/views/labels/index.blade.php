@extends('layouts.app')

@section('title', 'Labels')

@push('sidebar')
@endpush

@section('content')
    @if(count($labels) > 0)
    <ul class="label-list">
    @foreach($labels as $label)
        <li>
            <a href="{{ url('labels', [$label->id]) }}" title="{{ $label->title }}">{{ $label->title }}</a>
        </li>
    @endforeach
    </ul>
    @else
        <p class="note">No data</p>
    @endif
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'labels'))
@endpush
