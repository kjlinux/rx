<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescriber extends Model
{
    use HasFactory;

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    // public function rebates(): HasMany
    // {
    //     return $this->hasMany(Rebate::class);
    // }

    public function patients(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'sends');
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    public function function(): BelongsTo
    {
        return $this->belongsTo(Functions::class);
    }

    static function getPrescribers()
    {
        return self::selectRaw("CONCAT('Dr. ', name, ' ', forenames) AS prescribers, id")->pluck('prescribers', 'id');
    }

    static function getPrescribersWithoutExtern()
    {
        return self::selectRaw("CONCAT('Dr. ', name, ' ', forenames) AS prescribers, id")->where('id', '!=', 1000)->pluck('prescribers', 'id');
    }

    public function sends()
    {
        return $this->hasMany(Send::class, 'prescriber_id', 'id');
    }
}
