<li id="filter_recordings">Filter
    <ul>
        <form class="entity-filter" method="POST" action="{{ route('releases.filter') }}">
            {{ csrf_field() }}
            <input name="title" type="text" placeholder="Title" value="{{ Request::old('title') }}" />
            <br />
            <input name="artist_title" type="text" placeholder="Artist/Band" value="{{ Request::old('artist_title') }}" />
            <br />
            <select id="format" name="format">
                <option value="" disabled  {{ !Request::old('format') ? 'selected' : '' }} >Select format</option>
                @foreach($formats as $format)
                    <option {{ (Request::old('format') == $format->slug) ? 'selected' : '' }} value="{{ $format->slug }}">{{ $format->title }}</option>
                @endforeach
            </select>
            <br />
            <input class="btn" type="submit" value="Filter" />
            <div class="clearfix"></div>
        </form>
    </ul>
</li>
