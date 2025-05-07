@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bakım Geçmişi</h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.maintenance-logs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Bakım Kaydı
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="maintenanceLogsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bakım Talebi</th>
                        <th>Demirbaş</th>
                        <th>Bakım Yapan</th>
                        <th>Maliyet</th>
                        <th>Durum</th>
                        <th>Bakım Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#maintenanceLogsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.maintenance-logs.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'maintenance_request.id', name: 'maintenance_request.id'},
            {data: 'maintenance_request.asset.name', name: 'maintenance_request.asset.name'},
            {data: 'maintainer.name', name: 'maintainer.name'},
            {data: 'cost', name: 'cost'},
            {data: 'status', name: 'status'},
            {data: 'maintenance_date', name: 'maintenance_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush
@endsection 