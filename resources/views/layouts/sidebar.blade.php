<!--begin::Menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Anasayfa</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-profile-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
          l                  </i>
                        </span>
                        <span class="menu-title">Kullanıcı Yönetimi</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.student.*') ? 'active' : '' }}" href="{{ route('admin.student.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-profile-circle fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Öğrenci Yönetimi</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.room.*') ? 'active' : '' }}" href="{{ route('admin.room.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Oda Yönetimi</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.transfer.*') ? 'active' : '' }}" href="{{ route('admin.transfer.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-switch fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Oda Transfer</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!-- Demirbaş Yönetimi -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.assets.*') || request()->routeIs('admin.room-assets.*') || request()->routeIs('admin.maintenance-requests.*') || request()->routeIs('admin.maintenance-logs.*') ? 'active' : '' }}" data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-box fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Demirbaş Yönetimi</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="menu-sub menu-sub-dropdown menu-active-bg py-4 w-225px">
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 {{ request()->routeIs('admin.assets.*') ? 'active' : '' }}" href="{{ route('admin.assets.index') }}">
                                Demirbaşlar
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 {{ request()->routeIs('admin.room-assets.*') ? 'active' : '' }}" href="{{ route('admin.room-assets.index') }}">
                                Oda Demirbaşları
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 {{ request()->routeIs('admin.maintenance-requests.*') ? 'active' : '' }}" href="{{ route('admin.maintenance-requests.index') }}">
                                Bakım Talepleri
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 {{ request()->routeIs('admin.maintenance-logs.*') ? 'active' : '' }}" href="{{ route('admin.maintenance-logs.index') }}">
                                Bakım Geçmişi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::Menu--> 