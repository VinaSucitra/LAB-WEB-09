<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FishController extends Controller
{
    public function index(Request $request)
    {
        $rarities = ['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'];

        $fishes = Fish::query()
            ->search($request->search)
            ->rarity($request->rarity)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('fishes.index', compact('fishes', 'rarities'));
    }

    public function create()
    {
        $rarities = ['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'];
        return view('fishes.create', compact('rarities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'rarity' => ['required', Rule::in(['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'])],
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|min:0',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string',
        ]);

        if ($data['base_weight_max'] <= $data['base_weight_min']) {
            return back()->withInput()
                ->withErrors(['base_weight_max' => 'Berat maksimum harus lebih besar dari berat minimum.']);
        }

        Fish::create($data);
        return redirect()->route('fishes.index')->with('success', 'Data ikan berhasil ditambahkan!');
    }

    public function show(Fish $fish)
    {
        return view('fishes.show', compact('fish'));
    }

    public function edit(Fish $fish)
    {
        $rarities = ['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'];
        return view('fishes.edit', compact('fish', 'rarities'));
    }

    public function update(Request $request, Fish $fish)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'rarity' => ['required', Rule::in(['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'])],
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|min:0',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100',
            'description' => 'nullable|string',
        ]);

        if ($data['base_weight_max'] <= $data['base_weight_min']) {
            return back()->withInput()
                ->withErrors(['base_weight_max' => 'Berat maksimum harus lebih besar dari berat minimum.']);
        }

        $fish->update($data);
        return redirect()->route('fishes.index')->with('success', 'Data ikan berhasil diperbarui!');
    }

    public function destroy(Fish $fish)
    {
        $fish->delete();
        return redirect()->route('fishes.index')->with('success', 'Data ikan berhasil dihapus!');
    }
}
