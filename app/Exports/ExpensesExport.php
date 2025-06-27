<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles; // Import untuk styling
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Import untuk auto-size kolom
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // Import untuk objek Worksheet
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpensesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize // Tambahkan WithStyles dan ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $categoryId;

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

        $query = $user->expenses()->with('category');

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

        return $query->orderBy('expense_date', 'desc')->get()->map(function($expense) {
            return [
                'ID Pengeluaran' => $expense->id,
                'Tanggal'        => $expense->expense_date->format('Y-m-d'),
                'Jumlah'         => $expense->amount,
                'Deskripsi'      => $expense->description,
                'Kategori'       => $expense->category->name ?? 'Tidak Ada Kategori',
                'Tanggal Dibuat' => $expense->created_at->format('Y-m-d H:i:s'),
                'Terakhir Diperbarui' => $expense->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Pengeluaran',
            'Tanggal',
            'Jumlah',
            'Deskripsi',
            'Kategori',
            'Tanggal Dibuat',
            'Terakhir Diperbarui',
        ];
    }

    /**
     * Apply styles to the worksheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headings)
            1    => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], // Bold text, white color
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FF4F81BD'] // Blue background color
                ],
            ],
            // Example: Style a specific column (e.g., 'C' for Jumlah)
            'C' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ],
            ],
        ];
    }
}
