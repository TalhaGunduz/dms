@extends('layouts.master')

@section('content')
<div class="row g-5 g-xl-8 mb-5">
    <div class="col-12">
        <div class="card bg-light-primary mb-5">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                <div class="mb-2 mb-md-0">
                    <h2 class="fw-bold mb-1">Hoşgeldiniz, {{ Auth::user()->name }}!</h2>
                    <div class="text-muted">Sisteme genel bakış ve hızlı aksiyonlar için bu paneli kullanabilirsiniz.</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.student.create') }}" class="btn btn-primary">+ Öğrenci Ekle</a>
                    <a href="{{ route('admin.room.index') }}" class="btn btn-light-primary">Odaları Yönet</a>
                    <a href="{{ route('admin.payment.create') }}" class="btn btn-light-danger">+ Yeni Ödeme</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-5 g-xl-8">
    <div class="col-md-6 col-xl-3">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                <span class="symbol symbol-50px mb-3">
                    <span class="symbol-label bg-light-success">
                        <i class="fa fa-user fs-2x text-success"></i>
                    </span>
                </span>
                <span class="fs-2hx fw-bold text-dark">{{ \App\Models\Student::count() }}</span>
                <div class="text-muted fw-semibold">Toplam Öğrenci</div>
                <span class="badge badge-light-success mt-2">Aktif: {{ \App\Models\Student::where('status', 'active')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                <span class="symbol symbol-50px mb-3">
                    <span class="symbol-label bg-light-info">
                        <i class="fa fa-user-tie fs-2x text-info"></i>
                    </span>
                </span>
                <span class="fs-2hx fw-bold text-dark">{{ \App\Models\Staff::count() }}</span>
                <div class="text-muted fw-semibold">Toplam Personel</div>
                <span class="badge badge-light-info mt-2">Aktif: {{ \App\Models\Staff::where('status', 'active')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                <span class="symbol symbol-50px mb-3">
                    <span class="symbol-label bg-light-warning">
                        <i class="fa fa-home fs-2x text-warning"></i>
                    </span>
                </span>
                <span class="fs-2hx fw-bold text-dark">{{ \App\Models\Room::count() }}</span>
                <div class="text-muted fw-semibold">Toplam Oda</div>
                <span class="badge badge-light-warning mt-2">Kapasite: {{ \App\Models\Room::sum('capacity') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                <span class="symbol symbol-50px mb-3">
                    <span class="symbol-label bg-light-danger">
                        <i class="fa fa-credit-card fs-2x text-danger"></i>
                    </span>
                </span>
                <span class="fs-2hx fw-bold text-dark">{{ \App\Models\Payment::where('status', 'approved')->whereMonth('payment_date', now()->month)->whereYear('payment_date', now()->year)->sum('amount') }} ₺</span>
                <div class="text-muted fw-semibold">Bu Ayki Ödemeler</div>
                <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
                    <span class="badge badge-light-danger mt-2 fs-6 fw-bold">Bekleyen: {{ \App\Models\Payment::where('status', 'pending')->count() }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row g-5 g-xl-8 mt-5">
    <div class="col-xl-8">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-dark">Son Kayıtlar</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-150px rounded-start">Öğrenci</th>
                                <th class="min-w-100px">Oda</th>
                                <th class="min-w-100px">Durum</th>
                                <th class="min-w-100px text-end pe-4 rounded-end">Tarih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Student::with('rooms')->latest()->take(2)->get() as $student)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <span class="symbol symbol-40px me-3">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="fa fa-user fs-2 text-primary"></i>
                                                </span>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $student->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $student->getCurrentRoom()->number ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($student->status == 'active')
                                            <span class="badge badge-light-success">Aktif</span>
                                        @else
                                            <span class="badge badge-light-danger">Pasif</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $student->created_at->format('d.m.Y') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-dark">Hızlı Erişim</h3>
            </div>
            <div class="card-body pt-0 d-flex flex-column gap-3">
                <a href="{{ route('admin.student.create') }}" class="btn btn-light-primary w-100">+ Yeni Öğrenci</a>
                <a href="{{ route('admin.room.index') }}" class="btn btn-light-warning w-100">Odaları Yönet</a>
                <a href="{{ route('admin.payment.create') }}" class="btn btn-light-danger w-100">+ Yeni Ödeme</a>
            </div>
        </div>
    </div>
</div>
<div class="row g-5 g-xl-8 mt-5">
    <div class="col-xl-12">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0">
                <h3 class="card-title fw-bold text-dark">Son Ödemeler</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-150px rounded-start">Öğrenci</th>
                                <th class="min-w-100px">Tutar</th>
                                <th class="min-w-100px">Durum</th>
                                <th class="min-w-100px text-end pe-4 rounded-end">Tarih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Payment::with('student')->latest()->take(3)->get() as $payment)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <span class="symbol symbol-40px me-3">
                                                <span class="symbol-label bg-light-danger">
                                                    <i class="fa fa-user fs-2 text-danger"></i>
                                                </span>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $payment->student->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $payment->amount }} ₺</span>
                                    </td>
                                    <td>
                                        @if($payment->status == 'approved')
                                            <span class="badge badge-light-success">Ödendi</span>
                                        @elseif($payment->status == 'pending')
                                            <span class="badge badge-light-warning">Bekliyor</span>
                                        @else
                                            <span class="badge badge-light-danger">İptal</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="text-dark fw-bold text-hover-primary d-block fs-6">{{ $payment->created_at->format('d.m.Y') }}</span>
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