<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\MainDish;
use App\Models\SideDish;
use App\Models\Dessert;
use App\Models\Salad;
use App\Models\Beverage;
use App\Models\Soup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    protected $modelMap = [
        'main_dish' => MainDish::class,
        'side_dish' => SideDish::class,
        'dessert' => Dessert::class,
        'salad' => Salad::class,
        'beverage' => Beverage::class,
        'soup' => Soup::class,
    ];

    protected $titleMap = [
        'main_dish' => 'Ana Yemek',
        'side_dish' => 'Ara Yemek',
        'dessert' => 'Tatlı',
        'salad' => 'Salata',
        'beverage' => 'İçecek',
        'soup' => 'Çorba',
    ];

    public function index($type)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $model = $this->modelMap[$type];
        $items = $model::latest()->paginate(10);
        $title = $this->titleMap[$type];

        return view('admin.menu.food.index', compact('items', 'type', 'title'));
    }

    public function create($type)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $title = $this->titleMap[$type];
        return view('admin.menu.food.create', compact('type', 'title'));
    }

    public function store(Request $request, $type)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'required|integer|min:0|max:2000',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $validated['is_vegetarian'] = $request->boolean('is_vegetarian');
        $validated['is_hot'] = $request->boolean('is_hot');
        $validated['is_active'] = $request->boolean('is_active');

        $model = $this->modelMap[$type];
        $model::create($validated);

        return redirect()->route('admin.menu.food.index', ['type' => $type])
            ->with('success', $this->titleMap[$type] . ' başarıyla eklendi.');
    }

    public function edit($type, $id)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $model = $this->modelMap[$type];
        $item = $model::findOrFail($id);
        $title = $this->titleMap[$type];

        return view('admin.menu.food.edit', compact('item', 'type', 'title'));
    }

    public function update(Request $request, $type, $id)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'required|integer|min:0|max:2000',
            'image' => 'nullable|image|max:2048',
            'is_vegetarian' => 'boolean',
            'is_hot' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $model = $this->modelMap[$type];
        $item = $model::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $validated['is_vegetarian'] = $request->has('is_vegetarian');
        $validated['is_hot'] = $request->has('is_hot');
        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return redirect()->route('admin.menu.food.index', ['type' => $type])
            ->with('success', $this->titleMap[$type] . ' başarıyla güncellendi.');
    }

    public function destroy($type, $id)
    {
        if (!isset($this->modelMap[$type])) {
            abort(404);
        }

        $model = $this->modelMap[$type];
        $item = $model::findOrFail($id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('admin.menu.food.index', ['type' => $type])
            ->with('success', $this->titleMap[$type] . ' başarıyla silindi.');
    }
} 