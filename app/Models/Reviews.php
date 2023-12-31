<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'Reviews';
    protected $primaryKey = 'Rid';

    protected $fillable = [
        'Rid',
        'Pid',
        'Uid',
        'Rating',
        'Review',
        'Review_date'
    ];
}
