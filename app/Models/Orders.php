<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $primaryKey = 'Oid';

    protected $fillable = [
        'Oid',
        'Uid',
        'Pid',
        'PMid',
        'SMid',
        'Order_date',
        'Total_order_price'
    ];
}
