<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developertask extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "developer_jobs";
    protected $fillable = ['sale_id', 'assign_to', 'assign_by', 'title','details','start_date','end_date','remarks', 'total_time', 'status'];
    public function sale(){
        return $this -> belongsTo(\App\Models\Sale::class, 'sale_id', 'id');
    }
}
