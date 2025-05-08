@extends('layouts.master')

@section('title', 'Yeni Devam Kaydı')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Yeni Devam Kaydı</h3>
    </div>
    <div class="card-body">
        <form id="kt_attendance_form" action="{{ route('admin.staff.attendance.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="staff_id" class="form-label">Personel</label>
                <select class="form-select @error('staff_id') is-invalid @enderror" id="staff_id" name="staff_id" required>
                    <option value="">Personel Seçin</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('staff_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Tarih</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="check_in" class="form-label">Giriş Saati</label>
                <input type="time" class="form-control @error('check_in') is-invalid @enderror" id="check_in" name="check_in" value="{{ old('check_in') }}" required>
                @error('check_in')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Çıkış Saati</label>
                <input type="time" class="form-control @error('check_out') is-invalid @enderror" id="check_out" name="check_out" value="{{ old('check_out') }}">
                @error('check_out')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="present" {{ old('status') === 'present' ? 'selected' : '' }}>Mevcut</option>
                    <option value="absent" {{ old('status') === 'absent' ? 'selected' : '' }}>Yok</option>
                    <option value="late" {{ old('status') === 'late' ? 'selected' : '' }}>Geç</option>
                    <option value="on_leave" {{ old('status') === 'on_leave' ? 'selected' : '' }}>İzinli</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notlar</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('admin.staff.attendance.index') }}" class="btn btn-light me-3">İptal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Kaydet</span>
                    <span class="indicator-progress">
                        Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kt_attendance_form').on('submit', function() {
            $(this).find('button[type="submit"]').attr('data-kt-indicator', 'on');
        });
    });
</script>
@endpush 