@extends('layouts.master')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Ödeme Listesi</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Ödeme Yönetimi</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Ödemeler</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.payment.create') }}" class="btn btn-sm fw-bold btn-primary">
                <i class="fas fa-plus me-1"></i> Yeni Ödeme
            </a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush shadow-sm mb-10">
            <div class="card-header align-items-center border-0">
                <h3 class="card-title fw-bold">Ödemeler</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Öğrenci</th>
                                <th class="min-w-120px">Ödeme Türü</th>
                                <th class="min-w-120px">Ödeme Kalemi</th>
                                <th class="min-w-100px">Tutar</th>
                                <th class="min-w-120px">Ödeme Tarihi</th>
                                <th class="min-w-120px">Son Ödeme Tarihi</th>
                                <th class="min-w-100px">Durum</th>
                                <th class="text-center min-w-120px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $payment->payer->name }} {{ $payment->payer->surname }}</span>
                                    </td>
                                    <td>{{ $payment->paymentType->name }}</td>
                                    <td>{{ $payment->paymentItem->name }}</td>
                                    <td>{{ number_format($payment->amount, 2) }} ₺</td>
                                    <td>{{ $payment->payment_date ? $payment->payment_date->format('d.m.Y') : '-' }}</td>
                                    <td>{{ $payment->due_date ? $payment->due_date->format('d.m.Y') : '-' }}</td>
                                    <td>
                                        @if($payment->status == 'pending')
                                            <span class="badge badge-light-warning">Beklemede</span>
                                        @elseif($payment->status == 'approved')
                                            <span class="badge badge-light-success">Onaylandı</span>
                                        @else
                                            <span class="badge badge-light-danger">İptal</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fas fa-edit me-1"></i> Düzenle
                                        </a>
                                        <form action="{{ route('admin.payment.destroy', $payment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Emin misiniz?')">
                                                <i class="fas fa-trash me-1"></i> Sil
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 