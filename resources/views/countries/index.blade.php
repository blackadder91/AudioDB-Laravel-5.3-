@extends('layouts.app')

@section('title', 'Countries')

@push('sidebar')
@endpush

@section('content')
    @if(count($countries) > 0)
    <ul class="country-list">
    @foreach($countries as $country)
        <li>
            <a href="{{ url('countries', [$country->id]) }}" title="{{ $country->title }}">{{ $country->title }}</a>
        </li>
    @endforeach
    </ul>
    @else
        <p class="note">No data</p>
    @endif
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'countries'))
@endpush
