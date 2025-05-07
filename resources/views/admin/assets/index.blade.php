@extends('layouts.master')
@section('style')
<style>
    .asset-status {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: 500;
    }
    .status-available {
        background-color: #E8FFF3;
        color: #50CD89;
    }
    .status-in_use {
        background-color: #FFF8DD;
        color: #FFA800;
    }
    .status-maintenance {
        background-color: #FFF5F8;
        color: #F1416C;
    }
</style>
@endsection

@section('content')
<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Varlık Envanteri</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.assets.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        Yeni Varlık Kaydı
                    </a>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="assetsTable">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>ID</th>
                        <th>Varlık Adı</th>
                        <th>Kategori</th>
                        <th>Seri Numarası</th>
                        <th>Alış Fiyatı</th>
                        <th>Alış Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#assetsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.assets.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'serial_number', name: 'serial_number'},
            {
                data: 'purchase_price',
                name: 'purchase_price',
                render: function(data, type, row) {
                    return new Intl.NumberFormat('tr-TR', {
                        style: 'currency',
                        currency: 'TRY'
                    }).format(data);
                }
            },
            {
                data: 'purchase_date',
                name: 'purchase_date',
                render: function(data) {
                    return moment(data).format('DD/MM/YYYY');
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    let statusClass = '';
                    let statusText = '';
                    
                    switch(data) {
                        case 'available':
                            statusClass = 'status-available';
                            statusText = 'Kullanılabilir';
                            break;
                        case 'in_use':
                            statusClass = 'status-in_use';
                            statusText = 'Kullanımda';
                            break;
                        case 'maintenance':
                            statusClass = 'status-maintenance';
                            statusText = 'Bakımda';
                            break;
                        default:
                            statusClass = '';
                            statusText = data;
                    }
                    
                    return '<span class="asset-status ' + statusClass + '">' + statusText + '</span>';
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <a href="/admin/assets/${row.id}/edit" class="btn btn-icon btn-light-primary btn-sm me-1">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <button class="btn btn-icon btn-light-danger btn-sm delete-asset" data-id="${row.id}">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json'
        }
    });

    // Delete Asset
    $(document).on('click', '.delete-asset', function() {
        var assetId = $(this).data('id');
        
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu varlık kaydını silmek istediğinize emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'İptal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/assets/${assetId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Silindi!',
                            'Varlık kaydı başarıyla silindi.',
                            'success'
                        );
                        $('#assetsTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Hata!',
                            'Bir hata oluştu.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
@endpush 