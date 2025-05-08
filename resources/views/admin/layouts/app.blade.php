<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Yönetim Paneli</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    
    <!-- Global Stylesheets Bundle(used by all pages) -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Page Specific CSS -->
    @stack('styles')
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <!-- Sidebar -->
            @include('admin.partials.sidebar')
            
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!-- Header -->
                @include('admin.partials.header')
                
                <!-- Content -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!-- Toolbar -->
                    <div class="toolbar" id="kt_toolbar">
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            @yield('toolbar')
                        </div>
                    </div>
                    
                    <!-- Post -->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                            @include('admin.partials.alerts')
                            @yield('content')
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                @include('admin.partials.footer')
            </div>
        </div>
    </div>

    <!-- Scrolltop -->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
            </svg>
        </span>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    
    <!-- CSRF Token for AJAX requests -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>
</html> 