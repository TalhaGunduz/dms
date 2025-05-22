@extends('layouts.app')

@section('content')
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <!--begin::Col-->
    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
        <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <div class="card-title d-flex flex-column">
                    <!--begin::Amount-->
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalApprovedPayments }}</span>
                    <!--end::Amount-->
                    <!--begin::Subtitle-->
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Onaylanmış Ödemeler</span>
                    <!--end::Subtitle-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
        <!--begin::Card widget 7-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #7239EA;background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <div class="card-title d-flex flex-column">
                    <!--begin::Amount-->
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $pendingPaymentsCount }}</span>
                    <!--end::Amount-->
                    <!--begin::Subtitle-->
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Bekleyen Ödemeler</span>
                    <!--end::Subtitle-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
        </div>
        <!--end::Card widget 7-->
    </div>
    <!--end::Col-->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Dashboard scripts
    });
</script>
@endsection 