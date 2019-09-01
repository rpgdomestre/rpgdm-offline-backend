<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Weekly
 *
 * @package App
 * @property int $id
 * @property int $edition
 * @property Carbon $released_at
 * @property Carbon $from
 * @property Carbon $to
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method Weekly latest()
 * @method Weekly first()
 * @method static Builder|Weekly newModelQuery()
 * @method static Builder|Weekly newQuery()
 * @method static Builder|Weekly query()
 * @method static Builder|Weekly whereCreatedAt($value)
 * @method static Builder|Weekly whereDescription($value)
 * @method static Builder|Weekly whereEdition($value)
 * @method static Builder|Weekly whereFrom($value)
 * @method static Builder|Weekly whereId($value)
 * @method static Builder|Weekly whereReleasedAt($value)
 * @method static Builder|Weekly whereTo($value)
 * @method static Builder|Weekly whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Weekly extends Model
{
    protected $fillable = [
        'edition',
        'released_at',
        'from',
        'to',
        'description',
    ];

    protected $dates = [
        'released_at',
        'from',
        'to',
    ];

    /**
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     *
     * @return array
     */
    public function fetchLinks(Carbon $from, Carbon $to): array
    {
        $links = $this->links($from, $to);

        /** @var \Illuminate\Database\Eloquent\Collection $groups */
        $groups = $links->mapToGroups(static function ($item) {
            return [$item['type'] => $item];
        });

        foreach ($groups as $name => $group) {
            $groups[$name] = $group->mapToGroups(static function ($item) {
                return [$item->section->name => $item];
            });
        }

        return [
            'all' => $links,
            'groups' => $groups
        ];
    }

    /**
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     *
     * @return mixed
     */
    public function fetchAllLinksSortedByIdDesc(Carbon $from, Carbon $to)
    {
        return $this->fetchLinks($from, $to)['all']->sortByDesc('id');
    }

    /**
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     *
     * @return array
     */
    public function fetchLinksForTwitter(Carbon $from, Carbon $to): array
    {
        $fetched = $this->fetchLinks($from, $to);

        /** @var \Illuminate\Database\Eloquent\Collection $all */
        $all = $fetched['all'];

        return $all->filter(static function ($link) {
            return $link->twitter
                ? (string)$link->twitter->twitter !== ''
                : false;
        })->all();
    }

    /**
     * @param \App\Weekly $weekly
     *
     * @return int
     */
    public function numberOfLinks(Weekly $weekly): int
    {
        return $this->links($weekly->from, $weekly->to)->count();
    }

    /**
     * @return int
     */
    public function newWeeklyNumber(): int
    {
        return self::count() + 1;
    }

    /**
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     *
     * @return \App\Link[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function links(Carbon $from, Carbon $to)
    {
        $links = Link::with(['section', 'twitter'])
            ->select('*')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('type', 'desc')
            ->orderBy('section_id', 'desc')
            ->get();

        return $links;
    }
}
