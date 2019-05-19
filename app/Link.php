<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $fillable = [
        'link',
        'name',
        'type',
        'section_id',
        'source',
        'via'
    ];

    protected $dates = [
        'created_at'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function getCreatedAtAttribute(string $value): string
    {
        return Carbon::createFromDate($value)->diffForHumans();
    }
}
