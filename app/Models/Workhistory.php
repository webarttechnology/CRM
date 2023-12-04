<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workhistory extends Model
{
    use HasFactory;
    protected $fillable = ["developer_job_id", "user_id", "final_status", "currenttime", "delayThen"];
}
