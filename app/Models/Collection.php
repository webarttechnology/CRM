<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'sale_id', 'currency', 'instalment', 'net_amount', 'sale_date', 'payment_mode', 'other_payment_mode'];
}
