@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Demirbaş Ekle</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.assets.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Demirbaş Adı</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Tip</label>
                            <select class="form-control @error('type') is-invalid @enderror" 
                                id="type" name="type" required>
                                <option value="">Seçiniz</option>
                                <option value="furniture" {{ old('type') == 'furniture' ? 'selected' : '' }}>Mobilya</option>
                                <option value="electronics" {{ old('type') == 'electronics' ? 'selected' : '' }}>Elektronik</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="serial_number">Seri No</label>
                            <input type="text" class="form-control @error('serial_number') is-invalid @enderror" 
                                id="serial_number" name="serial_number" value="{{ old('serial_number') }}">
                            @error('serial_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purchase_price">Alış Fiyatı</label>
                            <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" 
                                id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}">
                            @error('purchase_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purchase_date">Alış Tarihi</label>
                            <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" 
                                id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}">
                            @error('purchase_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Müsait</option>
                                <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>Kullanımda</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Bakımda</option>
                                <option value="disposed" {{ old('status') == 'disposed' ? 'selected' : '' }}>Hurdaya Ayrıldı</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="{{ route('admin.assets.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 