<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveIncentive extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveIncentiveFactory> */
    use HasFactory;
    protected $table = 'leave_incentives';
    protected $guarded = [];
}
