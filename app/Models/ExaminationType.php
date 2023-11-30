<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExaminationType extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'examinations_type';

    public function examinations(): HasMany
    {
        return $this->hasMany(Examination::class);
    }

    public function examinationGroup(): BelongsTo
    {
        return $this->belongsTo(ExaminationGroup::class);
    }

    static function getExaminations(){
        return self::pluck('name', 'id');
    }

    
}
