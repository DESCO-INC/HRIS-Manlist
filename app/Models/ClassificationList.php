<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationList extends Model
{
    /** @use HasFactory<\Database\Factories\ClassificationListFactory> */
    use HasFactory;
    protected $table = 'classification_lists';
    protected $guarded = [];
}
