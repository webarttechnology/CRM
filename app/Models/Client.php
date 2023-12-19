<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['client_code', 'name', 'email', 'country_name', 'address', 'current_website', 'agent_name', 'closer_name', 'remarks'];

    public function contact_details()
    {
        return $this->hasMany(\App\Models\Contact_detail::class);
    }

    public function sale()
    {
        return $this->hasMany(\App\Models\Sale::class);
    }
}
