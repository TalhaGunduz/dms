@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Günlük Menü Düzenle</h3>
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

        <form action="{{ route('admin.menu.daily.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-5">
                <div class="col-md-6">
                    <label class="form-label required">Tarih</label>
                    <input type="date" name="menu_date" class="form-control @error('menu_date') is-invalid @enderror" value="{{ old('menu_date', $menu->menu_date->format('Y-m-d')) }}" required>
                    @error('menu_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label required">Öğün</label>
                    <select name="meal_type" class="form-select @error('meal_type') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        <option value="breakfast" {{ old('meal_type', $menu->meal_type) == 'breakfast' ? 'selected' : '' }}>Kahvaltı</option>
                        <option value="lunch" {{ old('meal_type', $menu->meal_type) == 'lunch' ? 'selected' : '' }}>Öğle Yemeği</option>
                        <option value="dinner" {{ old('meal_type', $menu->meal_type) == 'dinner' ? 'selected' : '' }}>Akşam Yemeği</option>
                    </select>
                    @error('meal_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-6">
                    <label class="form-label required">Ana Yemek</label>
                    <select name="main_dish_id" class="form-select @error('main_dish_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($mainDishes as $dish)
                            <option value="{{ $dish->id }}" {{ old('main_dish_id', $menu->main_dish_id) == $dish->id ? 'selected' : '' }}>
                                {{ $dish->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('main_dish_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label required">Yan Yemek</label>
                    <select name="side_dish_id" class="form-select @error('side_dish_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($sideDishes as $dish)
                            <option value="{{ $dish->id }}" {{ old('side_dish_id', $menu->side_dish_id) == $dish->id ? 'selected' : '' }}>
                                {{ $dish->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('side_dish_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-6">
                    <label class="form-label required">Tatlı</label>
                    <select name="dessert_id" class="form-select @error('dessert_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($desserts as $dessert)
                            <option value="{{ $dessert->id }}" {{ old('dessert_id', $menu->dessert_id) == $dessert->id ? 'selected' : '' }}>
                                {{ $dessert->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('dessert_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label required">Salata</label>
                    <select name="salad_id" class="form-select @error('salad_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($salads as $salad)
                            <option value="{{ $salad->id }}" {{ old('salad_id', $menu->salad_id) == $salad->id ? 'selected' : '' }}>
                                {{ $salad->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('salad_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-6">
                    <label class="form-label required">İçecek</label>
                    <select name="beverage_id" class="form-select @error('beverage_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($beverages as $beverage)
                            <option value="{{ $beverage->id }}" {{ old('beverage_id', $menu->beverage_id) == $beverage->id ? 'selected' : '' }}>
                                {{ $beverage->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('beverage_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label required">Çorba</label>
                    <select name="soup_id" class="form-select @error('soup_id') is-invalid @enderror" required>
                        <option value="">Seçiniz</option>
                        @foreach($soups as $soup)
                            <option value="{{ $soup->id }}" {{ old('soup_id', $menu->soup_id) == $soup->id ? 'selected' : '' }}>
                                {{ $soup->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('soup_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <label class="form-label">Notlar</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $menu->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.menu.daily.index') }}" class="btn btn-light me-3">İptal</a>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
    </div>
</div>
@endsection 