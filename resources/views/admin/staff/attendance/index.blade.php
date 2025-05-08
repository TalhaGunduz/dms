@extends('layouts.master')

@section('title', 'Personel Devam Takibi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Personel Devam Takibi</h3>
        <div class="card-toolbar">
            <a href="{{ route('admin.staff.attendance.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Devam Kaydı
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_attendance_table">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Personel</th>
                    <th>Tarih</th>
                    <th>Giriş</th>
                    <th>Çıkış</th>
                    <th>Durum</th>
                    <th>Notlar</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->staff->name }}</td>
                    <td>{{ $attendance->date->format('d.m.Y') }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_out ?? '-' }}</td>
                    <td>
                        @switch($attendance->status)
                            @case('present')
                                <span class="badge badge-light-success">Mevcut</span>
                                @break
                            @case('absent')
                                <span class="badge badge-light-danger">Yok</span>
                                @break
                            @case('late')
                                <span class="badge badge-light-warning">Geç</span>
                                @break
                            @case('on_leave')
                                <span class="badge badge-light-info">İzinli</span>
                                @break
                        @endswitch
                    </td>
                    <td>{{ $attendance->notes }}</td>
                    <td>
                        <a href="{{ route('admin.staff.attendance.edit', $attendance) }}" class="btn btn-sm btn-primary me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.staff.attendance.destroy', $attendance) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bu devam kaydını silmek istediğinizden emin misiniz?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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
        $('#kt_attendance_table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json',
            },
        });
    });
</script>
@endpush
