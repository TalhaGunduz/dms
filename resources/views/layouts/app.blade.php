<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--begin::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div id="kt_app_root" class="app-root flex-column flex-column-fluid">
        @include('partials.header')
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('partials.sidebar')
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!--begin::Global Javascript Bundle-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Custom Javascript-->
    <script>
        // Initialize Metronic components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize menu
            var menuElement = document.querySelector("#kt_app_sidebar_menu");
            var menu = KTMenu.createInstances(menuElement, {
                hover: true,
                showTimeout: 0,
                hideTimeout: 0,
                submenu: {
                    desktop: "dropdown",
                    tablet: "accordion",
                    mobile: "accordion"
                },
                accordion: {
                    expandAll: false
                }
            });
        });
    </script>
    <!--end::Custom Javascript-->
</body>
</html>
