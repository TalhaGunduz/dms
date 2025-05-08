@extends('layouts.master')

@section('title', 'Yeni Personel Ekle')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">
                Yeni Personel Ekle
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <!--end::Separator-->
                <!--begin::Description-->
                <small class="text-muted fs-7 fw-semibold my-1 ms-1">Personel bilgilerini girin</small>
                <!--end::Description-->
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Personel Bilgileri</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="{{ route('admin.staff.store') }}" method="POST">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Ad Soyad</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Ad Soyad" value="{{ old('name') }}" required />
                            <!--end::Input-->
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">E-posta</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="E-posta" value="{{ old('email') }}" required />
                            <!--end::Input-->
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Telefon</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Telefon" value="{{ old('phone') }}" />
                            <!--end::Input-->
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Adres</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="address" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Adres">{{ old('address') }}</textarea>
                            <!--end::Input-->
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Departman</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="department" class="form-select form-select-solid" required>
                                <option value="">Seçiniz</option>
                                <option value="Yönetim" {{ old('department') == 'Yönetim' ? 'selected' : '' }}>Yönetim</option>
                                <option value="İdari İşler" {{ old('department') == 'İdari İşler' ? 'selected' : '' }}>İdari İşler</option>
                                <option value="Temizlik" {{ old('department') == 'Temizlik' ? 'selected' : '' }}>Temizlik</option>
                                <option value="Güvenlik" {{ old('department') == 'Güvenlik' ? 'selected' : '' }}>Güvenlik</option>
                                <option value="Teknik" {{ old('department') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            </select>
                            <!--end::Input-->
                            @error('department')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Pozisyon</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="position" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pozisyon" value="{{ old('position') }}" required />
                            <!--end::Input-->
                            @error('position')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">İşe Başlama Tarihi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" name="hire_date" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('hire_date') }}" required />
                            <!--end::Input-->
                            @error('hire_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Maaş</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="salary" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Maaş" value="{{ old('salary') }}" required step="0.01" />
                            <!--end::Input-->
                            @error('salary')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Rol</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="role_id" class="form-select form-select-solid" required>
                                <option value="">Seçiniz</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Input-->
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Durum</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="status" class="form-select form-select-solid" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Pasif</option>
                            </select>
                            <!--end::Input-->
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">
                            İptal
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Kaydet
                            </span>
                            <span class="indicator-progress">
                                Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
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
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Form submit
        $('#kt_modal_add_user_form').on('submit', function(e) {
            e.preventDefault();
            
            // Get submit button
            const submitButton = document.querySelector('[data-kt-users-modal-action="submit"]');
            
            // Disable submit button
            submitButton.setAttribute('data-kt-indicator', 'on');
            submitButton.disabled = true;
            
            // Get form data
            const formData = new FormData(this);
            
            // Submit form
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        text: "Personel başarıyla eklendi!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Tamam",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            // Redirect to staff list
                            window.location.href = "{{ route('admin.staff.index') }}";
                        }
                    });
                },
                error: function(xhr) {
                    // Show error message
                    Swal.fire({
                        text: "Bir hata oluştu! Lütfen tüm alanları kontrol ediniz.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Tamam",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    
                    // Enable submit button
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                    
                    // Show validation errors
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            const input = $(`[name="${key}"]`);
                            input.addClass('is-invalid');
                            input.after(`<div class="invalid-feedback">${errors[key][0]}</div>`);
                        }
                    }
                }
            });
        });
        
        // Reset form
        $('[data-kt-users-modal-action="cancel"]').on('click', function() {
            Swal.fire({
                text: "İptal etmek istediğinize emin misiniz?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.staff.index') }}";
                }
            });
        });
    });
</script>
@endsection
