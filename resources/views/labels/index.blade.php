@extends('layouts.app')

@section('title', 'Labels')

@push('sidebar')
@endpush

@section('content')
    @if(count($labels) > 0)
    <div class="entity-add-form">
        <form action="{{ route('labels.store') }}" method="post">
            {{ csrf_field() }}
            <input type="text" id="title" name="title" placeholder="Title" />
            <input type="text" id="title_short" name="title_short" placeholder="Title (short)" />
            <input class="btn" type="submit" name="submit" value="Add" />
        </form>
    </div>
    <hr>
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
