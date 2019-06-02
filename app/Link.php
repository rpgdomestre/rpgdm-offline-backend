<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class Link
 *
 * @package App
 * @property int $id
 * @property string $link
 * @property string $name
 * @property string $type
 * @property int $section_id
 * @property string $source
 * @property ?int $via
 * @property Carbon created_at
 * @property Carbon $updated_at
 * @property-read \App\Section $section
 * @property-read \App\SourceTwitter $twitter
 * @method static Builder|Link newModelQuery()
 * @method static Builder|Link newQuery()
 * @method static Builder|Link query()
 * @method static Builder|Link whereCreatedAt($value)
 * @method static Builder|Link whereId($value)
 * @method static Builder|Link whereLink($value)
 * @method static Builder|Link whereName($value)
 * @method static Builder|Link whereSectionId($value)
 * @method static Builder|Link whereSource($value)
 * @method static Builder|Link whereType($value)
 * @method static Builder|Link whereUpdatedAt($value)
 * @method static Builder|Link whereVia($value)
 * @mixin \Eloquent
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
     * @return \Illuminate\Support\Collection
     */
    public function sources(): Collection
    {
        return self::select(
                [
                    'links.source',
                    'source_twitters.twitter',
                    'source_twitters.id',
                    'source_twitters.hide'
                ]
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
