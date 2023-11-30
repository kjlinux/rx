<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Functions extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'functions';

    public function prescribers(): HasMany
    {
        return $this->hasMany(Prescriber::class);
    }

    static function getFunctions()
    {
        return self::pluck('name', 'id');
    }
}
