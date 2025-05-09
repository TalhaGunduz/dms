@extends('layouts.master')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Öğrenci Düzenle</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Anasayfa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Öğrenci Yönetimi</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.student.index') }}" class="btn btn-sm fw-bold btn-primary">Öğrenci Listesine Dön</a>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body py-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form" action="{{ route('admin.student.update', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">TC Kimlik No</label>
                            <input type="text" name="tc_no" value="{{ old('tc_no', $data->tc_no) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Ad</label>
                            <input type="text" name="name" value="{{ old('name', $data->name) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Soyad</label>
                            <input type="text" name="surname" value="{{ old('surname', $data->surname) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Doğum Tarihi</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $data->birth_date) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Okul</label>
                            <input type="text" name="school" value="{{ old('school', $data->school) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Bölüm</label>
                            <input type="text" name="department" value="{{ old('department', $data->department) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Telefon Numarası</label>
                            <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Email Adresi</label>
                            <input type="email" name="email" value="{{ old('email', $data->email) }}" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-semibold form-label mb-2">Şifre (değiştirmek istemiyorsan boş bırak)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label">Durum</label>
                            <select class="form-select mb-2" name="status" data-control="select2" data-hide-search="true" data-placeholder="Durum seçin" required>
                                <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="passive" {{ $data->status == 'passive' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">
                                <span class="indicator-label">Öğrenci Düzenle</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 