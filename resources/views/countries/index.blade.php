@extends('layouts.app')

@section('title', 'Countries')

@push('sidebar')
@endpush

@section('content')
    @if(count($countries) > 0)
    <div class="entity-add-form">
        <form action="{{ route('countries.store') }}" method="post">
            {{ csrf_field() }}
            <input type="text" id="title" name="title" placeholder="Title" />
            <input type="text" id="title_short" name="title_short" placeholder="Title (short)" />
            <input class="btn" type="submit" name="submit" value="Add" />
        </form>
    </div>
    <hr>
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
