@extends('layouts.app')

@section('title', 'New release')

@push('sidebar')
@endpush

@section('content')
<form class="release-create-form" action="{{ route('releases.update', Request::old('id')) }}" name="release-create-form entity-create-form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="input-group with-label">
        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ Request::old('slug') }}" />
    </div>
    <div class="input-group with-label">
        <label for="catalog_no">Catalog no.</label>
        <input id="catalog_no" type="text" name="catalog_no" value="{{ Request::old('catalog_no') }}" />
    </div>
    <div class="input-group with-label">
        <label for="isbn">ISBN</label>
        <input id="isbn" type="text" name="isbn" value="{{ Request::old('isbn') }}" />
    </div>
    <div class="input-group with-label">
        <label for="year">Release year</label>
        <input id="year" type="text" name="year" value="{{ Request::old('year') }}" >
    </div>
    <div class="input-group with-label">
        <label for="label">Label</label>
        <select id="label" name="label">
            @foreach($labels as $label)
                <option {{ $label->id == Request::old('label_id') ? 'selected' : '' }} value="{{ $label->id }}">{{ $label->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="country">Country</label>
        <select id="country" name="country">
            @foreach($countries as $country)
                <option {{ $country->id == Request::old('label_id') ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="format">Format</label>
        <select id="format" name="format">
            @foreach($formats as $format)
                <option {{ $format->id == Request::old('format_id') ? 'selected' : '' }} value="{{ $format->id }}">{{ $format->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label">
        <label for="recording">Recording</label>
        <select id="recording" name="recording">
            @foreach($recordings as $recording)
                <option data-slug="{{ $recording->slug }}" {{ $recording->id == Request::old('recording_id') ? 'selected' : '' }} value="{{ $recording->id }}">{{ $recording->title . ' (' . $recording->artist->title . ')' }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="tracklist">Tracklist</label>
        <textarea id="tracklist" name="tracklist" rows="10">{{ Request::old('tracklist') }}</textarea>
    </div>
    <div class="input-group with-label with-textarea">
        <label for="notes">Notes</label>
        <textarea id="notes" name="notes" rows="10">{{ Request::old('notes') }}</textarea>
    </div>
    <div class="input-group checkbox">
        <label for="use_recording_photo">Use recording photo?</label>
        <input id="use_recording_photo" type="checkbox" name="use_recording_photo" {{ Request::old('use_recording_photo') ? "checked" : "" }}/>
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
<script>
    jQuery(document).ready(function($) {
        var entityCreateForm = $('.release-create-form');
        var slugEl = entityCreateForm.find('input[name="slug"]');
        var detEl = entityCreateForm.find('input[name="catalog_no"], select[name="recording"]');
        detEl.change(function() {
            var detStr1 = entityCreateForm.find('input[name="catalog_no"]').val().toLowerCase().replace(/ /g, '-');
            var detStr2 = entityCreateForm.find('select[name="recording"] option:selected').data('slug');
            slugEl.val(detStr2 + '-' + detStr1);
        });
    });
</script>
@endsection
@push('actions')
@include('partials.actions.create', array('entity_type' => 'releases'))
@endpush
