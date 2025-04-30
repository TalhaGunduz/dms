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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $model_text }} Listesi - {{ $student->name }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    
                    <li class="breadcrumb-item text-muted">{{ $model_text }} Yönetimi</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
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
                        <h5>Öğrenci Bilgileri - {{ $student->name }} {{ $student->surname }}</h5>
                    </div>
                </div>
                <!--end::Card header-->
                
                <!--begin::Card body-->
               <!--begin::Card body-->
<!--begin::Card body-->
<div class="card-body py-4">
    <table id="studentInfo" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Alan</th>
                <th>Değer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Adı</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Soyadı</td>
                <td>{{ $student->surname }}</td>
            </tr>
            <tr>
                <td>TC No</td>
                <td>{{ $student->tc_no }}</td>
            </tr>
            <tr>
                <td>E-posta</td>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <td>Doğum Tarihi</td>
                <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Okul</td>
                <td>{{ $student->school }}</td>
            </tr>
            <tr>
                <td>Bölüm</td>
                <td>{{ $student->department }}</td>
            </tr>
            <tr>
                <td>Telefon</td>
                <td>{{ $student->phone }}</td>
            </tr>
            <tr>
                <td>Oda</td>
                <td>{{ $student->room_id ? $student->room->name : 'Bilinmiyor' }}</td>
            </tr>
            <tr>
                <td>Şifre</td>
                <td>{{ $student->password }}</td> <!-- Şifreyi direkt olarak göstereceğiz -->
            </tr>
        </tbody>
    </table>
</div>
<!--end::Card body-->


                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <a href="{{ route('admin.student.index') }}" class="btn btn-primary mt-3">Geri Dön</a>
@endsection




