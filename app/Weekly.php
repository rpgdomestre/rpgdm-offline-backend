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
     * @return mixed
     */
    public function fetchLinks(Carbon $from, Carbon $to)
    {
        $links = Link::with('section')
            ->select('*')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('type', 'desc')
            ->orderBy('section_id', 'desc')
            ->get();

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
}
