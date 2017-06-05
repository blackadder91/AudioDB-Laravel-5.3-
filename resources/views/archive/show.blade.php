@extends('layouts.app')

@section('title', $disc->title)

@push('sidebar')
@endpush

@section('content')
    <article class="entity archive heading">
        <h1>{{ $disc->title }}</h1>
        <ul class="inline meta-tags">
            <li class="is-complete">
                @if($disc->is_complete)
                    <i title="Complete" class="material-icons complete">check_circle</i>
                @else
                    <i title="In progress" class="material-icons in-progress">info_outline</i>
                @endif
            </li>
            @if($disc->disc_brand)
            <li class="disc-brand">{{ $disc->disc_brand }}</li>
            @endif
            <li class="created-at">{{ date('Y-m-d', $disc->created_at->getTimestamp()) }}</li>
        </ul>
        <section class="notes">
            <small>
                {{ $disc->notes }}
            </small>
        </section>
    </article>
    <hr>
    <article class="entities recordings">
        @include('partials/releases/list', ['type' => 'general'])
    </article>
    

@endsection
@push('actions')
@include('partials.actions.show', array('entity_id' => $disc->id, 'entity_type' => 'archive'))
@endpush
