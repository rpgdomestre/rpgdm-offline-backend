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

    public function fetchLinks(Weekly $weekly): array
    {
        $links = $this->links($weekly);

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

    public function fetchAllLinksSortedByIdDesc(Weekly $weekly)
    {
        return $this->fetchLinks($weekly)['all']->sortByDesc('id');
    }

    public function fetchLinksForTwitter(Weekly $weekly): array
    {
        $fetched = $this->fetchLinks($weekly);

        /** @var \Illuminate\Database\Eloquent\Collection $all */
        $all = $fetched['all'];

        return $all->filter(
            static function ($link) {
                return $link->twitter
                    ? (string)$link->twitter->twitter !== ''
                    : false;
            }
        )->all();
    }

    public function numberOfLinks(Weekly $weekly): int
    {
        return $this->links($weekly)->count();
    }

    public function newWeeklyNumber(): int
    {
        return self::count() + 1;
    }

    public function latestUpdatedWeekly(): int
    {
        $mostUpToDate = self::orderBy('updated_at', 'DESC')
            ->limit(1)
            ->get();

        return collect($mostUpToDate)
            ->first()
            ->edition;
    }

    private function links(Weekly $weekly)
    {
        return Link::with(['section', 'twitter'])
            ->select('*')
            ->where('edition', $weekly->edition)
            ->orderBy('type', 'desc')
            ->orderBy('section_id', 'desc')
            ->get();
    }
}
