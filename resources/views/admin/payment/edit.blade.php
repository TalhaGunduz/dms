@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ödeme Düzenle</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_type_id">Ödeme Türü</label>
                            <select name="payment_type_id" id="payment_type_id" class="form-control @error('payment_type_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($paymentTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('payment_type_id', $payment->payment_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_item_id">Ödeme Kalemi</label>
                            <select name="payment_item_id" id="payment_item_id" class="form-control @error('payment_item_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($paymentItems as $item)
                                    <option value="{{ $item->id }}" {{ old('payment_item_id', $payment->payment_item_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_item_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Tutar</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $payment->amount) }}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_date">Ödeme Tarihi</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}">
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due_date">Son Ödeme Tarihi</label>
                            <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', $payment->due_date ? $payment->due_date->format('Y-m-d') : '') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Beklemede</option>
                                <option value="approved" {{ old('status', $payment->status) == 'approved' ? 'selected' : '' }}>Onaylandı</option>
                                <option value="cancelled" {{ old('status', $payment->status) == 'cancelled' ? 'selected' : '' }}>İptal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notlar</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                    <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
@endsection 