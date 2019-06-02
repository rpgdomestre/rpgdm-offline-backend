<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SourceTwitter
 *
 * @package App
 * @method void truncate
 * @method bool insert(array $data)
 * @property int $id
 * @property string $source
 * @property string|null $twitter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $hide
 * @method static Builder|SourceTwitter newModelQuery()
 * @method static Builder|SourceTwitter newQuery()
 * @method static Builder|SourceTwitter query()
 * @method static Builder|SourceTwitter whereCreatedAt($value)
 * @method static Builder|SourceTwitter whereHide($value)
 * @method static Builder|SourceTwitter whereId($value)
 * @method static Builder|SourceTwitter whereSource($value)
 * @method static Builder|SourceTwitter whereTwitter($value)
 * @method static Builder|SourceTwitter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SourceTwitter extends Model
{
    protected $fillable = [
        'source',
        'twitter'
    ];

    /**
     * @param array $sources
     * @param array $twitters
     * @param array $hides
     *
     * @return array
     */
    public function prepareMultipleInsertValues(
        array $sources,
        array $twitters,
        array $hides
    ): array {
        $countSources = count($sources);

        $this->truncate();

        return array_map(
            static function (int $number) use ($sources, $twitters, $hides) {
                return [
                    'source' => $sources[$number],
                    'twitter' => $twitters[$number],
                    'hide' => array_key_exists($sources[$number], $hides),
                ];
            },
            range(0, $countSources - 1)
        );
    }
}
