<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'Pid';

    protected $fillable = [
        'Pid',
        'Cid',
        'Product_name',
        'Main_image',
        'Price',
        'Images',
        'Colors',
        'Sizes',
        'Description',
        'Quantit_in_stock',
        'Api_code'
    ];
}
