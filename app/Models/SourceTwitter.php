<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

        /** @var \Illuminate\Database\Eloquent\Builder $this */
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
