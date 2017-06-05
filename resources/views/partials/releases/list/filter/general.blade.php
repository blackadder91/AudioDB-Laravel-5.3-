<div class="filters" data-target="releases" data-func="entities-filters">
    <div class="filter" data-field="format">
        @foreach($formats as $format)
        <span><input type="checkbox" name="format" value="{{ $format->slug }}" id="{{ $format->slug }}"><label for="{{ $format->slug }}">{{ $format->title_short }}</label></span>
        @endforeach
    </div>
</div>
