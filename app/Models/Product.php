<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'img_path',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeFilter($query, $request)
    {
        if ($search = $request->search) {
            $query->where('product_name', 'LIKE', "%{$search}%");
        }

        if($min_price = $request->min_price){
            $query->where('price', '>=', $min_price);
        }

        if($max_price = $request->max_price){
            $query->where('price', '<=', $max_price);
        }

        if($min_stock = $request->min_stock){
            $query->where('stock', '>=', $min_stock);
        }

        if($max_stock = $request->max_stock){
            $query->where('stock', '<=', $max_stock);
        }

        if ($company_id = $request->company_id) {
            $query->where('company_id', $company_id);
        }

        return $query;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}