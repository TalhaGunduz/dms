<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                data-kt-menu="true">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('admin.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('admin.user.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Kullanıcı İşlemleri</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('admin.student.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Öğrenci İşlemleri</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('admin.room.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Oda İşlemleri</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Varlık Yönetimi</span>
                    </div>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.assets.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-box fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Varlık Envanteri</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.room-assets.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-box fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Oda Varlıkları</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.maintenance-requests.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-box fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Bakım Talepleri</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.maintenance-logs.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-box fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Bakım Geçmişi</span>
                    </a>
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
<!--begin::Footer-->
<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
    <a href="https://preview.keenthemes.com/html/metronic/docs"
        class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
        title="200+ in-house components and 3rd-party plugins">
        <span class="btn-label">Docs & Components</span>
        <i class="ki-duotone ki-document btn-icon fs-2 m-0">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
</div>
<!--end::Footer-->
</div>
<!--end::Sidebar-->
