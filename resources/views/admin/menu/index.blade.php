@extends('layouts.master')
@section('style')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Günlük Menüler</h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Menü
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>Öğün</th>
                        <th>Ana Yemek</th>
                        <th>Yan Yemek</th>
                        <th>Tatlı</th>
                        <th>Salata</th>
                        <th>İçecek</th>
                        <th>Çorba</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyMenus as $menu)
                        <tr>
                            <td>{{ $menu->menu_date->format('d.m.Y') }}</td>
                            <td>
                                @if($menu->meal_type == 'breakfast')
                                    Kahvaltı
                                @elseif($menu->meal_type == 'lunch')
                                    Öğle Yemeği
                                @else
                                    Akşam Yemeği
                                @endif
                            </td>
                            <td>{{ $menu->mainDish->name }}</td>
                            <td>{{ $menu->sideDish->name }}</td>
                            <td>{{ $menu->dessert->name }}</td>
                            <td>{{ $menu->salad->name }}</td>
                            <td>{{ $menu->beverage->name }}</td>
                            <td>{{ $menu->soup->name }}</td>
                            <td>
                                @if($menu->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Pasif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Emin misiniz?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 