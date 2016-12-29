@include('layouts.partials.header')
            <section class="sidebar-section">
                @section('sidebar')
                    @include('layouts.partials.sidebar')
                @show
            </section>
            <section class="main-section">
                @yield('content')
            </section>
            <div class="clearfix"></div>
        </main>
@include('layouts.partials.footer')
