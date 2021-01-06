<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class Collections
{
    private const STATUS_PUBLISHED = 'Published';
    private const STATUS_EMPTY = 'Empty collection';
    private const STATUS_ERROR = 'Erroed';

    public function __construct(
        private ContentCollection $contentCollection,
        private CollectionChunk $collectionChunk,
    ) {}

    public function publishToHtml(): array
    {
        $collections = config('rpgdm.collections');

        $contents = [];
        foreach ($collections as $collection => $metadata) {
            if ($metadata['hidden']) {
                continue;
            }

            try {
                $this->collectionChunk->publish(
                    $collection,
                    $this->contentCollection->publish($collection, $metadata),
                    $metadata['chunk'],
                    ['color' => $metadata['color']]
                );

                $contents[$collection] = self::STATUS_PUBLISHED;
            } catch (DirectoryNotFoundException) {
                $contents[$collection] = self::STATUS_EMPTY;
            } catch (Exception $exception) {
                $contents[$collection] = self::STATUS_ERROR;
            }
        }

        return $contents;
    }
}
