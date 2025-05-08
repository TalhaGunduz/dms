<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\MainDish;
use App\Models\SideDish;
use App\Models\Dessert;
use App\Models\Salad;
use App\Models\Beverage;
use App\Models\Soup;
use App\Models\DailyMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $dailyMenus = DailyMenu::with(['mainDish', 'sideDish', 'dessert', 'salad', 'beverage', 'soup'])
            ->latest('menu_date')
            ->get();
        return view('admin.menu.index', compact('dailyMenus'));
    }

    public function create()
    {
        $mainDishes = MainDish::where('is_active', true)->get();
        $sideDishes = SideDish::where('is_active', true)->get();
        $desserts = Dessert::where('is_active', true)->get();
        $salads = Salad::where('is_active', true)->get();
        $beverages = Beverage::where('is_active', true)->get();
        $soups = Soup::where('is_active', true)->get();

        return view('admin.menu.create', compact(
            'mainDishes',
            'sideDishes',
            'desserts',
            'salads',
            'beverages',
            'soups'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_date' => 'required|date',
            'main_dish_id' => 'required|exists:main_dishes,id',
            'side_dish_id' => 'required|exists:side_dishes,id',
            'dessert_id' => 'required|exists:desserts,id',
            'salad_id' => 'required|exists:salads,id',
            'beverage_id' => 'required|exists:beverages,id',
            'soup_id' => 'required|exists:soups,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'notes' => 'nullable|string'
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = true;

        DailyMenu::create($validated);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'Menü başarıyla oluşturuldu.');
    }

    public function edit(DailyMenu $menu)
    {
        $mainDishes = MainDish::where('is_active', true)->get();
        $sideDishes = SideDish::where('is_active', true)->get();
        $desserts = Dessert::where('is_active', true)->get();
        $salads = Salad::where('is_active', true)->get();
        $beverages = Beverage::where('is_active', true)->get();
        $soups = Soup::where('is_active', true)->get();

        return view('admin.menu.edit', compact(
            'menu',
            'mainDishes',
            'sideDishes',
            'desserts',
            'salads',
            'beverages',
            'soups'
        ));
    }

    public function update(Request $request, DailyMenu $menu)
    {
        $validated = $request->validate([
            'menu_date' => 'required|date',
            'main_dish_id' => 'required|exists:main_dishes,id',
            'side_dish_id' => 'required|exists:side_dishes,id',
            'dessert_id' => 'required|exists:desserts,id',
            'salad_id' => 'required|exists:salads,id',
            'beverage_id' => 'required|exists:beverages,id',
            'soup_id' => 'required|exists:soups,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'notes' => 'nullable|string'
        ]);

        $menu->update($validated);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'Menü başarıyla güncellendi.');
    }

    public function destroy(DailyMenu $menu)
    {
        $menu->delete();

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'Menü başarıyla silindi.');
    }
} 