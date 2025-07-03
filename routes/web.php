<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;

// Ubah route '/' untuk redirect ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        $initialBalance = $user->initial_balance;

        // Total pengeluaran bulan ini
        $totalExpensesThisMonth = $user->expenses()
                                        ->whereMonth('expense_date', now()->month)
                                        ->whereYear('expense_date', now()->year)
                                        ->sum('amount');

        // Total pengeluaran tahun ini
        $totalExpensesThisYear = $user->expenses()
                                       ->whereYear('expense_date', now()->year)
                                       ->sum('amount');

        // Sisa saldo bulan ini (saldo awal - pengeluaran bulan ini)
        $remainingBalance = $initialBalance - $totalExpensesThisMonth;

        // NEW: Total pengeluaran keseluruhan (semua waktu)
        $totalExpensesAllTime = $user->expenses()->sum('amount');

        // NEW: Sisa saldo keseluruhan (saldo awal - pengeluaran keseluruhan)
        $remainingBalanceAllTime = $initialBalance - $totalExpensesAllTime;


        // Ambil semua kategori pengguna dan hitung pengeluaran bulan ini untuk setiap kategori
        $categoriesWithBudgets = $user->categories()->get()->map(function ($category) {
            $currentMonthSpend = $category->expenses()
                                         ->whereMonth('expense_date', now()->month)
                                         ->whereYear('expense_date', now()->year)
                                         ->sum('amount');
            $category->current_month_spend = $currentMonthSpend;
            $category->max_budget = $category->max_budget ?? 0; // Pastikan max_budget tidak null
            $category->remaining_budget = $category->max_budget - $currentMonthSpend;
            $category->percentage_used = ($category->max_budget > 0) ? round(($currentMonthSpend / $category->max_budget) * 100, 2) : 0;
            return $category;
        });

        // Tetap pertahankan perhitungan expensesByCategory dan categoryPercentages yang ada
        // jika bagian lain dari dashboard masih menggunakannya, meskipun kita akan
        // menggunakan categoriesWithBudgets untuk bagian "Pengeluaran Berdasarkan Kategori"
        $expensesByCategory = $user->expenses()
                                   ->whereMonth('expense_date', now()->month)
                                   ->whereYear('expense_date', now()->year)
                                   ->with('category')
                                   ->get()
                                   ->groupBy(function($expense) {
                                       return $expense->category->name ?? 'Tidak Ada Kategori';
                                   })
                                   ->map(function($items) {
                                       return $items->sum('amount');
                                   })
                                   ->sortDesc();

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
            'totalExpensesAllTime', // NEW: Pass total expenses for all time
            'remainingBalanceAllTime', // NEW: Pass remaining balance for all time
            'expensesByCategory',
            'categoryPercentages',
            'categoriesWithBudgets'
        ));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/initial-balance', [ProfileController::class, 'updateInitialBalance'])->name('profile.update-initial-balance');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk Kategori
    Route::resource('categories', CategoryController::class);

    // PENTING: Pindahkan route spesifik ini ke ATAS route resource 'expenses'
    Route::get('expenses/export', [ExpenseController::class, 'export'])->name('expenses.export');

    // Route untuk Pengeluaran (resource)
    Route::resource('expenses', ExpenseController::class);
});

require __DIR__.'/auth.php';
