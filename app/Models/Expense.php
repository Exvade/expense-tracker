<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'description',
        'expense_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Pastikan baris ini ada untuk mengkonversi expense_date ke objek Carbon
    protected $casts = [
        'expense_date' => 'datetime',
    ];

    // Alternatif jika Anda menggunakan Laravel versi lama (sebelum Laravel 7)
    // protected $dates = ['expense_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
