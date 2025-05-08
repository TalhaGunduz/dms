<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('admin.index') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/default-small.svg') }}" class="h-25px logo" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-home"></i>
                            </span>
                            <span class="menu-title">Ana Sayfa</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-users"></i>
                            </span>
                            <span class="menu-title">Kullanıcı Yönetimi</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/student*') ? 'active' : '' }}" href="{{ route('admin.student.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-user-graduate"></i>
                            </span>
                            <span class="menu-title">Öğrenci Yönetimi</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/room*') ? 'active' : '' }}" href="{{ route('admin.room.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-door-open"></i>
                            </span>
                            <span class="menu-title">Oda Yönetimi</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/transfer*') ? 'active' : '' }}" href="{{ route('admin.transfer.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </span>
                            <span class="menu-title">Transfer Yönetimi</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/staff*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-user-tie"></i>
                            </span>
                            <span class="menu-title">Personel Yönetimi</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('admin/payment*') ? 'active' : '' }}" href="#paymentSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('admin/payment*') ? 'true' : 'false' }}" aria-controls="paymentSubmenu">
                            <span class="menu-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <span class="menu-title">Ödeme Yönetimi</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('admin/payment*') ? 'show' : '' }}" id="paymentSubmenu">
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/payment') ? 'active' : '' }}" href="{{ route('admin.payment.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Ödemeler</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('admin/payment/create') ? 'active' : '' }}" href="{{ route('admin.payment.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Yeni Ödeme</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar--> 