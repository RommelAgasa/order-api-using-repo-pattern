<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'details',
        'is_fullfilled'
    ];

    // Consolas, 'Courier New', monospace


    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
