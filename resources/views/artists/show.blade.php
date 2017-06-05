@extends('layouts.app')

@section('title', $artist->title)

@push('sidebar')
@endpush

@section('content')
    <div class="entity-featured" style="background-image: url({{ $artist->getMainImageUrl() }}); background-position: center 40%">
    </div>
    <article class="content">
        <h1>{{ $artist->title }}</h1>
        <p>{{ $artist->description }}</p>
    </article>
    <hr>
    <article class="entities recordings">
        <h2>Recordings</h2>
        @if( !$artist->recordings->count() )
            <p>No data</p>
        @else
            <div class="filters" data-target="recordings" data-func="entities-filters">
                <div class="filter" data-field="album-type">
                    @foreach($albumTypes as $albumType)
                        <span><input type="checkbox" name="album-type" value="{{ $albumType->slug }}" id="{{ $albumType->slug }}"><label for="{{ $albumType->slug }}">{{ $albumType->title }}</label></span>
                    @endforeach
                </div>
            </div>
            <div class="view-mode" data-target="recordings" data-func="view-mode">
                <button data-id="grid" class="grid active">
                    <i class="material-icons">view_module</i>
                </button>
                <button data-id="list" class="list">
                    <i class="material-icons">list</i>
                </button>
            </div>
            <div class="clearfix"></div>
        @endif

        <div data-id="recordings" id="recordings_gridview" data-func="entities-grid" data-groups="album-type" class="active entities recordings view grid-view col-4">
            @foreach($recordings as $recording)
            <div class="item" data-album-type="{{ $recording->albumType->slug }}" data-title="{{ $recording->title }}">
                <div class="inner">
                    <div class="heading">
                        <a href="{{ url('recordings', [$recording->id]) }}" title="{{ $recording->title }}">{{ $recording->title }}</a>
                        <time>{{ date("Y", strtotime($recording->release_date)) }}</time>
                    </div>
                    <img src="{{ $recording->getMainImageUrl() }}">
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <div data-id="recordings" id="recordings_listview" data-func="entities-list" class="entities recordings view list-view">
            <table>
                <thead>
                    <tr>
                        <th class="year">Year</th>
                        <th class="title">Title</th>
                        <th class="label">Label</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($recordings as $recording)
                    <tr class="item" data-album-type="{{ $recording->albumType->slug }}" data-title="{{ $recording->title }}">
                        <td>{{ date("Y", strtotime($recording->release_date)) }}</td>
                        <td><a href="{{ url('recordings', [$recording->id]) }}" title="{{ $recording->title }}">{{ $recording->title }}</a></td>
                        <td>{{ $recording->label->title }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </article>
@endsection
@push('actions')
@include('partials.actions.show', array('entity_id' => $artist->id, 'entity_type' => 'artists'))
@endpush
