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
                            </i>
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

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Ödeme Yönetimi</span>
                    </div>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.payment.*') && !request()->routeIs('admin.payment.create') ? 'active' : '' }}" href="{{ route('admin.payment.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-dollar fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Ödemeler</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.payment.create') ? 'active' : '' }}" href="{{ route('admin.payment.create') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Yeni Ödeme</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Personel Yönetimi</span>
                    </div>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.*') && !request()->routeIs('admin.staff.roles.*') && !request()->routeIs('admin.staff.attendance.*') && !request()->routeIs('admin.staff.schedules.*') && !request()->routeIs('admin.staff.qualifications.*') && !request()->routeIs('admin.staff.documents.*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-profile-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Personel Listesi</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.roles.*') ? 'active' : '' }}" href="{{ route('admin.staff.roles.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-shield-tick fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Roller</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.attendance.*') ? 'active' : '' }}" href="{{ route('admin.staff.attendance.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-calendar-tick fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Devam Takibi</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.schedules.*') ? 'active' : '' }}" href="{{ route('admin.staff.schedules.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-calendar fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Çalışma Programları</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.qualifications.*') ? 'active' : '' }}" href="{{ route('admin.staff.qualifications.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-document fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Yeterlilikler</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.staff.documents.*') ? 'active' : '' }}" href="{{ route('admin.staff.documents.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-folder fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dokümanlar</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}" href="{{ route('admin.menu.dashboard') }}">
                        <span class="menu-icon">
                            <i class="fas fa-utensils fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Menü Yönetimi</span>
                    </a>
                    <div class="menu-sub menu-sub-dropdown">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.daily.*') ? 'active' : '' }}" href="{{ route('admin.menu.daily.index') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-calendar-alt fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Günlük Menüler</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'main_dish' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'main_dish']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-utensils fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Ana Yemekler</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'side_dish' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'side_dish']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-hamburger fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Ara Yemekler</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'dessert' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'dessert']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-ice-cream fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Tatlılar</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'salad' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'salad']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-leaf fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Salatalar</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'beverage' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'beverage']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-glass-martini-alt fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">İçecekler</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.menu.food.*') && request()->type == 'soup' ? 'active' : '' }}" href="{{ route('admin.menu.food.index', ['type' => 'soup']) }}">
                                <span class="menu-icon">
                                    <i class="fas fa-soup fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Çorbalar</span>
                            </a>
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
