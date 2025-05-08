<div class="d-flex flex-column min-vh-100">
    @include('partials.header')
    <main class="flex-fill">
        @yield('content')
    </main>
    @include('partials.footer')
</div>
