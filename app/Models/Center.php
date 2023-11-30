<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends Model
{
    use HasFactory;


    public function centerCategotry(): BelongsTo
    {
        return $this->belongsTo(CenterCategory::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function prescribers(): HasMany
    {
        return $this->hasMany(Prescriber::class);
    }

    static function getCenters(){
        self::pluck('name','id');
    }
}
