<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentList extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentListFactory> */
    use HasFactory;
    protected $table = 'department_lists';
    protected $guarded = [];
}
