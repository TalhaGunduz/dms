@extends('layouts.master')

@section('title', 'Çalışma Programı Düzenle')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Çalışma Programı Düzenle</h3>
    </div>
    <div class="card-body">
        <form id="kt_schedule_form" action="{{ route('admin.staff.schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="staff_id" class="form-label">Personel</label>
                <select class="form-select @error('staff_id') is-invalid @enderror" id="staff_id" name="staff_id" required>
                    <option value="">Personel Seçin</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}" {{ old('staff_id', $schedule->staff_id) == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('staff_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="day_of_week" class="form-label">Gün</label>
                <select class="form-select @error('day_of_week') is-invalid @enderror" id="day_of_week" name="day_of_week" required>
                    <option value="">Gün Seçin</option>
                    <option value="monday" {{ old('day_of_week', $schedule->day_of_week) === 'monday' ? 'selected' : '' }}>Pazartesi</option>
                    <option value="tuesday" {{ old('day_of_week', $schedule->day_of_week) === 'tuesday' ? 'selected' : '' }}>Salı</option>
                    <option value="wednesday" {{ old('day_of_week', $schedule->day_of_week) === 'wednesday' ? 'selected' : '' }}>Çarşamba</option>
                    <option value="thursday" {{ old('day_of_week', $schedule->day_of_week) === 'thursday' ? 'selected' : '' }}>Perşembe</option>
                    <option value="friday" {{ old('day_of_week', $schedule->day_of_week) === 'friday' ? 'selected' : '' }}>Cuma</option>
                    <option value="saturday" {{ old('day_of_week', $schedule->day_of_week) === 'saturday' ? 'selected' : '' }}>Cumartesi</option>
                    <option value="sunday" {{ old('day_of_week', $schedule->day_of_week) === 'sunday' ? 'selected' : '' }}>Pazar</option>
                </select>
                @error('day_of_week')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Başlangıç Saati</label>
                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Bitiş Saati</label>
                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required>
                @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="break_start" class="form-label">Mola Başlangıç Saati</label>
                <input type="time" class="form-control @error('break_start') is-invalid @enderror" id="break_start" name="break_start" value="{{ old('break_start', $schedule->break_start) }}">
                @error('break_start')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="break_end" class="form-label">Mola Bitiş Saati</label>
                <input type="time" class="form-control @error('break_end') is-invalid @enderror" id="break_end" name="break_end" value="{{ old('break_end', $schedule->break_end) }}">
                @error('break_end')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $schedule->status) === 'inactive' ? 'selected' : '' }}>Pasif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notlar</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $schedule->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('admin.staff.schedules.index') }}" class="btn btn-light me-3">İptal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Güncelle</span>
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
        $('#kt_schedule_form').on('submit', function() {
            $(this).find('button[type="submit"]').attr('data-kt-indicator', 'on');
        });
    });
</script>
@endpush 