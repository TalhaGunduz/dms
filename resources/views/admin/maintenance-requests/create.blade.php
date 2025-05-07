@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Bakım Talebi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.maintenance-requests.store') }}" method="POST">
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
                            <label for="priority">Öncelik</label>
                            <select class="form-control @error('priority') is-invalid @enderror" 
                                id="priority" name="priority" required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Düşük</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Orta</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Yüksek</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Acil</option>
                            </select>
                            @error('priority')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="scheduled_date">Planlanan Tarih</label>
                            <input type="date" class="form-control @error('scheduled_date') is-invalid @enderror" 
                                id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date') }}">
                            @error('scheduled_date')
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
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="{{ route('admin.maintenance-requests.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 