<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensureLists extends Model
{
    /** @use HasFactory<\Database\Factories\LicensureListsFactory> */
    use HasFactory;
    protected $table = 'licensure_lists';
    protected $guarded = [];
}
