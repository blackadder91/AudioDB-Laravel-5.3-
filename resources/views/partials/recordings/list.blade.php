@if( !$recordings->count() )
<p>No data</p>
@else
    @include('partials/recordings/list/filter/general')
<div class="view-mode" data-target="recordings" data-func="view-mode">
    <button data-id="grid" class="grid active">
        <i class="material-icons">view_module</i>
    </button>
    <button data-id="list" class="list">
        <i class="material-icons">list</i>
    </button>
</div>
<div class="clearfix"></div>
@endif
@include('partials/recordings/list/'.$type)
