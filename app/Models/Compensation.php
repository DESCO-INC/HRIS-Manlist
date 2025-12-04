<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    /** @use HasFactory<\Database\Factories\CompensationFactory> */
    use HasFactory;
    protected $table = 'compensation';
    protected $guarded = [];
}
