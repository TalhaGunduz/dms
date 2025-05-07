@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Oda Demirbaşları</h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.room-assets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Demirbaş Atama
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="roomAssetsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Oda</th>
                        <th>Demirbaş</th>
                        <th>Atama Tarihi</th>
                        <th>İade Tarihi</th>
                        <th>Durum</th>
                        <th>Notlar</th>
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
    $('#roomAssetsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.room-assets.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'room.name', name: 'room.name'},
            {data: 'asset.name', name: 'asset.name'},
            {data: 'assigned_date', name: 'assigned_date'},
            {data: 'return_date', name: 'return_date'},
            {data: 'status', name: 'status'},
            {data: 'notes', name: 'notes'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush
@endsection 