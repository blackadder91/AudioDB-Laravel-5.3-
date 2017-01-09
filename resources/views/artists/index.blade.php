@extends('layouts.app')

@section('title', 'Artists')

@push('sidebar')
@endpush

@section('content')
    @if(count($artists) > 0)
    <div class="artist-list grid col-3">
    @foreach($artists as $artist_letter => $artist_group)
        <div class="col">
            <h2>{{ $artist_letter }}</h2>
            @foreach($artist_group as $artist)
                <a href="{{ url('artists', [$artist->id]) }}" title="{{ $artist->title }}">{{ $artist->title }}</a>
            @endforeach
        </div>
    @endforeach
        <div class="clearfix"></div>
    </div>
    {{ $artists_raw->links() }}
    @else
        <p class="note">No data</p>
    @endif
@endsection

@push('scripts')
@endpush
