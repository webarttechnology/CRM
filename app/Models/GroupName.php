<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupName extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'name', 'uniqid','type', 'status'];

    public function chat()
    {
        return $this->hasMany(Chat::class, 'group_id', 'id');
    }


}
