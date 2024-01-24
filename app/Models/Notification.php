<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'url','status'];

    public function user()
    {
    return $this->hasOne(User::class, 'id', 'sender_id');
    }

}
