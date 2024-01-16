<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'comment_by', 'message', 'file', 'date'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'comment_by');
    }
}
