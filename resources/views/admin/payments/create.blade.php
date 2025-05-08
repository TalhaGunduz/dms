@extends('layouts.master')

@section('title', 'Yeni Ödeme')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yeni Ödeme</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="payment_type_id" class="form-label required">Ödeme Türü</label>
                                    <select name="payment_type_id" id="payment_type_id" class="form-select @error('payment_type_id') is-invalid @enderror" required>
                                        <option value="">Seçiniz</option>
                                        @foreach($paymentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="payment_item_id" class="form-label required">Ödeme Kalemi</label>
                                    <select name="payment_item_id" id="payment_item_id" class="form-select @error('payment_item_id') is-invalid @enderror" required>
                                        <option value="">Seçiniz</option>
                                        @foreach($paymentItems as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                <div class="mb-5">
                                    <label for="payer_type" class="form-label required">Ödeyen Tipi</label>
                                    <select name="payer_type" id="payer_type" class="form-select @error('payer_type') is-invalid @enderror" required>
                                        <option value="">Seçiniz</option>
                                        <option value="App\Models\Student">Öğrenci</option>
                                        <option value="App\Models\Staff">Personel</option>
                                    </select>
                                    @error('payer_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="payer_id" class="form-label required">Ödeyen</label>
                                    <select name="payer_id" id="payer_id" class="form-select select2 @error('payer_id') is-invalid @enderror" required>
                                        <option value="">Önce ödeyen tipini seçiniz</option>
                                    </select>
                                    @error('payer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label for="amount" class="form-label required">Tutar</label>
                                    <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label for="payment_date" class="form-label required">Ödeme Tarihi</label>
                                    <input type="date" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" required>
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label for="due_date" class="form-label required">Son Ödeme Tarihi</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="status" class="form-label required">Durum</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="pending">Beklemede</option>
                                        <option value="approved">Onaylandı</option>
                                        <option value="cancelled">İptal Edildi</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label for="notes" class="form-label">Notlar</label>
                                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3"></textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dekont Bilgileri</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label for="receipt_number" class="form-label required">Dekont Numarası</label>
                                            <input type="text" name="receipt_number" id="receipt_number" class="form-control @error('receipt_number') is-invalid @enderror" required>
                                            @error('receipt_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label for="bank_name" class="form-label required">Banka Adı</label>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" required>
                                            @error('bank_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label for="account_number" class="form-label required">Hesap Numarası</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" required>
                                            @error('account_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label for="receipt_date" class="form-label required">Dekont Tarihi</label>
                                            <input type="date" name="receipt_date" id="receipt_date" class="form-control @error('receipt_date') is-invalid @enderror" required>
                                            @error('receipt_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label for="receipt_image" class="form-label">Dekont Görüntüsü</label>
                                            <input type="file" name="receipt_image" id="receipt_image" class="form-control @error('receipt_image') is-invalid @enderror">
                                            <small class="form-text text-muted">İzin verilen dosya türleri: JPG, JPEG, PNG, PDF. Maksimum dosya boyutu: 10MB</small>
                                            @error('receipt_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-light me-3">İptal</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Select2 initialization
    $('.select2').select2({
        placeholder: 'Seçiniz',
        allowClear: true,
        width: '100%'
    });

    // Payer type change event
    $('#payer_type').change(function() {
        var type = $(this).val();
        var $payerSelect = $('#payer_id');
        
        $payerSelect.empty().prop('disabled', true);
        
        if (type) {
            $.ajax({
                url: '/admin/payment/get-payers',
                type: 'GET',
                data: { type: type },
                success: function(data) {
                    $payerSelect.prop('disabled', false);
                    $payerSelect.select2({
                        data: data,
                        placeholder: 'Ödeyen seçiniz',
                        allowClear: true,
                        width: '100%'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching payers:', error);
                }
            });
        }
    });
});
</script>
@endpush 