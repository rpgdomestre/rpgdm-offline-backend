<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Link
 *
 * @package App
 *
 * @property int $id
 * @property string $link
 * @property string $name
 * @property string $type
 * @property int $section_id
 * @property string $source
 * @property ?int $via
 * @property Carbon created_at
 * @property Carbon $updated_at
 *
 * @method Link all
 * @method Link select
 *
 */
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
        return $this->belongsTo(SourceTwitter::class, 'source', 'source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sources(): Collection
    {
        return $this
            ->select(
                'links.source',
                'source_twitters.twitter',
                'source_twitters.id',
                'source_twitters.hide'
            )
            ->distinct()
            ->leftJoin('source_twitters', 'links.source', '=', 'source_twitters.source')
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
}
