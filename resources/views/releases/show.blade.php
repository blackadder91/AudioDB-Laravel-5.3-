@extends('layouts.app')

@section('title', $release->title)

@push('sidebar')
@endpush

@section('content')
    <article class="entity release heading">
        <h1>{{ $release->recording->title }}</h1><small> by <a href="{{ url('artists', $release->artist->id) }}">{{ $release->artist->title}}</a></small>
    </article>
    <hr>
    <article class="entity release">
        <div class="col-layout two-thirds-one-third">
            <div class="row">
                <div class="col recording-info">
                    <p class="meta">
                        <span><strong>Catalog no.: </strong>{{ $release->catalog_no }}</span><br>
                        <span><strong>ISBN.: </strong>{{ $release->isbn }}</span><br><br>
                        <span><strong>Genre: </strong>{{ $release->genre->title }}</span><br>
                        <span><strong>Label: </strong>{{ $release->label->title }}</span><br>
                        <span><strong>Released: </strong>{{ $release->year }}</span><br>
                    </p>
                    @if($release->tracklist || $release->recording->tracklist)
                    <p class="tracklist">
                        <i><strong>Tracklist @if(!$release->tracklist) (general) @endif</strong></i><br>
                        @if($release->tracklist)
                            <?php echo nl2br($release->tracklist) ?>
                        @else
                            <?php echo nl2br($release->recording->tracklist) ?>
                        @endif
                    </p>
                    @endif
                    @if($release->notes)
                    <p class="notes">
                        <i>Notes:</i><br>
                        <small>
                        <?php echo nl2br($release->notes) ?>
                        </small>
                    </p>
                    @endif

                    <p class="in-archive">
                        <span><strong>In archive: </strong>
                        @if($release->archDiscs->count() > 0)
                            @foreach($release->archDiscs as $archDisc)
                                <a href="{{ url('archive', [$archDisc->id]) }}">{{ $archDisc->getShortTitle() }}</a>
                            @endforeach
                        @endif
                    </p>

                </div>
                <div class="col recording-cover">
                    <img src="{{ $release->getMainImageUrl() }}">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </article>
@endsection
@push('actions')
@include('partials.actions.show', array('entity_type' => 'releases', 'entity_id' => $release->id))
@endpush
