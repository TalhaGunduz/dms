@extends('layouts.master')

@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-datatable-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Menü Ara..." />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <!--begin::Add menu-->
                    <a href="{{ route('admin.menu.daily.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        Yeni Menü Oluştur
                    </a>
                    <!--end::Add menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-success">Başarılı!</h4>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!--begin::Table-->
            <table id="kt_datatable_daily_menus" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Tarih</th>
                        <th class="min-w-100px">Öğün</th>
                        <th class="min-w-125px">Ana Yemek</th>
                        <th class="min-w-125px">Ara Yemek</th>
                        <th class="min-w-125px">Tatlı</th>
                        <th class="min-w-125px">Salata</th>
                        <th class="min-w-125px">İçecek</th>
                        <th class="min-w-125px">Çorba</th>
                        <th class="min-w-100px">Toplam Kalori</th>
                        <th class="min-w-150px">Notlar</th>
                        <th class="min-w-100px">Durum</th>
                        <th class="min-w-100px text-end">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($dailyMenus as $menu)
                        <tr>
                            <td>{{ $menu->menu_date->format('d.m.Y') }}</td>
                            <td>
                                @switch($menu->meal_type)
                                    @case('breakfast')
                                        <span class="badge badge-light-info">Kahvaltı</span>
                                        @break
                                    @case('lunch')
                                        <span class="badge badge-light-success">Öğle Yemeği</span>
                                        @break
                                    @case('dinner')
                                        <span class="badge badge-light-warning">Akşam Yemeği</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $menu->mainDish->name }}</td>
                            <td>{{ $menu->sideDish->name }}</td>
                            <td>{{ $menu->dessert->name }}</td>
                            <td>{{ $menu->salad->name }}</td>
                            <td>{{ $menu->beverage->name }}</td>
                            <td>{{ $menu->soup->name }}</td>
                            <td>
                                <span class="badge badge-light-primary">
                                    {{ $menu->mainDish->calories + 
                                       $menu->sideDish->calories + 
                                       $menu->dessert->calories + 
                                       $menu->salad->calories + 
                                       $menu->beverage->calories + 
                                       $menu->soup->calories }} kcal
                                </span>
                            </td>
                            <td>{{ Str::limit($menu->notes, 30) }}</td>
                            <td>
                                @if($menu->is_active)
                                    <span class="badge badge-light-success">Aktif</span>
                                @else
                                    <span class="badge badge-light-danger">Pasif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.menu.daily.edit', $menu) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <form action="{{ route('admin.menu.daily.destroy', $menu) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="return confirm('Bu menüyü silmek istediğinizden emin misiniz?')">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-gray-500 fw-semibold fs-6">Henüz günlük menü oluşturulmamış.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!--end::Table-->

            <div class="mt-4">
                {{ $dailyMenus->links() }}
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize datatable
            var table = $('#kt_datatable_daily_menus').DataTable({
                info: false,
                order: [],
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columnDefs: [
                    { orderable: false, targets: 11 }, // Disable ordering for actions column
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json',
                },
            });

            // Search functionality
            $('input[data-kt-datatable-table-filter="search"]').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection 