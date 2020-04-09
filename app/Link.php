<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Link extends Model
{
    protected $fillable = [
        'link',
        'name',
        'type',
        'section_id',
        'source',
        'via',
        'edition'
    ];

    protected $dates = [
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function twitter(): BelongsTo
    {
        return $this->belongsTo(
            SourceTwitter::class,
            'source',
            'source'
        );
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function sources(): Collection
    {
        return self::select(
            [
                'links.source',
                'source_twitters.twitter',
                'source_twitters.id',
                'source_twitters.hide',
            ]
        )
            ->distinct()
            ->leftJoin(
                'source_twitters',
                'links.source',
                '=',
                'source_twitters.source'
            )
            ->orderBy('links.source', 'ASC')
            ->get();
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function getCreatedAtAttribute(string $value): string
    {
        return Carbon::createFromDate($value)->diffForHumans();
    }

    /**
     * @param string $name
     */
    public function setNameAttribute(string $name): void
    {
        $convertedName = mb_convert_case($name, MB_CASE_TITLE, 'UTF-8');
        $this->attributes['name'] = $convertedName;
    }
}
