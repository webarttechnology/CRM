<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;
    protected $table= 'tasks';
    protected $fillable = ['sale_id', 'assign_to', 'assign_by', 'assign_date'];
}
