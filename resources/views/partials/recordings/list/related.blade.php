<div data-id="recordings" id="recordings_gridview" data-func="entities-grid" data-groups="album-type" class="active entities recordings view grid-view col-4">
    @foreach($recordings as $recording)
    <div class="item" data-album-type="{{ $recording->albumType->slug }}" data-title="{{ $recording->title }}">
        <div class="inner">
            <div class="heading">
                <a href="{{ url('recordings', [$recording->id]) }}" title="{{ $recording->title }}">{{ $recording->title }}</a>
                <time>{{ date("Y", strtotime($recording->year)) }}</time>
            </div>
            <img src="{{ $recording->getMainImageUrl() }}">
        </div>
    </div>
    @endforeach
    <div class="clearfix"></div>
</div>
<div data-id="recordings" id="recordings_listview" data-func="entities-list" class="entities recordings view list-view">
    <table>
        <thead>
            <tr>
                <th class="year">Year</th>
                <th class="title">Title</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recordings as $recording)
            <tr class="item" data-album-type="{{ $recording->albumType->slug }}" data-title="{{ $recording->title }}">
                <td>{{ date("Y", strtotime($recording->year)) }}</td>
                <td><a href="{{ url('recordings', [$recording->id]) }}" title="{{ $recording->title }}">{{ $recording->title }}</a></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
</div>
