<div class="filters" data-target="recordings" data-func="entities-filters">
    <div class="filter" data-field="album-type">
        @foreach($albumTypes as $albumType)
            <span><input type="checkbox" name="album-type" value="{{ $albumType->slug }}" id="{{ $albumType->slug }}"><label for="{{ $albumType->slug }}">{{ $albumType->title }}</label></span>
        @endforeach
    </div>
</div>
