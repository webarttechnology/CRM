<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'project_name', 'project_type', 'technology', 'type', 'others', 'marketing_plan', 'smo_on', 'start_date', 'end_date', 'platform_name', 'prefer_technology', 'description', 'business_name', 'closer_name', 'agent_name', 'reference_sites', 'remarks', 'upsale_opportunities', 'isupsale', 'sale_date', 'payment_mode', 'gross_amount', 'net_amount', 'due_amount', 'other_pay'];
}
