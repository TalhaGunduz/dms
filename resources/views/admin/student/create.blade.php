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
                    Öğrenci Yeni Ekle</h1>
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
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <a href="{{ route('admin.student.index') }}" class="btn btn-sm fw-bold btn-primary">Öğrenci Listesine Dön</a>
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
                    <form class="form" action="{{ route('admin.student.store') }}" method="POST">
                        @csrf
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">TC Kimlik No:</label>
                            <!--end::Label-->
                            <input type="text" name="tc_no" value="{{ old('tc_no') }}" id="tc_no" class="form-control" required>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">Ad:</label>
                            <!--end::Label-->
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" required>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">Soyad:</label>
                            <!--end::Label-->
                            <input type="text" name="surname" value="{{ old('surname') }}" id="surname" class="form-control" required>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Doğum Tarihi:</label>
                            <!--end::Label-->
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" id="birth_date" class="form-control">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Okul:</label>
                            <!--end::Label-->
                            <input type="text" name="school" value="{{ old('school') }}" id="school" class="form-control">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Bölüm:</label>
                            <!--end::Label-->
                            <input type="text" name="department" value="{{ old('department') }}" id="department" class="form-control">
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">Telefon Numarası:</label>
                            <!--end::Label-->
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">Email Adresi:</label>
                            <!--end::Label-->
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" required>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold form-label mb-2">Şifre:</label>
                            <!--end::Label-->
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Blok Seç:</label>
                            <!--end::Label-->
                            <select name="block_id" id="block_id" class="form-control" onchange="loadRooms()">
                                <option value="">Blok Seçiniz</option>
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>
                                        {{ $block->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">Oda Seç:</label>
                            <!--end::Label-->
                            <select name="room_id" id="room_id" class="form-control" disabled>
                                <option value="">Önce Blok Seçiniz</option>
                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Öğrenci Yeni Ekle</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
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

    // Oda seçeneklerini yükleme
    function loadRooms() {
        const blockId = document.getElementById('block_id').value;
        const roomSelect = document.getElementById('room_id');
        
        if (!blockId) {
            roomSelect.innerHTML = '<option value="">Önce Blok Seçiniz</option>';
            roomSelect.disabled = true;
            return;
        }

        // Yükleniyor mesajı göster
        roomSelect.innerHTML = '<option value="">Yükleniyor...</option>';
        roomSelect.disabled = true;

        // AJAX ile odaları getir
        $.ajax({
            url: '/admin/room/get-rooms/' + blockId,
            type: 'GET',
            success: function(rooms) {
                roomSelect.innerHTML = '<option value="">Oda Seçiniz</option>';
                
                rooms.forEach(function(room) {
                    const availableCapacity = room.capacity - room.current_students;
                    if (availableCapacity > 0) {
                        roomSelect.innerHTML += `
                            <option value="${room.id}">
                                Oda ${room.number} (Kalan Kapasite: ${availableCapacity})
                            </option>
                        `;
                    }
                });
                
                roomSelect.disabled = false;
            },
            error: function() {
                roomSelect.innerHTML = '<option value="">Hata oluştu</option>';
                roomSelect.disabled = true;
            }
        });
    }
</script>
@endsection