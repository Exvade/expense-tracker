<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil kategori milik pengguna yang sedang login
        // Eager load expenses untuk setiap kategori dan hitung total pengeluaran
        $categories = Auth::user()->categories()->with('expenses')->get()->map(function ($category) {
            $category->total_spend = $category->expenses->sum('amount');
            $category->remaining_budget = $category->max_budget - $category->total_spend;
            // Hitung persentase penggunaan budget untuk progress bar
            $category->percentage_used = ($category->max_budget > 0) ? round(($category->total_spend / $category->max_budget) * 100, 2) : 0;
            return $category;
        });

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_budget' => 'nullable|numeric|min:0',
        ]);

        Auth::user()->categories()->create([
            'name' => $request->name,
            'max_budget' => $request->max_budget,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Pastikan pengguna memiliki akses ke kategori ini
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Pastikan pengguna memiliki akses ke kategori ini
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Pastikan pengguna memiliki akses ke kategori ini
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'max_budget' => 'nullable|numeric|min:0',
        ]);

        $category->update([
            'name' => $request->name,
            'max_budget' => $request->max_budget,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Pastikan pengguna memiliki akses ke kategori ini
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
