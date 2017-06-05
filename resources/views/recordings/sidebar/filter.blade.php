<li id="filter_recordings">Filter
    <ul>
        <form class="entity-filter" method="POST" action="{{ route('recordings.filter') }}">
            {{ csrf_field() }}
            <input name="title" type="text" placeholder="Title" value="{{ Request::old('title') }}" />
            <br />
            <input name="artist_title" type="text" placeholder="Artist/Band" value="{{ Request::old('artist_title') }}" />
            <br />
            <select id="album_type" name="album_type">
                <option value="" disabled  {{ !Request::old('album_type') ? 'selected' : '' }} >Select album type</option>
                @foreach($albumTypes as $albumType)
                    <option {{ (Request::old('album_type') == $albumType->slug) ? 'selected' : '' }} value="{{ $albumType->slug }}">{{ $albumType->title }}</option>
                @endforeach
            </select>
            <br />
            <input class="btn" type="submit" value="Filter" />
            <div class="clearfix"></div>
        </form>
    </ul>
</li>
