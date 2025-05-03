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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ $model_text }} Yeni Oda Ekle</h1>
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
                    <li class="breadcrumb-item text-muted">{{ $model_text }} Yönetimi</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <a href="{{ route('admin.' . $model . '.index') }}" class="btn btn-sm fw-bold btn-primary">{{ $model_text }} Listesine Dön</a>
                <!--end::Primary button-->
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
                <!--begin::Card body-->
                <div class="card-body py-4">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                <!--begin::Form-->
<form class="form" action="{{ route('admin.' . $model . '.store') }}" method="POST">
    @csrf
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="fs-6 fw-semibold form-label mb-2">{{ $model_text }} Numarası:</label>
        <!--end::Label-->
        <input type="text" name="number" value="{{ old('number') }}" id="number" class="form-control" required>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="required fs-6 fw-semibold form-label mb-2">Kapasite:</label>
        <!--end::Label-->
        <input type="number" name="capacity" value="{{ old('capacity') }}" id="capacity" class="form-control" required>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
<div class="fv-row w-100 flex-md-root">
    <!--begin::Label-->
    <label class="required form-label">Blok</label>
    <!--end::Label-->
    <!--begin::Select2-->
    <select class="form-select mb-2" name="block_id" id="block_id" data-control="select2"
        data-hide-search="true" data-placeholder="Lütfen bir blok seçiniz.">
        <option></option>
        @foreach ($blocks as $block)
            <option value="{{ $block->id }}">{{ $block->name }}</option>
        @endforeach
    </select>
    <!--end::Select2-->
    <!--begin::Description-->
    <div class="text-muted fs-7">Oda için bir blok seçiniz.</div>
    <!--end::Description-->
</div>    
<!--end::Input group-->

    
    <!--begin::Actions-->
    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">{{ $model_text }} Yeni Oda Ekle</span>
        </button>
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
