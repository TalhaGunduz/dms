@extends('layouts.master')

@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Yeni Transfer Oluştur</h2>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                <a href="{{ route('admin.transfer.index') }}" class="btn btn-light-primary me-3">
                    <i class="ki-duotone ki-arrow-left fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Geri Dön
                </a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <form id="kt_transfer_form" class="form" action="{{ route('admin.transfer.store') }}" method="POST">
            @csrf
            <!--begin::Scroll-->
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_transfer_scroll" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_transfer_header, #kt_transfer_footer', lg: '#kt_transfer_header, #kt_transfer_footer'}" data-kt-scroll-wrappers="#kt_transfer_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Öğrenci</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="student_id" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-placeholder="Öğrenci Seçin" data-allow-clear="true">
                        <option></option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Eski Oda</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="from_room_id" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-placeholder="Eski Oda Seçin" data-allow-clear="true">
                        <option></option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Yeni Oda</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select name="to_room_id" class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2" data-placeholder="Yeni Oda Seçin" data-allow-clear="true">
                        <option></option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Transfer Tarihi</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="datetime-local" name="transfer_date" class="form-control form-control-solid mb-3 mb-lg-0" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Transfer Sebebi</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea name="reason" class="form-control form-control-solid mb-3 mb-lg-0" rows="3"></textarea>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-10">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Kaydet</span>
                    <span class="indicator-progress">Lütfen bekleyin...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Form validation
        var form = document.getElementById('kt_transfer_form');
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'student_id': {
                        validators: {
                            notEmpty: {
                                message: 'Öğrenci seçimi zorunludur'
                            }
                        }
                    },
                    'from_room_id': {
                        validators: {
                            notEmpty: {
                                message: 'Eski oda seçimi zorunludur'
                            }
                        }
                    },
                    'to_room_id': {
                        validators: {
                            notEmpty: {
                                message: 'Yeni oda seçimi zorunludur'
                            },
                            different: {
                                field: 'from_room_id',
                                message: 'Yeni oda, eski odadan farklı olmalıdır'
                            }
                        }
                    },
                    'transfer_date': {
                        validators: {
                            notEmpty: {
                                message: 'Transfer tarihi zorunludur'
                            }
                        }
                    },
                    'reason': {
                        validators: {
                            notEmpty: {
                                message: 'Transfer sebebi zorunludur'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    form.submit();
                }
            });
        });
    });
</script>
@endpush 