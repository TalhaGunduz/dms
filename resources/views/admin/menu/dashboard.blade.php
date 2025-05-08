@extends('layouts.master')
@section('style')
<style>
    .menu-card {
        transition: all 0.3s ease;
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="row g-5 g-xl-8">
    <!-- Yemek Çeşitleri -->
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8 menu-card">
            <div class="card-header border-0">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Yemek Çeşitleri</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Yemek çeşitlerini yönetin</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.menu.food.index', ['type' => 'main_dish']) }}" class="btn btn-light-primary btn-active-primary mb-3">
                        <i class="fas fa-utensils me-2"></i>Ana Yemekler
                    </a>
                    <a href="{{ route('admin.menu.food.index', ['type' => 'side_dish']) }}" class="btn btn-light-primary btn-active-primary mb-3">
                        <i class="fas fa-hamburger me-2"></i>Ara Yemekler
                    </a>
                    <a href="{{ route('admin.menu.food.index', ['type' => 'dessert']) }}" class="btn btn-light-primary btn-active-primary mb-3">
                        <i class="fas fa-ice-cream me-2"></i>Tatlılar
                    </a>
                    <a href="{{ route('admin.menu.food.index', ['type' => 'salad']) }}" class="btn btn-light-primary btn-active-primary mb-3">
                        <i class="fas fa-leaf me-2"></i>Salatalar
                    </a>
                    <a href="{{ route('admin.menu.food.index', ['type' => 'beverage']) }}" class="btn btn-light-primary btn-active-primary mb-3">
                        <i class="fas fa-glass-martini-alt me-2"></i>İçecekler
                    </a>
                    <a href="{{ route('admin.menu.food.index', ['type' => 'soup']) }}" class="btn btn-light-primary btn-active-primary">
                        <i class="fas fa-soup me-2"></i>Çorbalar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Menü Oluşturma -->
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8 menu-card">
            <div class="card-header border-0">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Menü Oluşturma</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Yeni menü oluşturun</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.menu.daily.create') }}" class="btn btn-light-success btn-active-success">
                        <i class="fas fa-plus-circle me-2"></i>Yeni Menü Oluştur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Günlük Menüler -->
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8 menu-card">
            <div class="card-header border-0">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Günlük Menüler</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Günlük menüleri yönetin</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.menu.daily.index') }}" class="btn btn-light-info btn-active-info">
                        <i class="fas fa-calendar-alt me-2"></i>Günlük Menüleri Görüntüle
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 