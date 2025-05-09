@extends('layouts.master')

@section('content')
<style>
    body, #kt_content {
        background: #f4f6fa !important;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        background-size: cover;
        background-position: center;
        margin: 0 auto 20px auto;
    }
    .profile-card {
        max-width: 400px;
        width: 100%;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
    }
</style>
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm p-5" style="max-width: 450px; width: 100%; border-radius: 18px;">
        <div class="text-center mb-4">
            <div class="profile-avatar mx-auto mb-3" style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 4px 16px rgba(0,0,0,0.10); background-image: url('{{ Avatar::create($user->name)->toBase64() }}'); background-size: cover; background-position: center;"></div>
        </div>
        <form>
            <div class="mb-4">
                <label class="form-label fw-semibold">Ad Soyad</label>
                <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->name }}" disabled />
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control form-control-lg form-control-solid" value="{{ $user->email }}" disabled />
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Rol</label>
                <input type="text" class="form-control form-control-lg form-control-solid" value="{{ ucfirst($user->role ?? 'Kullanıcı') }}" disabled />
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Durum</label>
                <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->status === 'active' ? 'Aktif' : 'Pasif' }}" disabled />
            </div>
            <div class="mt-5">
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary w-100">Düzenle</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Sidebar'ı gizle
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.app-sidebar');
        if (sidebar) {
            sidebar.style.display = 'none';
        }

        // Avatar yükleme işlemi
        const avatarInput = document.querySelector('input[name="avatar"]');
        if (avatarInput) {
            avatarInput.addEventListener('change', function() {
                this.closest('form').submit();
            });
        }
    });
</script>
@endsection 