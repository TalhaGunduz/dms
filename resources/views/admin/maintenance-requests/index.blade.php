@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bakım Talepleri</h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.maintenance-requests.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Bakım Talebi
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="maintenanceRequestsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Oda</th>
                        <th>Demirbaş</th>
                        <th>Talep Eden</th>
                        <th>Öncelik</th>
                        <th>Durum</th>
                        <th>Talep Tarihi</th>
                        <th>Planlanan Tarih</th>
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
    $('#maintenanceRequestsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.maintenance-requests.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'room.name', name: 'room.name'},
            {data: 'asset.name', name: 'asset.name'},
            {data: 'requester.name', name: 'requester.name'},
            {data: 'priority', name: 'priority'},
            {data: 'status', name: 'status'},
            {data: 'requested_date', name: 'requested_date'},
            {data: 'scheduled_date', name: 'scheduled_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush
@endsection 