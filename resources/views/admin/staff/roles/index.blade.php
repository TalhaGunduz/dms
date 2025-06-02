@extends('layouts.master')

@section('title', 'Personel Rolleri')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Personel Rolleri</h3>
        <div class="card-toolbar">
            <a href="{{ route('admin.staff.roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Rol Ekle
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_roles_table">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Rol Adı</th>
                    <th>Açıklama</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <span class="badge badge-{{ $role->status === 'active' ? 'light-success' : 'light-danger' }}">
                            {{ $role->status === 'active' ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kt_roles_table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json',
            }
        });
    });
</script>
@endpush
