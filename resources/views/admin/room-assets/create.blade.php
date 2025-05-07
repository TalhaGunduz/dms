@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Demirbaş Atama</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.room-assets.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="room_id">Oda</label>
                            <select class="form-control @error('room_id') is-invalid @enderror" 
                                id="room_id" name="room_id" required>
                                <option value="">Seçiniz</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} (Blok: {{ $room->block->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asset_id">Demirbaş</label>
                            <select class="form-control @error('asset_id') is-invalid @enderror" 
                                id="asset_id" name="asset_id" required>
                                <option value="">Seçiniz</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                        {{ $asset->name }} ({{ $asset->type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="assigned_date">Atama Tarihi</label>
                            <input type="date" class="form-control @error('assigned_date') is-invalid @enderror" 
                                id="assigned_date" name="assigned_date" value="{{ old('assigned_date', date('Y-m-d')) }}" required>
                            @error('assigned_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="returned" {{ old('status') == 'returned' ? 'selected' : '' }}>İade Edildi</option>
                                <option value="damaged" {{ old('status') == 'damaged' ? 'selected' : '' }}>Hasarlı</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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
                    <a href="{{ route('admin.room-assets.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 