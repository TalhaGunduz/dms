@extends('layouts.master')

@section('style')
<!-- Gerekli stil dosyalarını buraya ekleyebilirsiniz -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Öğrenci Detayları</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Anasayfa</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Öğrenci Yönetimi</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">Öğrenci Detayları</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.student.index') }}" class="btn btn-sm fw-bold btn-primary">Öğrenci Listesine Dön</a>
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
                    <div class="card-title">
                        <h2 class="fw-bold">{{ $student->name }} {{ $student->surname }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed gy-5">
                            <tbody class="fs-6 fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-gray-800 fw-bold" style="width: 200px;">TC Kimlik No</td>
                                    <td>{{ $student->tc_no }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Ad</td>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Soyad</td>
                                    <td>{{ $student->surname }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">E-posta</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Doğum Tarihi</td>
                                    <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Okul</td>
                                    <td>{{ $student->school }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Bölüm</td>
                                    <td>{{ $student->department }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Telefon</td>
                                    <td>{{ $student->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Blok</td>
                                    <td>
                                        @if($student->rooms->isNotEmpty())
                                            <span class="badge badge-light-primary fs-6 px-4 py-2">{{ $student->rooms->first()->block->name }} Blok</span>
                                        @else
                                            <span class="badge badge-light-danger fs-6 px-4 py-2">Atanmamış</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Oda</td>
                                    <td>
                                        @if($student->rooms->isNotEmpty())
                                            <span class="badge badge-light-info fs-6 px-4 py-2">{{ $student->rooms->first()->number }} Numaralı Oda</span>
                                        @else
                                            <span class="badge badge-light-danger fs-6 px-4 py-2">Atanmamış</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-800 fw-bold">Durum</td>
                                    <td>
                                        <span class="badge badge-light-{{ $student->status == 'active' ? 'success' : 'danger' }} fs-6 px-4 py-2">
                                            {{ $student->status == 'active' ? 'Aktif' : 'Pasif' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection




