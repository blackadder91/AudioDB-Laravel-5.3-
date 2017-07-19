@extends('layouts.app')

@section('title', 'Edit release - ' . $entity->recording->title)

@push('sidebar')
@endpush

@section('content')
<form class="release-update-form" action="{{ route('releases.update', $entity->id) }}" name="release-create-form entity-create-form" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ $entity->slug }}" disabled />
    </div>
    <div class="input-group with-label">
        <label for="catalog_no">Catalog no.</label>
        <input id="catalog_no" type="text" name="catalog_no" value="{{ $entity->catalog_no }}" />
    </div>
    <div class="input-group with-label">
        <label for="isbn">ISBN</label>
        <input id="isbn" type="text" name="isbn" value="{{ $entity->isbn }}" />
    </div>
    <div class="input-group with-label">
        <label for="year">Year</label>
        <input id="year" type="text" name="year" value="{{ $entity->year }}" >
    </div>
    <div class="input-group with-label">
        <label for="recording">Recording</label>
        <select id="recording" name="recording" disabled>
            <option selected value="{{ $entity->recording->title }}">{{ $entity->recording->title }}</option>
        </select>
    </div>
    <div class="input-group with-label">
        <label for="label">Label</label>
        <select id="label" name="label">
            @foreach($labels as $label)
                <option {{ $label->id == $entity->label_id ? 'selected' : '' }} value="{{ $label->id }}">{{ $label->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="country">Country</label>
        <select id="country" name="country">
            @foreach($countries as $country)
                <option {{ $country->id == $entity->country_id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="format">Format</label>
        <select id="format" name="format">
            @foreach($formats as $format)
                <option {{ $format->id == $entity->format_id ? 'selected' : '' }} value="{{ $format->id }}">{{ $format->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="tracklist">Tracklist</label>
        <textarea id="tracklist" name="tracklist" rows="10">{{ $entity->tracklist }}</textarea>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes" rows="10">{{ $entity->notes }}</textarea>
    </div>
    <div class="input-group checkbox">
        <label for="use_recording_photo">Use recording photo?</label>
        <input id="use_recording_photo" type="checkbox" name="use_recording_photo" {{ ($entity->use_recording_photo) ? "checked" : "" }}/>
    </div>
    <div class="input-group with-label">
        <label for="image_url">Image url</label>
        <input id="image_url" type="text" name="image_url" value="{{ Request::old('image_url') }}" />
    </div>
    <div class="input-group with-label">
        <label for="image">Image</label>
        <input id="image" type="file" name="image" value="{{ Request::old('image') }}" />
    </div>
    <div class="input-group with-label">
        <label for="arch_disc">Archive disc</label>
        <select id="arch_disc" name="arch_disc">
            <option value="0">None</option>
            @foreach($archDiscs as $archDisc)
                <option value="{{ $archDisc->id }}">{{ $archDisc->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="arch_disc_notes">Notes (archive disc)</label>
        <input id="arch_disc_notes" type="text" name="arch_disc_notes" value="" />
    </div>
    <div class="input-group submit">
        <input class="btn" type="submit" name="submit" value="Update"/>
    </div>
</form>
@endsection
@push('actions')
@include('partials.actions.edit', array('entity_id' => $entity->id, 'entity_type' => 'releases'))
@endpush
