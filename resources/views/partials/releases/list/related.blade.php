<div data-id="releases" id="releases_gridview" data-func="entities-grid" class="active entities recordings view grid-view col-4">
    @foreach($releases as $release)
    <div class="item" data-format="{{ $release->format->slug }}" data-title="{{ $release->title }}">
        <div class="inner">
            <div class="heading top">
                <span>{{ $release->format->title_short . ' | ' . $release->label->title_short }}</span>
            </div>
            <div class="heading">
                <a href="{{ url('releases', [$release->id]) }}" title="{{ $release->recording->title }}">{{ $release->recording->title }}</a>
                <time>{{ $release->year }}</time>
            </div>
            <img src="{{ $release->getMainImageUrl() }}">
        </div>
    </div>
    @endforeach
    <div class="clearfix"></div>
</div>
<div data-id="releases" id="releases_listview" data-func="entities-list" class="entities recordings view list-view">
    <table>
        <thead>
            <tr>
                <th class="year">Year</th>
                <th class="catalog-no">Catalog No.</th>
                <th class="format">Format</th>
                <th class="label">Label</th>
                <th class="arch-discs">In archive</th>
            </tr>
        </thead>
        <tbody>
            @foreach($releases as $release)
            <tr class="item" data-title="{{ $release->recording->title }}">
                <td>{{ $release->year }}</td>
                <td><a href="{{ url('releases', [$release->id]) }}" title="{{ $release->catalog_no }}">{{ $release->catalog_no }}</a></td>
                <td>{{ $release->format->title_short }}</td>
                <td>{{ $release->label->title }}</td>
                <td>
                @foreach($release->archDiscs as $archDisc)
                    <a href="{{ url('archive', [$archDisc->id]) }}">{{ $archDisc->getShortTitle() }}</a>
                @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
</div>
