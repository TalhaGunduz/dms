@extends('layouts.master')

@section('title', 'Personel Niteliği Düzenle')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Personel Niteliği Düzenle</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.staff.qualifications.update', $qualification->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="staff_id" class="form-label required">Personel</label>
                        <select name="staff_id" id="staff_id" class="form-select @error('staff_id') is-invalid @enderror" required>
                            <option value="">Seçiniz</option>
                            @foreach($staff as $person)
                                <option value="{{ $person->id }}" {{ (old('staff_id', $qualification->staff_id) == $person->id) ? 'selected' : '' }}>
                                    {{ $person->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="degree" class="form-label required">Derece</label>
                        <input type="text" name="degree" id="degree" class="form-control @error('degree') is-invalid @enderror" value="{{ old('degree', $qualification->degree) }}" required>
                        @error('degree')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="field_of_study" class="form-label required">Alan</label>
                        <input type="text" name="field_of_study" id="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" value="{{ old('field_of_study', $qualification->field_of_study) }}" required>
                        @error('field_of_study')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="institution" class="form-label required">Kurum</label>
                        <input type="text" name="institution" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution', $qualification->institution) }}" required>
                        @error('institution')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="graduation_year" class="form-label required">Mezuniyet Yılı</label>
                        <input type="number" name="graduation_year" id="graduation_year" class="form-control @error('graduation_year') is-invalid @enderror" value="{{ old('graduation_year', $qualification->graduation_year) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                        @error('graduation_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-5">
                        <label for="notes" class="form-label">Notlar</label>
                        <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $qualification->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.staff.qualifications.index') }}" class="btn btn-light me-3">İptal</a>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#staff_id').select2({
            placeholder: 'Personel Seçiniz',
            allowClear: true
        });
    });
</script>
@endpush 