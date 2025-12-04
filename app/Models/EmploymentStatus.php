<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    /** @use HasFactory<\Database\Factories\EmploymentStatusFactory> */
    use HasFactory;
    protected $table = 'employment_statuses';
    protected $guarded = [];
}
