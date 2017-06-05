@include('layouts.partials.header')
            <section class="sidebar-section">
                @section('sidebar')
                    @include('layouts.partials.sidebar')
                @show
            </section>
            <section class="main-section">
                @if($errors->all())
                <div class="error-messages">
                    <h3>Errors</h3>
                    @foreach ($errors->all() as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                </div>
                @endif
                @yield('content')
            </section>
            <div class="clearfix"></div>
        </main>
@include('layouts.partials.footer')
