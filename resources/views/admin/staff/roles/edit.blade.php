@extends('layouts.master')

@section('title', 'Rol Düzenle')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rol Düzenle</h3>
    </div>
    <div class="card-body">
        <form id="kt_role_form" action="{{ route('admin.staff.roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Rol Adı</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Açıklama</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label">İzinler</label>
                <select class="form-select @error('permissions') is-invalid @enderror" id="permissions" name="permissions[]" multiple>
                    <option value="view_staff" {{ in_array('view_staff', $role->permissions ?? []) ? 'selected' : '' }}>Personel Görüntüleme</option>
                    <option value="create_staff" {{ in_array('create_staff', $role->permissions ?? []) ? 'selected' : '' }}>Personel Ekleme</option>
                    <option value="edit_staff" {{ in_array('edit_staff', $role->permissions ?? []) ? 'selected' : '' }}>Personel Düzenleme</option>
                    <option value="delete_staff" {{ in_array('delete_staff', $role->permissions ?? []) ? 'selected' : '' }}>Personel Silme</option>
                    <option value="view_roles" {{ in_array('view_roles', $role->permissions ?? []) ? 'selected' : '' }}>Rol Görüntüleme</option>
                    <option value="create_roles" {{ in_array('create_roles', $role->permissions ?? []) ? 'selected' : '' }}>Rol Ekleme</option>
                    <option value="edit_roles" {{ in_array('edit_roles', $role->permissions ?? []) ? 'selected' : '' }}>Rol Düzenleme</option>
                    <option value="delete_roles" {{ in_array('delete_roles', $role->permissions ?? []) ? 'selected' : '' }}>Rol Silme</option>
                </select>
                @error('permissions')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="active" {{ old('status', $role->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $role->status) === 'inactive' ? 'selected' : '' }}>Pasif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('admin.staff.roles.index') }}" class="btn btn-light me-3">İptal</a>
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
        $('#kt_role_form').on('submit', function() {
            $(this).find('button[type="submit"]').attr('data-kt-indicator', 'on');
        });
    });
</script>
@endpush
