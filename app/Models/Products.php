<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'Prodcuts';
    protected $primaryKey = 'Pid';

    protected $fillable = [
        'Pid',
        'Cid',
        'Product_name',
        'Price',
        'Description',
        'Quantit_in_stock'
    ];
}
