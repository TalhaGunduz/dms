@extends('layouts.master')
@section('style')
<style>
    .food-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 0.475rem;
    }
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ $title }}</h2>
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
            <a href="{{ route('admin.menu.food.create', ['type' => $type]) }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Yeni {{ $title }} Ekle
            </a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-success">Başarılı</h4>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_food">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-50px">Görsel</th>
                        <th class="min-w-125px">Ad</th>
                        <th class="min-w-125px">Açıklama</th>
                        <th class="min-w-70px">Kalori</th>
                        <th class="min-w-100px">Özellikler</th>
                        <th class="min-w-70px">Durum</th>
                        <th class="text-end min-w-100px">İşlemler</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($items as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="food-image">
                                @else
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light-primary text-primary fw-bold">
                                            {{ substr($item->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>{{ $item->calories }}</td>
                            <td>
                                @if($item->is_vegetarian)
                                    <span class="badge badge-light-success">Vejetaryen</span>
                                @endif
                                @if($type === 'beverage' && $item->is_hot)
                                    <span class="badge badge-light-warning">Sıcak</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge badge-light-success">Aktif</span>
                                @else
                                    <span class="badge badge-light-danger">Pasif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.menu.food.edit', ['type' => $type, 'food' => $item->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <form action="{{ route('admin.menu.food.destroy', ['type' => $type, 'food' => $item->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="return confirm('Bu öğeyi silmek istediğinizden emin misiniz?')">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted fw-bold fs-6 py-8">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-document fs-3x text-muted mb-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <span>Henüz {{ $title }} eklenmemiş.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->

        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-10">
            {{ $items->links() }}
        </div>
        <!--end::Pagination-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
@endsection 