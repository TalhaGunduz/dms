@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Bakım Kaydı</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.maintenance-logs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maintenance_request_id">Bakım Talebi</label>
                            <select class="form-control @error('maintenance_request_id') is-invalid @enderror" 
                                id="maintenance_request_id" name="maintenance_request_id" required>
                                <option value="">Seçiniz</option>
                                @foreach($maintenanceRequests as $request)
                                    <option value="{{ $request->id }}" {{ old('maintenance_request_id') == $request->id ? 'selected' : '' }}>
                                        Talep #{{ $request->id }} - {{ $request->asset->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('maintenance_request_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="performed_by">Bakım Yapan</label>
                            <select class="form-control @error('performed_by') is-invalid @enderror" 
                                id="performed_by" name="performed_by" required>
                                <option value="">Seçiniz</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('performed_by') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('performed_by')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost">Maliyet</label>
                            <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" 
                                id="cost" name="cost" value="{{ old('cost') }}">
                            @error('cost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Devam Ediyor</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maintenance_date">Bakım Tarihi</label>
                            <input type="date" class="form-control @error('maintenance_date') is-invalid @enderror" 
                                id="maintenance_date" name="maintenance_date" value="{{ old('maintenance_date', date('Y-m-d')) }}" required>
                            @error('maintenance_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes">Notlar</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                        id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="{{ route('admin.maintenance-logs.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 