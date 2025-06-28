<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon for date functions

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories with current month's spending.
     */
    public function index()
    {
        // Get all categories belonging to the currently authenticated user.
        $categories = Auth::user()->categories()->latest()->get();

        // Calculate current month's spending for each category
        $categories->each(function ($category) {
            $currentMonthSpend = $category->expenses()
                                         ->whereMonth('expense_date', now()->month)
                                         ->whereYear('expense_date', now()->year)
                                         ->sum('amount');
            $category->current_month_spend = $currentMonthSpend;
            $category->remaining_budget = $category->max_budget - $currentMonthSpend;
            $category->percentage_used = ($category->max_budget > 0) ? round(($currentMonthSpend / $category->max_budget) * 100, 2) : 0;
        });

        // Return the view with the enriched categories data.
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_budget' => 'required|numeric|min:0',
        ]);

        try {
            Auth::user()->categories()->create([
                'name' => $request->name,
                'max_budget' => $request->max_budget,
            ]);

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat kategori ini.');
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengedit kategori ini.');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk memperbarui kategori ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'max_budget' => 'required|numeric|min:0',
        ]);

        try {
            $category->update([
                'name' => $request->name,
                'max_budget' => $request->max_budget,
            ]);

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk menghapus kategori ini.');
        }

        try {
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
