<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category; // Import Category model to get categories for dropdown
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Carbon\Carbon; // Import Carbon for date manipulation

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses with filtering options.
     */
    public function index(Request $request)
    {
        // Get all categories belonging to the authenticated user for the filter dropdown.
        $categories = Auth::user()->categories()->orderBy('name')->get();

        // Start building the query for expenses belonging to the authenticated user.
        $query = Auth::user()->expenses()->with('category'); // Eager load the category relationship.

        // Apply filters based on request parameters.

        // Filter by start_date
        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $query->where('expense_date', '>=', $startDate);
        }

        // Filter by end_date
        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->where('expense_date', '<=', $endDate);
        }

        // Filter by category_id
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Order the expenses, for example by expense_date in descending order.
        $expenses = $query->orderBy('expense_date', 'desc')->get();

        // Return the view with the filtered expenses and all categories for the filter dropdown.
        return view('expenses.index', compact('expenses', 'categories'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        // Get all categories belonging to the authenticated user to populate the category dropdown.
        $categories = Auth::user()->categories()->orderBy('name')->get();

        // If no categories exist, inform the user they need to create one first.
        if ($categories->isEmpty()) {
            return redirect()->route('categories.create')->with('error', 'Anda harus membuat kategori pengeluaran terlebih dahulu sebelum mencatat pengeluaran.');
        }

        // Return the view for creating a new expense with the categories data.
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01', // Amount must be positive.
            'category_id' => 'required|exists:categories,id', // Category must exist in the categories table.
            'description' => 'nullable|string|max:500', // Description is optional.
        ]);

        // Ensure the selected category belongs to the authenticated user.
        $category = Category::find($request->category_id);
        if (!$category || $category->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Kategori tidak valid atau bukan milik Anda.')->withInput();
        }

        try {
            // Create a new expense associated with the authenticated user.
            Auth::user()->expenses()->create([
                'expense_date' => $request->expense_date,
                'amount' => $request->amount,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);

            // Redirect to the expenses index page with a success message.
            return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil dicatat!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal mencatat pengeluaran: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified expense.
     * (Not directly used in current views but good for resource controllers)
     */
    public function show(Expense $expense)
    {
        // Ensure the expense belongs to the authenticated user.
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat pengeluaran ini.');
        }

        return view('expenses.show', compact('expense')); // You might create a show.blade.php if needed.
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        // Ensure the expense belongs to the authenticated user before allowing edit.
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengedit pengeluaran ini.');
        }

        // Get all categories belonging to the authenticated user to populate the category dropdown.
        $categories = Auth::user()->categories()->orderBy('name')->get();

        // Return the view for editing the expense with the expense and categories data.
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        // Ensure the expense belongs to the authenticated user before allowing update.
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk memperbarui pengeluaran ini.');
        }

        // Validate the incoming request data.
        $request->validate([
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:500',
        ]);

        // Ensure the selected category belongs to the authenticated user.
        $category = Category::find($request->category_id);
        if (!$category || $category->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Kategori tidak valid atau bukan milik Anda.')->withInput();
        }

        try {
            // Update the expense details.
            $expense->update([
                'expense_date' => $request->expense_date,
                'amount' => $request->amount,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);

            // Redirect to the expenses index page with a success message.
            return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil diperbarui!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal memperbarui pengeluaran: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        // Ensure the expense belongs to the authenticated user before allowing deletion.
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk menghapus pengeluaran ini.');
        }

        try {
            // Delete the expense.
            $expense->delete();

            // Redirect to the expenses index page with a success message.
            return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil dihapus!');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with an error message.
            return redirect()->back()->with('error', 'Gagal menghapus pengeluaran: ' . $e->getMessage());
        }
    }
}
