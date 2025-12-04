<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manlist extends Model
{
    use HasFactory;
    protected $table = 'manlists';
    protected $guarded = [];

    // One-to-One Relationships
    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class);
    }

    public function contactEmergency()
    {
        return $this->hasOne(ContactEmergency::class);
    }

    public function leaveIncentive()
    {
        return $this->hasOne(LeaveIncentive::class);
    }

    public function compensation()
    {
        return $this->hasOne(Compensation::class);
    }
}
