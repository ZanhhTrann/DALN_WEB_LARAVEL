<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'Categories';
    protected $primaryKey = 'Cid';

    protected $fillable = [
        'Cid',
        'Categories_name',
        'Api_value',//dùng để xác định categories con.
        'Api_code'
    ];
}
