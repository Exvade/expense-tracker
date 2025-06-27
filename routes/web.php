<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\Category; // Import Category model
use App\Models\Expense; // Import Expense model
use Carbon\Carbon; // Import Carbon for date manipulation

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Ambil saldo awal dari database
        $initialBalance = $user->initial_balance; // <--- UBAH DI SINI

        // Total expenses for the current month
        $totalExpensesThisMonth = $user->expenses()
                                        ->whereMonth('expense_date', now()->month)
                                        ->whereYear('expense_date', now()->year)
                                        ->sum('amount');

        // Total expenses for the current year
        $totalExpensesThisYear = $user->expenses()
                                       ->whereYear('expense_date', now()->year)
                                       ->sum('amount');

        // Remaining balance
        $remainingBalance = $initialBalance - $totalExpensesThisMonth;

        // Expenses breakdown by category for the current month
        $expensesByCategory = $user->expenses()
                                   ->whereMonth('expense_date', now()->month)
                                   ->whereYear('expense_date', now()->year)
                                   ->with('category') // Eager load category to get names
                                   ->get()
                                   ->groupBy(function($expense) {
                                       return $expense->category->name ?? 'Tanpa Kategori'; // Group by category name
                                   })
                                   ->map(function($items) {
                                       return $items->sum('amount'); // Sum amount for each group
                                   })
                                   ->sortDesc(); // Sort by highest expense first

        // Calculate percentages for chart (optional, but good for visualization)
        $categoryPercentages = [];
        if ($totalExpensesThisMonth > 0) {
            foreach ($expensesByCategory as $categoryName => $amount) {
                $percentage = ($amount / $totalExpensesThisMonth) * 100;
                $categoryPercentages[$categoryName] = round($percentage, 2);
            }
        }


        return view('dashboard', compact(
            'initialBalance',
            'totalExpensesThisMonth',
            'totalExpensesThisYear',
            'remainingBalance',
            'expensesByCategory',
            'categoryPercentages'
        ));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Tambahkan route baru ini:
    Route::patch('/profile/initial-balance', [ProfileController::class, 'updateInitialBalance'])->name('profile.update-initial-balance');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk Kategori
    Route::resource('categories', CategoryController::class);

    // Route untuk Pengeluaran
    Route::resource('expenses', ExpenseController::class);
});

require __DIR__.'/auth.php';
