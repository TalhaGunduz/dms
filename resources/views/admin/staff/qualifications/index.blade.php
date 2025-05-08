@extends('layouts.master')

@section('title', 'Personel Nitelikleri')

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="Niteliklerde Ara..." />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('admin.staff.qualifications.create') }}" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    Yeni Nitelik Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="qualifications_table">
            <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Personel</th>
                    <th>Derece</th>
                    <th>Alan</th>
                    <th>Kurum</th>
                    <th>Mezuniyet Yılı</th>
                    <th>Notlar</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qualifications as $qualification)
                <tr>
                    <td>{{ $qualification->id }}</td>
                    <td>{{ $qualification->staff->name }}</td>
                    <td>{{ $qualification->degree }}</td>
                    <td>{{ $qualification->field_of_study }}</td>
                    <td>{{ $qualification->institution }}</td>
                    <td>{{ $qualification->graduation_year }}</td>
                    <td>{{ $qualification->notes }}</td>
                    <td>
                        <a href="{{ route('admin.staff.qualifications.edit', $qualification->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.staff.qualifications.destroy', $qualification->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="return confirm('Bu niteliği silmek istediğinizden emin misiniz?')">
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
        $('#qualifications_table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });
    });
</script>
@endpush
