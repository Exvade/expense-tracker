<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Get all categories belonging to the currently authenticated user, ordered by creation date (latest first).
        $categories = Auth::user()->categories()->latest()->get();

        // Return the view with the categories data.
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        // Return the view for creating a new category.
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $request->validate([
            'name' => 'required|string|max:255', // Category name is required, must be a string, max 255 characters.
        ]);

        try {
            // Create a new category associated with the authenticated user.
            Auth::user()->categories()->create([
                'name' => $request->name,
            ]);

            // Redirect to the categories index page with a success message.
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified category.
     * (Not directly used in current views but good for resource controllers)
     */
    public function show(Category $category)
    {
        // Ensure the category belongs to the authenticated user.
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat kategori ini.');
        }

        return view('categories.show', compact('category')); // You might create a show.blade.php if needed.
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        // Ensure the category belongs to the authenticated user before allowing edit.
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengedit kategori ini.');
        }

        // Return the view for editing the category with the category data.
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Ensure the category belongs to the authenticated user before allowing update.
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk memperbarui kategori ini.');
        }

        // Validate the incoming request data.
        $request->validate([
            'name' => 'required|string|max:255', // Category name is required, must be a string, max 255 characters.
        ]);

        try {
            // Update the category's name.
            $category->update([
                'name' => $request->name,
            ]);

            // Redirect to the categories index page with a success message.
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Ensure the category belongs to the authenticated user before allowing deletion.
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk menghapus kategori ini.');
        }

        try {
            // Delete the category. Due to `onDelete('cascade')` in migration, related expenses will also be deleted.
            $category->delete();

            // Redirect to the categories index page with a success message.
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
