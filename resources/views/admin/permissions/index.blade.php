@extends('layouts.master')

@section('title', 'Yetkiler')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Yetkiler</h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Yetki
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_permissions_table">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Yetki Adı</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                {{-- Örnek satır --}}
                <tr>
                    <td>1</td>
                    <td>manage_users</td>
                    <td>Kullanıcı yönetimi</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kt_permissions_table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json',
            },
        });
    });
</script>
@endpush 