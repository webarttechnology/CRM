<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['client_id', 'project_name', 'project_type', 'technology', 'type', 'others', 'marketing_plan', 'smo_on', 'start_date', 'end_date', 'platform_name', 'prefer_technology', 'customer_requerment', 'description', 'business_name', 'closer_name', 'agent_name', 'reference_sites', 'remarks', 'upsale_opportunities', 'isupsale', 'sale_date', 'payment_mode', 'gross_amount', 'net_amount', 'due_amount', 'other_pay', 'status', 'currency'];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function developertask()
    {
        return $this->hasMany(\App\Models\Developertask::class);
    }

    public function task()
    {
    return $this->hasOne(Assign::class, 'sale_id', 'id');
    }
}
