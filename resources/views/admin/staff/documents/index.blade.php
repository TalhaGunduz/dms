@extends('layouts.master')
@section('style')

@endsection

@section('content')
	<!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Personel Belgeleri</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.staff.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Personel Yönetimi</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Belgeler</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.staff.documents.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>Yeni Belge Ekle
                </a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
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
                            <input type="text" data-kt-document-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Belge Ara" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-document-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Filtrele
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Belge Filtreleri</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-document-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Belge Tipi</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Seçiniz" data-allow-clear="true" data-kt-document-table-filter="type" data-hide-search="true">
                                            <option></option>
                                            <option value="CV">CV</option>
                                            <option value="Sözleşme">Sözleşme</option>
                                            <option value="Diğer">Diğer</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-document-table-filter="filter">Uygula</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_document_table">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">ID</th>
                                    <th class="min-w-125px">Personel</th>
                                    <th class="min-w-125px">Belge Tipi</th>
                                    <th class="min-w-125px">Dosya</th>
                                    <th class="min-w-125px">Notlar</th>
                                    <th class="min-w-100px">İşlemler</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($documents as $document)
                                <tr>
                                    <td>{{ $document->id }}</td>
                                    <td>{{ $document->staff->name }}</td>
                                    <td>{{ $document->document_type }}</td>
                                    <td>
                                        @if($document->file_path)
                                            <a href="{{ route('admin.staff.documents.download', $document->id) }}" class="btn btn-sm btn-light-primary">
                                                <i class="ki-duotone ki-document fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>İndir
                                            </a>
                                        @else
                                            <span class="text-muted">Dosya yok</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($document->notes, 50) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.staff.documents.edit', $document->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <form action="{{ route('admin.staff.documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="return confirm('Bu belgeyi silmek istediğinizden emin misiniz?')">
                                                    <i class="ki-duotone ki-trash fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kt_document_table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json'
            },
            order: [[0, 'desc']],
            dom: '<"d-flex justify-content-between align-items-center mb-5"<"d-flex align-items-center"l><"d-flex align-items-center"f>>t<"d-flex justify-content-between align-items-center"ip>',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    });
</script>
@endpush
