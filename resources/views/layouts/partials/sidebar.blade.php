<h1>@yield('title')</h1>
<ul>
    <li id="widget_entity_actions">Actions
        <ul>
            @stack('actions')
        </ul>
    </li>
    <!-- <li id="widget_example">Widget example
        <ul>
            <li><a href="#">Custom link #1</a></li>
            <li><a href="#">Custom link #2</a></li>
            <li><a href="#">Custom link #3</a></li>
            <li><a href="#">Custom link #4</a></li>
        </ul>
    </li> -->
    @stack('sidebar')
</ul>
