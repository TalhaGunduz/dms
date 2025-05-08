@extends('layouts.master')
@section('style')
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Transfer Et: {{ $student->name }} {{ $student->surname }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.transfer.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Mevcut Blok</label>
                    <input type="text" class="form-control" value="{{ $student->rooms->isNotEmpty() ? $student->rooms->first()->block->name : 'Atanmamış' }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mevcut Oda</label>
                    <input type="text" class="form-control" value="{{ $student->rooms->isNotEmpty() ? $student->rooms->first()->number : 'Atanmamış' }}" disabled>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label required">Yeni Blok</label>
                    <select name="block_id" id="block_id" class="form-control" required>
                        <option value="">Blok Seçiniz</option>
                        @foreach($blocks as $block)
                            <option value="{{ $block->id }}">{{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label required">Yeni Oda</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        <option value="">Oda Seçiniz</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" data-block="{{ $room->block_id }}">{{ $room->number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Açıklama (Opsiyonel)</label>
                <textarea name="reason" class="form-control" rows="2"></textarea>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.transfer.index') }}" class="btn btn-light me-2">İptal</a>
                <button type="submit" class="btn btn-primary">Transfer Et</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Blok seçimine göre oda listesini filtrele
    document.getElementById('block_id').addEventListener('change', function() {
        var blockId = this.value;
        var roomSelect = document.getElementById('room_id');
        Array.from(roomSelect.options).forEach(function(option) {
            if (!option.value) return;
            option.style.display = option.getAttribute('data-block') == blockId ? '' : 'none';
        });
        roomSelect.value = '';
    });
</script>
@endsection 