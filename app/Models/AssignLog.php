<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignLog extends Model
{
    use HasFactory;
  
    protected $fillable = ['task_id', 'changes'];

    public function tasks()
    {
        return $this -> belongsTo(\App\Models\Assign::class, 'task_id', 'id');
    }
}
