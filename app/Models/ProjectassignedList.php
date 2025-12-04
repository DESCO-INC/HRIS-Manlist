<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectassignedList extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectassignedListFactory> */
    use HasFactory;
    protected $table = 'projectassigned_lists';
    protected $guarded = [];
}
