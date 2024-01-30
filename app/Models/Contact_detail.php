<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_detail extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','email_id', 'mobile_no'];

    public function client(){
        return $this -> belongsTo(\App\Models\Client::class);
    }
}
