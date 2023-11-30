<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specialities';

    public function prescribers(): HasMany
    {
        return $this->hasMany(Prescriber::class);
    }

    static function getSpecialities()
    {
        return self::pluck('name', 'id');
    }
}
