@extends('layouts.master')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Oda Transfer İşlemleri
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Anasayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Oda Transfer</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Öğrenci Transfer Formu</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.transfer.process') }}" method="POST">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">Öğrenci Seçin</label>
                            <select name="student_id" class="form-select" required>
                                <option value="">Öğrenci Seçin</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->name }} {{ $student->surname }} 
                                        @if($student->rooms->isNotEmpty())
                                            (Mevcut Oda: {{ $student->rooms->first()->block->name }} - {{ $student->rooms->first()->number }})
                                        @else
                                            (Oda Atanmamış)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">Yeni Oda Seçin</label>
                            <select name="new_room_id" class="form-select" required>
                                <option value="">Oda Seçin</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $room->isFull() ? 'disabled' : '' }}>
                                        {{ $room->block->name }} - {{ $room->number }} 
                                        (Kapasite: {{ $room->getAvailableCapacity() }}/{{ $room->capacity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-switch fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Transfer Et
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('select[name="student_id"]').select2({
            placeholder: "Öğrenci Seçin",
            allowClear: true
        });

        $('select[name="new_room_id"]').select2({
            placeholder: "Oda Seçin",
            allowClear: true
        });
    });
</script>
@endsection 