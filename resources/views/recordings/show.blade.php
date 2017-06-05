@extends('layouts.app')

@section('title', $recording->title)

@push('sidebar')
@endpush

@section('content')
    <article class="entity recording heading">
        <h1>{{ $recording->title }}</h1><small> by <a href="{{ url('artists', $recording->artist->id) }}">{{ $recording->artist->title}}</a></small>
    </article>
    <hr>
    <article class="entity recording">
        <div class="col-layout two-thirds-one-third">
            <div class="row">
                <div class="col recording-info">
                    <p class="meta">
                        <span><strong>Genre: </strong>{{ $recording->genre->title }}</span><br>
                        <span><strong>Label: </strong>{{ $recording->label->title }}</span><br>
                        <span><strong>Released: </strong>{{ $recording->release_date }}</span><br>
                    </p>
                    @if($recording->tracklist)
                    <p class="tracklist">
                        <i><strong>Tracklist</strong></i><br>
                        <?php echo nl2br($recording->tracklist) ?>
                    </p>
                    @endif
                    @if($recording->notes)
                    <p class="notes">
                        <i>Notes:</i><br>
                        <small>
                        <?php echo nl2br($recording->notes) ?>
                        </small>
                    </p>
                    @endif
                </div>
                <div class="col recording-cover">
                    <img src="{{ $recording->getMainImageUrl() }}">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </article>
    <hr>
    <article class="entities releases">
        <h2>Releases</h2>
        @include('partials/releases/list', ['type' => 'general'])
    </article>

@endsection
@push('actions')
@include('partials.actions.show', array('entity_type' => 'recordings', 'entity_id' => $recording->id))
@endpush
