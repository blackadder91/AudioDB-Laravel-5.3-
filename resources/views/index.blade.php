@extends('layouts.app')

@section('title', 'Index')

@push('sidebar')
    <li id="widget_index">Index
        <ul>
            <li><a href="#">Custom link #1</a></li>
            <li><a href="#">Custom link #2</a></li>
            <li><a href="#">Custom link #2</a></li>
        </ul>
    </li>
@endpush

@section('content')
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam et dolor rhoncus imperdiet. Sed massa velit, tempor feugiat elit porttitor, blandit vestibulum tortor. Suspendisse congue nulla eget imperdiet finibus. Nulla facilisi. Aliquam varius quis nulla vel auctor. Proin iaculis, velit et interdum porttitor, leo nisi convallis ipsum, scelerisque porttitor est risus non justo. Morbi pharetra libero quis neque dictum porttitor. Aliquam feugiat diam non gravida tincidunt. Nulla in dui a ante condimentum maximus. Vivamus fermentum augue at pulvinar accumsan. Nam pulvinar iaculis tellus non cursus. Donec dictum ullamcorper tempor. Ut luctus felis ut dolor egestas faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras pulvinar pulvinar risus. Aenean sodales sem in pellentesque cursus.</p>
<p>Proin vulputate felis at enim ultrices laoreet. Pellentesque sapien nibh, scelerisque sit amet eros eget, tincidunt maximus sapien. Sed vel interdum orci. Nulla dignissim erat sed ex vulputate tempor. Maecenas pharetra nisl ac urna placerat sodales. Vestibulum venenatis nibh molestie justo pharetra, a cursus augue mattis. Suspendisse scelerisque non arcu nec pharetra. Mauris vulputate ipsum vel varius rutrum. Duis sit amet malesuada tellus. Mauris pharetra consequat dictum. Curabitur convallis arcu eget nibh porta auctor. Proin pellentesque facilisis magna nec aliquam. Mauris nec rutrum eros. Praesent eget lorem lectus.</p>
@endsection

@push('scripts')
{{-- Additional scripts  --}}
@endpush
