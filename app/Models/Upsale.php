<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upsale extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'sale_id', 'upsale_type', 'start_date', 'end_date', 'others', 'gross_amount', 'net_amount', 'payment_mode', 'other_payment_mode', 'sale_date'];
}
