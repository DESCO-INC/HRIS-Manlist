<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmergency extends Model
{
    /** @use HasFactory<\Database\Factories\ContactEmergencyFactory> */
    use HasFactory;
    protected $table = 'contact_emergencies';
    protected $guarded = [];
}
