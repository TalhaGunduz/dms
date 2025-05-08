@extends('layouts.master')
@section('style')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Ödeme</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.payment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payer_id">Öğrenci</label>
                            <select name="payer_id" id="payer_id" class="form-control @error('payer_id') is-invalid @enderror" required>
                                <option value="">Öğrenci Seçiniz</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('payer_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} {{ $student->surname }} ({{ $student->tc_no }})
                                    </option>
                                @endforeach
                            </select>
                            @error('payer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="payer_type" value="App\Models\Student">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_type_id">Ödeme Türü</label>
                            <select name="payment_type_id" id="payment_type_id" class="form-control @error('payment_type_id') is-invalid @enderror" required>
                                <option value="">Seçiniz</option>
                                @foreach($paymentTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('payment_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_item_id">Ödeme Kalemi</label>
                            <select name="payment_item_id" id="payment_item_id" class="form-control @error('payment_item_id') is-invalid @enderror" required>
                                <option value="">Seçiniz</option>
                                @foreach($paymentItems as $item)
                                    <option value="{{ $item->id }}" {{ old('payment_item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_item_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Tutar</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_date">Ödeme Tarihi</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="receipt_number">Dekont Numarası</label>
                            <input type="text" name="receipt_number" id="receipt_number" class="form-control @error('receipt_number') is-invalid @enderror" value="{{ old('receipt_number') }}" required>
                            @error('receipt_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="receipt_image">Dekont Görseli</label>
                            <input type="file" name="receipt_image" id="receipt_image" class="form-control @error('receipt_image') is-invalid @enderror" accept="image/*">
                            @error('receipt_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="notes">Notlar</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group text-end">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Burada gerekirse başka JavaScript kodları eklenebilir
    });
</script>
@endpush 