<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = ['emp_id', 'break_type', 'break_in', 'started_date', 'started_at', 'start_ip', 'break_end', 'ended_at', 'ends_at', 'ends_ip', 'status'];
}
