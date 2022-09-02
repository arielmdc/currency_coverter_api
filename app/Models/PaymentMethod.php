<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'fee'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

}
