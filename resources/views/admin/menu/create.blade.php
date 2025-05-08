@extends('layouts.master')
@section('style')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Menü Oluştur</h3>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu_date">Tarih</label>
                            <input type="date" name="menu_date" id="menu_date" class="form-control @error('menu_date') is-invalid @enderror" value="{{ old('menu_date', date('Y-m-d')) }}">
                            @error('menu_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meal_type">Öğün</label>
                            <select name="meal_type" id="meal_type" class="form-control @error('meal_type') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                <option value="breakfast" {{ old('meal_type') == 'breakfast' ? 'selected' : '' }}>Kahvaltı</option>
                                <option value="lunch" {{ old('meal_type') == 'lunch' ? 'selected' : '' }}>Öğle Yemeği</option>
                                <option value="dinner" {{ old('meal_type') == 'dinner' ? 'selected' : '' }}>Akşam Yemeği</option>
                            </select>
                            @error('meal_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="main_dish_id">Ana Yemek</label>
                            <select name="main_dish_id" id="main_dish_id" class="form-control @error('main_dish_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($mainDishes as $dish)
                                    <option value="{{ $dish->id }}" {{ old('main_dish_id') == $dish->id ? 'selected' : '' }}>
                                        {{ $dish->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('main_dish_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="side_dish_id">Yan Yemek</label>
                            <select name="side_dish_id" id="side_dish_id" class="form-control @error('side_dish_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($sideDishes as $dish)
                                    <option value="{{ $dish->id }}" {{ old('side_dish_id') == $dish->id ? 'selected' : '' }}>
                                        {{ $dish->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('side_dish_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dessert_id">Tatlı</label>
                            <select name="dessert_id" id="dessert_id" class="form-control @error('dessert_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($desserts as $dessert)
                                    <option value="{{ $dessert->id }}" {{ old('dessert_id') == $dessert->id ? 'selected' : '' }}>
                                        {{ $dessert->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dessert_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salad_id">Salata</label>
                            <select name="salad_id" id="salad_id" class="form-control @error('salad_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($salads as $salad)
                                    <option value="{{ $salad->id }}" {{ old('salad_id') == $salad->id ? 'selected' : '' }}>
                                        {{ $salad->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('salad_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beverage_id">İçecek</label>
                            <select name="beverage_id" id="beverage_id" class="form-control @error('beverage_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($beverages as $beverage)
                                    <option value="{{ $beverage->id }}" {{ old('beverage_id') == $beverage->id ? 'selected' : '' }}>
                                        {{ $beverage->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('beverage_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="soup_id">Çorba</label>
                            <select name="soup_id" id="soup_id" class="form-control @error('soup_id') is-invalid @enderror">
                                <option value="">Seçiniz</option>
                                @foreach($soups as $soup)
                                    <option value="{{ $soup->id }}" {{ old('soup_id') == $soup->id ? 'selected' : '' }}>
                                        {{ $soup->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('soup_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notlar</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
@endsection 