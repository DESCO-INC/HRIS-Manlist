<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteList extends Model
{
    /** @use HasFactory<\Database\Factories\SiteListFactory> */
    use HasFactory;
    protected $table = 'site_lists';
    protected $guarded = [];
}
