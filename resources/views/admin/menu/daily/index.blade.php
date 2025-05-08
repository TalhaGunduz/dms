@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Günlük Menüler</h3>
        <div class="card-toolbar">
            <a href="{{ route('admin.menu.daily.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Menü Oluştur
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                <thead>
                    <tr class="fw-bold text-muted">
                        <th>Tarih</th>
                        <th>Öğün</th>
                        <th>Ana Yemek</th>
                        <th>Ara Yemek</th>
                        <th>Tatlı</th>
                        <th>Salata</th>
                        <th>İçecek</th>
                        <th>Çorba</th>
                        <th>Toplam Kalori</th>
                        <th>Notlar</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailyMenus as $menu)
                        <tr>
                            <td>{{ $menu->menu_date->format('d.m.Y') }}</td>
                            <td>
                                @switch($menu->meal_type)
                                    @case('breakfast')
                                        <span class="badge badge-info">Kahvaltı</span>
                                        @break
                                    @case('lunch')
                                        <span class="badge badge-success">Öğle Yemeği</span>
                                        @break
                                    @case('dinner')
                                        <span class="badge badge-warning">Akşam Yemeği</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $menu->mainDish->name }}</td>
                            <td>{{ $menu->sideDish->name }}</td>
                            <td>{{ $menu->dessert->name }}</td>
                            <td>{{ $menu->salad->name }}</td>
                            <td>{{ $menu->beverage->name }}</td>
                            <td>{{ $menu->soup->name }}</td>
                            <td>
                                {{ $menu->mainDish->calories + 
                                   $menu->sideDish->calories + 
                                   $menu->dessert->calories + 
                                   $menu->salad->calories + 
                                   $menu->beverage->calories + 
                                   $menu->soup->calories }} kcal
                            </td>
                            <td>{{ Str::limit($menu->notes, 30) }}</td>
                            <td>
                                @if($menu->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Pasif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.menu.daily.edit', $menu) }}" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.menu.daily.destroy', $menu) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light-danger" onclick="return confirm('Emin misiniz?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Henüz günlük menü oluşturulmamış.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $dailyMenus->links() }}
        </div>
    </div>
</div>
@endsection 