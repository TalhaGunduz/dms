@extends('layouts.master')

@section('title', 'Yeni Personel Belgesi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni Personel Belgesi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.staff.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="staff_id" class="form-label required">Personel</label>
                                    <select name="staff_id" id="staff_id" class="form-select @error('staff_id') is-invalid @enderror" required>
                                        <option value="">Seçiniz</option>
                                        @foreach($staff as $person)
                                            <option value="{{ $person->id }}" {{ old('staff_id') == $person->id ? 'selected' : '' }}>
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
                                    <label for="document_type" class="form-label required">Belge Tipi</label>
                                    <input type="text" name="document_type" id="document_type" class="form-control @error('document_type') is-invalid @enderror" value="{{ old('document_type') }}" required>
                                    @error('document_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label for="file" class="form-label required">Dosya</label>
                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                                    <small class="form-text text-muted">İzin verilen dosya türleri: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimum dosya boyutu: 10MB</small>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label for="notes" class="form-label">Notlar</label>
                                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('admin.staff.documents.index') }}" class="btn btn-light me-3">İptal</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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