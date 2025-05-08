@extends('layouts.master')
@section('style')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni {{ $title }} Ekle</h3>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.menu.food.store', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label required">Ad</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Kalori</label>
                        <input type="number" name="calories" class="form-control @error('calories') is-invalid @enderror" value="{{ old('calories') }}" min="0" max="2000" required>
                        @error('calories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <label class="form-label">Açıklama</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <label class="form-label">Görsel</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_vegetarian" value="1" id="is_vegetarian" {{ old('is_vegetarian') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_vegetarian">Vejetaryen</label>
                        </div>
                    </div>
                </div>

                @if($type === 'beverage')
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_hot" value="1" id="is_hot" {{ old('is_hot') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_hot">Sıcak İçecek</label>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row mb-5">
                    <div class="col-12">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.menu.food.index', ['type' => $type]) }}" class="btn btn-light me-3">İptal</a>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection 