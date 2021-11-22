<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentmethods extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'minimum_amount',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'paymentmethods';
}
