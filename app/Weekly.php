<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Weekly
 *
 * @package App
 *
 * @property int $id
 * @property int $edition
 * @property Carbon $released_at
 * @property Carbon $from
 * @property Carbon $to
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method Weekly latest()
 * @method Weekly first()
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
        return $this->latest()->first()->edition + 1;
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
