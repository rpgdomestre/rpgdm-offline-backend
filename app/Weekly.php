<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     *
     * @return \App\Link[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function links(Carbon $from, Carbon $to)
    {
        $links = Link::with('section')
            ->select('*')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('type', 'desc')
            ->orderBy('section_id', 'desc')
            ->get();

        return $links;
}
}
