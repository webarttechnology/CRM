<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    
    use HasFactory;

    protected $fillable = ['group_id', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function group_name()
    {
        return $this->belongsTo(GroupName::class, 'group_id', 'id');
    }

}
