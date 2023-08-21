<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    protected $fillable = [
        'name', 'kana', 'tel', 'email', 'postcode',
        'address', 'birthday', 'gender', 'memo'
    ];

    public function scopeSearchCustomers($query, $input = null)
    {
        // ローカルスコープ
        if($query->where('kana', 'LIKE', $input. '%')
            ->orWhere('tel', 'LIKE', $input. '%')
            ->exists())
        {
            return $query->where('kana', 'LIKE', $input. '%')
                    ->orWhere('tel', 'LIKE', $input. '%');
        }
    }
}
