<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upsale extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['client_id', 'sale_id', 'upsale_type', 'start_date', 'end_date', 'others', 'gross_amount', 'net_amount', 'payment_mode', 'other_payment_mode', 'sale_date'];
}
