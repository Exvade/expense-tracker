<?php

namespace App\Exports;

use App\Models\Expense;
use App\Models\Category; // Import model Category
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpensesExport implements FromCollection, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $categoryId;
    protected $styleRows = []; // Properti untuk menyimpan informasi baris untuk styling

    public function __construct($startDate = null, $endDate = null, $categoryId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->categoryId = $categoryId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = Auth::user();
        $exportData = collect();
        $currentRow = 1; // Mulai dari baris 1 di Excel

        // Ambil semua kategori milik pengguna, eager load pengeluaran mereka
        // dan hitung total pengeluaran untuk setiap kategori
        $categories = $user->categories()->with(['expenses' => function ($query) {
            // Filter pengeluaran berdasarkan tanggal dan kategori jika ada
            if ($this->startDate) {
                $startDate = Carbon::parse($this->startDate)->startOfDay();
                $query->where('expense_date', '>=', $startDate);
            }
            if ($this->endDate) {
                $endDate = Carbon::parse($this->endDate)->endOfDay();
                $query->where('expense_date', '<=', $endDate);
            }
            if ($this->categoryId) {
                $query->where('category_id', $this->categoryId);
            }
        }])->get();

        if ($categories->isEmpty()) {
            // Jika tidak ada kategori atau pengeluaran, berikan pesan
            $exportData->push(['Tidak ada data pengeluaran untuk diekspor.']);
            return $exportData;
        }

        foreach ($categories as $category) {
            // Lewati kategori jika tidak ada pengeluaran yang cocok dengan filter
            if ($category->expenses->isEmpty() && $this->categoryId && $category->id != $this->categoryId) {
                continue; // Skip if filtered by category and this category has no matching expenses
            }
            if ($category->expenses->isEmpty() && !$this->categoryId) {
                // If no specific category is filtered, and this category has no expenses, skip it
                // Unless we want to show categories with 0 expenses. For now, let's skip.
                continue;
            }

            // Baris Judul Kategori
            // Mengurangi jumlah kolom kosong menjadi 5 karena total kolom sekarang 6
            $exportData->push([
                'Kategori: ' . $category->name, '', '', '', '', ''
            ]);
            $this->styleRows[$currentRow] = 'category_title';
            $currentRow++;

            // Baris Header Pengeluaran
            // Mengubah urutan dan menghilangkan 'ID Pengeluaran'
            $exportData->push([
                'Deskripsi', 'Jumlah', 'Tanggal', 'Kategori', 'Tanggal Dibuat', 'Terakhir Diperbarui'
            ]);
            $this->styleRows[$currentRow] = 'expense_headings';
            $currentRow++;

            // Baris Data Pengeluaran
            foreach ($category->expenses->sortByDesc('expense_date') as $expense) { // Urutkan pengeluaran
                // Mengubah urutan dan menghilangkan 'ID Pengeluaran'
                $exportData->push([
                    $expense->description,
                    $expense->amount,
                    $expense->expense_date->format('Y-m-d'),
                    $expense->category->name ?? 'Tidak Ada Kategori',
                    $expense->created_at->format('Y-m-d H:i:s'),
                    $expense->updated_at->format('Y-m-d H:i:s'),
                ]);
                $this->styleRows[$currentRow] = 'expense_data';
                $currentRow++;
            }

            // Hitung total pengeluaran dan sisa budget untuk kategori ini
            $totalSpendForCategory = $category->expenses->sum('amount');
            $remainingBudgetForCategory = ($category->max_budget ?? 0) - $totalSpendForCategory; // Pastikan max_budget tidak null

            // Baris Total Pengeluaran dan Sisa Budget
            // Menyesuaikan kolom kosong agar Total Pengeluaran dan Sisa Budget berada di kolom yang sama dengan data "Jumlah" dan "Deskripsi"
            $exportData->push([
                '', // Kolom Deskripsi (kosong)
                '', // Kolom Jumlah (kosong)
                'Total Pengeluaran: ' . number_format($totalSpendForCategory, 2, ',', '.'), // Pindah ke kolom Tanggal (index 2)
                'Sisa Budget: ' . number_format($remainingBudgetForCategory, 2, ',', '.'), // Pindah ke kolom Kategori (index 3)
                '', // Kolom Tanggal Dibuat (kosong)
                ''  // Kolom Terakhir Diperbarui (kosong)
            ]);
            $this->styleRows[$currentRow] = 'category_totals';
            $currentRow++;

            // Baris Kosong untuk Pemisah Visual antar Kategori
            // Mengurangi jumlah kolom kosong menjadi 6
            $exportData->push(['', '', '', '', '', '']);
            $this->styleRows[$currentRow] = 'blank_row';
            $currentRow++;
        }

        return $exportData;
    }

    /**
     * Apply styles to the worksheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        $styles = [];
        foreach ($this->styleRows as $rowNum => $type) {
            if ($type === 'category_title') {
                $styles[$rowNum] = [
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000080']], // Dark Blue
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFD0E0F0'] // Light Blue background
                    ],
                ];
            } elseif ($type === 'expense_headings') {
                $styles[$rowNum] = [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FF4F81BD'] // Blue background
                    ],
                ];
                // Apply alignment for 'Deskripsi' column (Column A)
                $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // Apply alignment to the 'Jumlah' column (now column B)
                $sheet->getStyle('B' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            } elseif ($type === 'category_totals') {
                $styles[$rowNum] = [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FF333333']], // Dark Gray
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFE0E0E0'] // Light Gray background
                    ],
                ];
                // Apply alignment to the 'Total Pengeluaran' and 'Sisa Budget' cells
                // These are now in columns C and D (index 2 and 3)
                $sheet->mergeCells('C' . $rowNum . ':D' . $rowNum); // Merge for Total Pengeluaran and Sisa Budget
                $styles[$rowNum]['alignment'] = [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Align left for merged cell
                ];
            }
        }
        // Apply number format and alignment to the 'Jumlah' column (now column B) for all data rows
        foreach ($this->styleRows as $rowNum => $type) {
            if ($type === 'expense_data') {
                // Apply alignment for 'Deskripsi' column (Column A)
                $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // Apply alignment for 'Jumlah' column (Column B)
                $sheet->getStyle('B' . $rowNum)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                // Apply number format to the 'Jumlah' column (column B)
                $sheet->getStyle('B' . $rowNum)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }
        }
        return $styles;
    }
}
