@extends('layouts.master')

@section('title', 'Personel Çalışma Programları')

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
                <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="Programlarda Ara..." />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('admin.staff.schedules.create') }}" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    Yeni Program Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="schedules_table">
            <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Personel</th>
                    <th>Gün</th>
                    <th>Başlangıç Saati</th>
                    <th>Bitiş Saati</th>
                    <th>Mola Başlangıç</th>
                    <th>Mola Bitiş</th>
                    <th>Durum</th>
                    <th>Notlar</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->id }}</td>
                    <td>{{ $schedule->staff->name }}</td>
                    <td>
                        @switch($schedule->day_of_week)
                            @case('monday')
                                Pazartesi
                                @break
                            @case('tuesday')
                                Salı
                                @break
                            @case('wednesday')
                                Çarşamba
                                @break
                            @case('thursday')
                                Perşembe
                                @break
                            @case('friday')
                                Cuma
                                @break
                            @case('saturday')
                                Cumartesi
                                @break
                            @case('sunday')
                                Pazar
                                @break
                        @endswitch
                    </td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>{{ $schedule->break_start ?? '-' }}</td>
                    <td>{{ $schedule->break_end ?? '-' }}</td>
                    <td>
                        @if($schedule->status === 'active')
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Pasif</span>
                        @endif
                    </td>
                    <td>{{ $schedule->notes }}</td>
                    <td>@include('admin.staff.component.schedule-button', ['schedule' => $schedule])</td>
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
        $('#schedules_table').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });
    });
</script>
@endpush
