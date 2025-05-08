@extends('layouts.master')
@section('style')

@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-toolbar">
            <a href="{{ route('admin.menu.food.create', ['type' => $type]) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni {{ $title }} Ekle
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
                        <th>Görsel</th>
                        <th>Ad</th>
                        <th>Açıklama</th>
                        <th>Kalori</th>
                        <th>Özellikler</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" style="max-height: 50px;">
                                @else
                                    <span class="text-muted">Görsel yok</span>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>{{ $item->calories }}</td>
                            <td>
                                @if($item->is_vegetarian)
                                    <span class="badge badge-success">Vejetaryen</span>
                                @endif
                                @if($type === 'beverage' && $item->is_hot)
                                    <span class="badge badge-warning">Sıcak</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Pasif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.menu.food.edit', ['type' => $type, 'food' => $item->id]) }}" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.menu.food.destroy', ['type' => $type, 'food' => $item->id]) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">Henüz {{ $title }} eklenmemiş.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection 