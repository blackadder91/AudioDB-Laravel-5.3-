@extends('layouts.app')

@section('title', 'Archive')

@push('sidebar')
@endpush

@section('content')
    <article class="entities archive">
        <h1>Archive</h1>
        @if($archive->count() > 0)
        <div data-id="archive" id="archive_listview" data-func="entities-list" class="entities archive view list-view active">
            <table>
                <thead>
                    <tr>
                        <th class="title">Title</th>
                        <th class="label">Disc brand</th>
                        <th class="label">Complete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($archive as $disc)
                    <tr class="item" data-title="{{ $disc->title }}">
                        <td><a href="{{ url('archive', [$disc->id]) }}" title="{{ $disc->title }}">{{ $disc->title }}</a></td>
                        <td>{{ $disc->disc_brand }}</td>
                        <td>{{ ($disc->is_complete) ? "Yes" : "No" }}
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        @else
        <p class="note">No data</p>
        @endif
    </article>
@endsection
@push('actions')
@include('partials.actions.index', array('entity_type' => 'archive'))
@endpush
